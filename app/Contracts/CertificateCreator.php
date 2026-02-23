<?php
namespace App\Contracts;

interface CertificateCreator
{
    public function generate($user, $course): string;
}

