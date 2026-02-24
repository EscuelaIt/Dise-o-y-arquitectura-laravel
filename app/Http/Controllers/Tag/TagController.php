<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Services\SlugGenerator;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function create()
    {
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

        return redirect()->route('tags.create')->with('success', 'Tag creada exitosamente');
    }
}
