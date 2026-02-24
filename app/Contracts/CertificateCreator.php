<?php
namespace App\Contracts;

use App\Services\PDFCertificateCreator;
use Illuminate\Container\Attributes\Bind;

#[Bind(PDFCertificateCreator::class)]
interface CertificateCreator
{
    public function generate($user, $course): string;
}

