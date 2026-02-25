<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Services\CountryService;
use App\Services\LogReportService;
use App\Services\SlugGenerator;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TagController extends Controller
{
    public function create(Container $container)
    {
        $reporter = resolve(LogReportService::class);
        //$countryService = App::make(CountryService::class);
        $countryService = $container->make(CountryService::class);
        $reporter->generate($countryService->getCountries());

        return view('tags.create');
    }

    public function store(Request $request, SlugGenerator $slugGenerator)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:50',
        ]);

        $slug = $slugGenerator->generateSlug($validated['nombre'], Tag::class, 'slug');
        $validated['slug'] = $slug;

        Tag::create($validated);

        $reporter = resolve(LogReportService::class);
        $reporter->generate([$validated['nombre'], 'dato1', 'dato2']);

        return redirect()->route('tags.create')->with('success', 'Tag creada exitosamente');
    }
}
