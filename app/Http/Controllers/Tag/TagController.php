<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Models\Tag;
use App\Services\CountryService;
use App\Services\LogReportService;
use Facades\App\Services\SlugGenerator;
use Illuminate\Container\Container;
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

    public function store(StoreTagRequest $request)
    {
        $validated = $request->validated();
        $slug = SlugGenerator::generateSlug($validated['nombre'], Tag::class, 'slug');
        $validated['slug'] = $slug;

        Tag::create($validated);

        $reporter = resolve(LogReportService::class);
        $reporter->generate([$validated['nombre'], 'dato1', 'dato2']);

        return redirect()->route('tags.create')->with('success', 'Tag creada exitosamente');
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $validated = $request->validated();

        $tag->update($validated);

        return redirect("/")->with('success', 'Tag actualizada exitosamente');
    }

}
