<?php

namespace App\Http\Controllers;

use App\Services\CountryService;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function index(Request $request)
    {
        $service = new CountryService();
        $result = $service->getCountries($request->input('continent'));

        if(! $result['success']) {
            return view('countries.index', [
                'error' => $result['error'],
                'countries' => [],
                'total' => 0,
                'continent' => $request->input('continent'),
            ]);
        }

        return view('countries.index', [
            'countries' => $result['data'],
            'total' => count($result['data']),
            'continent' => $request->input('continent'),
            'message' => sprintf('Países encontrados: %d', count($result['data'])),
        ]);
    }
}
}
