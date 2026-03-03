<?php

namespace App\Http\Requests\Tag;

trait CommonTagRequest {
    protected $commonRules = [
        'nombre' => 'required|string|max:50|min:2'
    ];
}
