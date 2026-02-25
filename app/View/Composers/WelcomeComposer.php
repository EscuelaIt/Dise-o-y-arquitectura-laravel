<?php

namespace App\View\Composers;

use App\Models\Tag;
use Illuminate\View\View;

class WelcomeComposer
{
    public function compose(View $view): void
    {
        $view->with('tagCount', Tag::all()->count());
    }
}
