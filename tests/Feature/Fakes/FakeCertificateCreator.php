<?php

namespace Tests\Feature\Fakes;

use App\Contracts\CertificateCreator;

class FakeCertificateCreator implements CertificateCreator
{
    public function generate($user, $course): string
    {
        info('Generando un certificado fake');
        return "ruta/al/certificado/fake.pdf";
    }

}
