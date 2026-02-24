<?php

namespace App\Http\Controllers;

use App\Services\OpenAIApiClient;
use Illuminate\Http\Request;

class OpenAIController extends Controller
{
    public function sendMessage(Request $request, OpenAIApiClient $openAIClient)
    {
        $message = $request->input('message', 'Hello from Laravel!');

        $response = $openAIClient->sendMessage($message);

        return response()->json([
            'success' => true,
            'message' => 'Message sent to OpenAI API',
            'response' => $response,
        ]);
    }
}
