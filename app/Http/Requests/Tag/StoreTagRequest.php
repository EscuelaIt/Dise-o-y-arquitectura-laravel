<?php

namespace App\Http\Requests\Tag;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
{
    use CommonTagRequest;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(#[CurrentUser] ?User $user): bool
    {
        return $user ? $user->can('create', Tag::class) : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->commonRules;
    }
}
