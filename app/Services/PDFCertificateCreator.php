<?php

namespace App\Services;

use App\Contracts\CertificateCreator;

class PDFCertificateCreator implements CertificateCreator
{
    public function generate($user, $course): string
    {
        // Código para generar el PDF
        info('Generando un certificado en PDF');
        return 'ruta/al/certificado.pdf';
    }
}
