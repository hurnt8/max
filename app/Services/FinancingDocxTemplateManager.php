<?php

namespace App\Services;

use App\Models\FinancingContractTemplate;
use Illuminate\Http\UploadedFile;
use ZipArchive;

/**
 * Gère l'upload, le versioning et la détection de variables des templates DOCX
 * "Financement" — miroir de DocxTemplateManager, découplé de ContractTemplate.
 */
class FinancingDocxTemplateManager
{
    public function __construct(
        private ContractDocxRenderer $renderer,
    ) {}

    /**
     * Valide, stocke et enregistre un nouveau template DOCX.
     * Incrémente la version et archive l'ancien fichier si nécessaire.
     *
     * @return string[]  Liste des variables détectées (sans accolades)
     */
    public function upload(UploadedFile $file, FinancingContractTemplate $template): array
    {
        $this->validateDocx($file);

        $oldPath = $template->docx_template_path;
        $version = ($template->docx_version ?? 0) + 1;

        $filename    = 'financing_template_' . $template->id . '_v' . $version . '_' . time() . '.docx';
        $storagePath = $file->storeAs('docx-templates', $filename, 'local');
        $absPath     = storage_path('app/' . $storagePath);

        try {
            $vars = $this->detectVariables($absPath);
        } catch (\Throwable $e) {
            @unlink($absPath);
            throw $e;
        }

        if ($oldPath) {
            try {
                $this->archiveOld($oldPath, $template->id, $version - 1);
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::warning(
                    'FinancingDocxTemplateManager: archivage ancien template échoué — ' . $e->getMessage()
                );
            }
        }

        $template->update([
            'docx_template_path' => $storagePath,
            'docx_version'       => $version,
            'docx_detected_vars' => $vars,
        ]);

        return $vars;
    }

    /**
     * Extrait toutes les variables {balise} présentes dans un fichier DOCX.
     *
     * @return string[]  ex: ['reference', 'nom_client', 'devise']
     */
    public function detectVariables(string $docxAbsPath): array
    {
        $zip = new ZipArchive();
        if ($zip->open($docxAbsPath) !== true) {
            throw new \RuntimeException("Impossible d'ouvrir le DOCX : $docxAbsPath");
        }

        $targets = ['word/document.xml'];
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $name = $zip->getNameIndex($i);
            if (preg_match('#^word/(header|footer)\d+\.xml$#', $name)) {
                $targets[] = $name;
            }
        }

        $vars = [];
        foreach ($targets as $target) {
            $xml = $zip->getFromName($target);
            if ($xml === false) {
                continue;
            }

            $xml = $this->renderer->defragment($xml);

            preg_match_all('/<w:t[^>]*>([^<]*)<\/w:t>/', $xml, $textMatches);
            $text = implode('', $textMatches[1]);

            preg_match_all('/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/', $text, $varMatches);
            $vars = array_merge($vars, $varMatches[1]);
        }

        $zip->close();

        return array_values(array_unique($vars));
    }

    public function validateDocx(UploadedFile $file): void
    {
        $ext = strtolower($file->getClientOriginalExtension());
        if ($ext !== 'docx') {
            throw new \InvalidArgumentException('Le fichier doit être un .docx (reçu : .' . $ext . ')');
        }

        $zip = new ZipArchive();
        if ($zip->open($file->getRealPath()) !== true) {
            throw new \InvalidArgumentException('Le fichier DOCX est corrompu ou invalide.');
        }

        $valid = $zip->locateName('word/document.xml') !== false;
        $zip->close();

        if (!$valid) {
            throw new \InvalidArgumentException('Le fichier n\'est pas un DOCX valide (word/document.xml absent).');
        }
    }

    private function archiveOld(string $oldPath, int $templateId, int $oldVersion): void
    {
        $src = storage_path('app/' . $oldPath);
        if (!file_exists($src)) {
            return;
        }

        $archiveDir = storage_path('app/docx-templates/archives');
        if (!is_dir($archiveDir)) {
            mkdir($archiveDir, 0755, true);
        }

        $dest = $archiveDir . '/financing_template_' . $templateId . '_v' . $oldVersion . '.docx';
        rename($src, $dest);
    }
}
