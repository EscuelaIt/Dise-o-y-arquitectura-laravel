<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class OpenAIApiClient
{
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function sendMessage(string $message): string
    {
        Log::info('OpenAI API would be called with message: ' . $message);

        // Aquí iría la implementación real del API de OpenAI
        return 'Response from OpenAI API';
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }
}
