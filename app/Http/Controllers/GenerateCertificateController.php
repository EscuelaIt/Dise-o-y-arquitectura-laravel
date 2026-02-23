<?php

namespace App\Http\Controllers;

use App\Contracts\CertificateCreator;

class GenerateCertificateController extends Controller
{
    public function generate(CertificateCreator $certificateCreator)
    {
        $user = 'foo';
        $course = 'bar';
        return $certificateCreator->generate($user, $course);
    }
}
