<?php

namespace App\Services;

use App\Models\FinancingRequest;

/**
 * Résout les variables {balise} → valeur pour un dossier de financement.
 * Le DOCX est rédigé directement dans la langue du client — pas de traduction automatique.
 * Seules les données du dossier sont injectées.
 */
class FinancingVariableResolver
{
    public function __construct(
        private ContractService $contractService,
    ) {}

    /**
     * Retourne le tableau complet [{balise} => valeur_XML_escaped]
     * à partir d'un FinancingRequest.
     */
    public function resolve(FinancingRequest $financing, string $locale = 'fr'): array
    {
        return $this->escapeXml($this->buildRawVars($financing, $locale));
    }

    /**
     * Retourne les variables avec des données de démonstration (aperçu admin).
     */
    public function resolveSample(string $locale = 'fr'): array
    {
        return $this->escapeXml($this->sampleVars($locale));
    }

    /**
     * Retourne le tableau [{balise} => valeur] SANS échappement XML — pour
     * substitution dans un sujet/corps d'email HTML (modèles de notification),
     * contrairement à resolve() qui échappe pour insertion dans un DOCX.
     */
    public function resolveRaw(FinancingRequest $financing, string $locale = 'fr'): array
    {
        return $this->buildRawVars($financing, $locale);
    }

    /**
     * Vérifie quelles variables du DOCX ne sont pas couvertes par resolve().
     *
     * @param  string[] $detectedVars  ex: ['reference','nom_client','devise',...]
     */
    public function getMissing(array $detectedVars, FinancingRequest $financing, string $locale = 'fr'): array
    {
        $resolved = $this->resolve($financing, $locale);
        $keys     = array_map(fn($k) => trim($k, '{}'), array_keys($resolved));

        return array_values(array_filter(
            $detectedVars,
            fn($v) => !in_array($v, $keys, true)
        ));
    }

    // ── Internals ────────────────────────────────────────────────────────────────

    private function buildRawVars(FinancingRequest $financing, string $locale): array
    {
        if (!$financing->relationLoaded('client')) {
            $financing->load('client');
        }
        if (!$financing->relationLoaded('admin')) {
            $financing->load('admin');
        }

        $client = $financing->client;
        $gender = $this->resolveGender($financing, $locale);

        $vars = [
            '{reference}'       => $financing->reference ?? '',
            '{archive}'         => $financing->archive_ref ?? '',
            '{nom_client}'      => $client?->name ?? $financing->name ?? '',
            '{adresse_client}'  => $client?->address ?? $financing->address ?? '',
            '{address_client}'  => $client?->address ?? $financing->address ?? '',
            '{date_naissance}'  => $client?->birth_date?->format('d/m/Y') ?? '',
            '{type_identite}'   => $this->contractService->translateIdType(
                                    $client?->id_type ?? '', $locale),
            '{numero_identite}' => $client?->id_number ?? $client?->npi ?? $financing->npi ?? '',
            '{date_delivre}'    => $client?->date_delivre?->format('d/m/Y') ?? '',
            '{numero_fiscal}'   => $client?->tax_number ?? '',
            '{activite_exercee}' => $client?->activity ?? '',
            '{objet}'           => $financing->objet ?? '',
            '{montant_lettres}' => NumberToWordsConverter::convert((float) $financing->amount, $locale),
            '{typefinance}'     => $this->contractService->translateFinancingType(
                                    $financing->financing_type ?? '', $locale),
            '{agent_suivi}'     => $financing->agent_suivi ?? $financing->admin?->name ?? '',
            '{directeur}'       => $financing->directeur ?? '',
            '{notaire}'         => $financing->notaire ?? '',
            '{montant}'         => number_format((float)$financing->amount, 2, ',', ' '),
            '{devise}'          => $financing->currency ?? 'EUR',
            '{frais_admin}'     => number_format((float)$financing->admin_fees, 2, ',', ' '),
            '{compte_bancaire}' => $financing->bank_account ?? '',
            '{date}'            => $financing->validated_at?->format('d/m/Y') ?? now()->format('d/m/Y'),
            '{societe}'         => config('app.company_name', 'AURELIS CAPITAL GROUP INVESTI'),
        ];

        $vars = array_merge($vars, $gender);

        $reservedKeys = array_map(fn($k) => trim($k, '{}'), array_keys($vars));
        foreach ((array) ($financing->extra_fields ?? []) as $key => $value) {
            if (!in_array($key, $reservedKeys, true)) {
                $vars['{' . $key . '}'] = (string) $value;
            }
        }

        return $vars;
    }

    private function resolveGender(FinancingRequest $financing, string $locale): array
    {
        $gender = $financing->client?->gender ?? 'M';
        $female = $gender === 'F';

        return match ($locale) {
            'pl' => [
                '{ne_e}'         => $female ? 'urodzona' : 'urodzony',
                '{nee}'          => $female ? 'urodzona' : 'urodzony',
                '{denomme_e}'    => $female ? 'zwana' : 'zwany',
                '{zamieszkal_a}' => $female ? 'zamieszkała' : 'zamieszkały',
                '{e}'            => $female ? 'a' : 'y',
            ],
            'es' => [
                '{ne_e}'         => $female ? 'nacida' : 'nacido',
                '{nee}'          => $female ? 'nacida' : 'nacido',
                '{denomme_e}'    => $female ? 'denominada' : 'denominado',
                '{zamieszkal_a}' => '',
                '{e}'            => $female ? 'a' : 'o',
            ],
            'en' => [
                '{ne_e}'         => 'born',
                '{nee}'          => 'born',
                '{denomme_e}'    => 'referred to as',
                '{zamieszkal_a}' => 'residing at',
                '{e}'            => '',
            ],
            default => [
                '{ne_e}'         => $female ? 'née' : 'né',
                '{nee}'          => $female ? 'née' : 'né',
                '{denomme_e}'    => $female ? 'dénommée' : 'dénommé',
                '{zamieszkal_a}' => '',
                '{e}'            => $female ? 'e' : '',
            ],
        };
    }

    private function sampleVars(string $locale): array
    {
        $gender = match ($locale) {
            'pl' => ['{ne_e}' => 'urodzony', '{nee}' => 'urodzony', '{denomme_e}' => 'zwany', '{zamieszkal_a}' => 'zamieszkały', '{e}' => 'y'],
            'es' => ['{ne_e}' => 'nacido',   '{nee}' => 'nacido',   '{denomme_e}' => 'denominado', '{zamieszkal_a}' => '', '{e}' => 'o'],
            'en' => ['{ne_e}' => 'born',     '{nee}' => 'born',     '{denomme_e}' => 'referred to as', '{zamieszkal_a}' => 'residing at', '{e}' => ''],
            default => ['{ne_e}' => 'né',    '{nee}' => 'né',       '{denomme_e}' => 'dénommé', '{zamieszkal_a}' => '', '{e}' => ''],
        };

        return array_merge([
            '{reference}'       => 'FIN-2026-0001',
            '{archive}'         => 'FIN-ARC-2026-0001',
            '{nom_client}'      => 'Jean DUPONT',
            '{adresse_client}'  => '12 rue de la Paix, 75001 Paris',
            '{address_client}'  => '12 rue de la Paix, 75001 Paris',
            '{date_naissance}'  => '15/06/1985',
            '{type_identite}'   => 'Passeport',
            '{numero_identite}' => 'AB123456',
            '{date_delivre}'    => '10/03/2020',
            '{numero_fiscal}'   => 'FR123456789',
            '{activite_exercee}' => 'Commerçant',
            '{objet}'           => 'Acquisition d\'équipement',
            '{montant_lettres}' => NumberToWordsConverter::convert(15000, $locale),
            '{typefinance}'     => 'Financement personnel',
            '{agent_suivi}'     => 'Marie MARTIN',
            '{directeur}'       => 'Pierre DUPONT',
            '{notaire}'         => 'Maître Jacques DURAND',
            '{montant}'         => '15 000,00',
            '{devise}'          => 'EUR',
            '{frais_admin}'     => '250,00',
            '{compte_bancaire}' => 'FR76 1234 5678 9012 3456 7890 123',
            '{date}'            => now()->format('d/m/Y'),
            '{societe}'         => config('app.company_name', 'AURELIS CAPITAL GROUP INVESTI'),
        ], $gender);
    }

    private function escapeXml(array $vars): array
    {
        return array_map(
            fn($v) => htmlspecialchars((string) $v, ENT_XML1 | ENT_QUOTES, 'UTF-8'),
            $vars
        );
    }
}
