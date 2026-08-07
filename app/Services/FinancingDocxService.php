<?php

namespace App\Services;

use App\Models\FinancingContractTemplate;
use App\Models\FinancingNotificationTemplate;
use App\Models\FinancingRequest;

/**
 * Génère les DOCX remplis (contrat + notification) pour un dossier de financement,
 * en réutilisant le moteur générique ContractDocxRenderer::render() (déjà découplé
 * de LoanRequest/ContractTemplate) et FinancingVariableResolver pour les données.
 */
class FinancingDocxService
{
    public function __construct(
        private ContractDocxRenderer        $renderer,
        private FinancingVariableResolver   $resolver,
    ) {}

    /**
     * Génère le DOCX du contrat rempli pour un dossier donné.
     * Retourne le chemin absolu du fichier généré.
     */
    public function generateContract(FinancingRequest $financing, FinancingContractTemplate $template, string $locale = 'fr'): string
    {
        $docxPath = $this->resolveTemplatePath($template->docx_template_path, $template->name);
        $vars     = $this->resolver->resolve($financing, $locale);

        $outputPath = $this->buildOutputPath('financing-contracts', 'financing_contract_' . $financing->reference, $locale);
        return $this->renderer->render($docxPath, $vars, $outputPath);
    }

    /**
     * Génère un DOCX d'aperçu du contrat avec des données de démonstration.
     */
    public function generateContractPreview(FinancingContractTemplate $template, string $locale = 'fr'): string
    {
        $docxPath = $this->resolveTemplatePath($template->docx_template_path, $template->name);
        $vars     = $this->resolver->resolveSample($locale);

        $outputPath = $this->buildOutputPath('financing-contracts', 'preview_' . $template->id . '_' . uniqid(), $locale);
        return $this->renderer->render($docxPath, $vars, $outputPath);
    }

    /**
     * Génère le DOCX de notification rempli pour un dossier donné.
     */
    public function generateNotification(FinancingRequest $financing, FinancingNotificationTemplate $template, string $locale = 'fr'): string
    {
        $docxPath = $this->resolveTemplatePath($template->docx_template_path, $template->name);
        $vars     = $this->resolver->resolve($financing, $locale);

        $outputPath = $this->buildOutputPath('financing-notifications', 'financing_notification_' . $financing->reference, $locale);
        return $this->renderer->render($docxPath, $vars, $outputPath);
    }

    private function resolveTemplatePath(?string $relPath, string $templateName): string
    {
        if (!$relPath) {
            throw new \RuntimeException("Aucun template DOCX uploadé pour le modèle \"{$templateName}\".");
        }

        $path = storage_path('app/' . $relPath);
        if (!file_exists($path)) {
            throw new \RuntimeException("Fichier DOCX template introuvable : {$relPath}");
        }

        return $path;
    }

    private function buildOutputPath(string $dirName, string $baseName, string $locale): string
    {
        $safe = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $baseName);
        $dir  = storage_path('app/' . $dirName);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        return $dir . DIRECTORY_SEPARATOR . $safe . '_' . $locale . '.docx';
    }
}
