<?php

namespace App\Services;

use App\Contracts\AppReportService;
// use Illuminate\Container\Attributes\Scoped;
use Illuminate\Container\Attributes\Singleton;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

#[Singleton]
class CountryService
{
    private const API_URL = 'https://timer.escuelait.com/api/countries';
    private const VALID_CONTINENTS = ['africa', 'north america', 'asia', 'europe', 'oceania', 'south america'];

    private ?array $cachedCountries = null;
    private bool $fetchAttempted = false;

    public function __construct(private ServiceLogger $logger, private AppReportService $reporter)
    { }

    public function getCountries(?string $continent = null)
    {
        if ($continent) {
            $continent = $this->normalizeContinent($continent);
        }

        if(! $this->isValidContinentInput($continent)) {
            $validList = implode(', ', array_map('ucwords', self::VALID_CONTINENTS));
            return [
                'success' => false,
                'error' => 'Continente inválido. Elementos válidos: ' . $validList,
            ];
        }

        // Si no se ha intentado obtener datos aún, hacer la solicitud
        if (!$this->fetchAttempted) {
            if (!$this->fetchAndCacheCountries()) {
                return [
                    'success' => false,
                    'error' => 'Error al obtener países',
                ];
            }
        }

        // Si el caché está vacío después del intento, retornar error
        if ($this->cachedCountries === null) {
            return [
                'success' => false,
                'error' => 'Error al obtener países',
            ];
        }

        return [
            'success' => true,
            'data' => $this->filterByContinent($this->cachedCountries, $continent),
        ];
    }

    private function normalizeContinent(string $continent): string
    {
        return strtolower(trim($continent));
    }

    private function isValidContinentInput(?string $continent): bool
    {
        return is_null($continent) || in_array($continent, self::VALID_CONTINENTS, true);
    }

    private function fetchAndCacheCountries(): bool
    {
        $this->fetchAttempted = true;

        $response = Http::timeout(10)
            ->withHeaders([
                'Accept' => 'application/json',
                'User-Agent' => 'Laravel-App/1.0',
            ])
            ->get(self::API_URL);

        if ($response->failed()) {
            Log::error('Failed to fetch countries API', ['status' => $response->status()]);
            return false;
        }

        $data = $response->json();

        if (!isset($data['data']) || !is_array($data['data'])) {
            Log::warning('Invalid API structure');
            return false;
        }

        $countries = $data['data'];
        $this->logger->log(count($countries));
        $this->reporter->generate($countries);
        $this->cachedCountries = $countries;

        return true;
    }

    private function filterByContinent(array $countries, ?string $continent): array
    {
        if(is_null($continent)) {
            return $countries;
        }
        return array_values(array_filter($countries, fn($country) =>
            strtolower($country['continent']) === $continent
        ));
    }
}
