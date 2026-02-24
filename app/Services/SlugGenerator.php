<?php

namespace App\Services;

use Illuminate\Support\Str;

class SlugGenerator
{
    private int $randomStringLength = 3;

    public function setRandomStringLength(int $length): self {
        $this->randomStringLength = $length;
        return $this;
    }

    private function generateSlugWithTimestamp(string $originalSlug, string $randomString): string {
        return $originalSlug . '-' . $randomString . '-' . time();
    }

    public function generateSlug($source, $modelName, $columnName) {
        $slug = Str::slug($source);

        if (!class_exists($modelName)) {
            throw new \Exception("{$modelName} does not exists.");
        }

        $originalSlug = $slug;
        $counter = 1;

        while ($modelName::where($columnName, $slug)->exists()) {
            $randomString = Str::random($this->randomStringLength);
            $slug = $originalSlug . '-' . $randomString;

            if ($counter > 10) {
                $slug = $this->generateSlugWithTimestamp($originalSlug, $randomString);
                break;
            }

            $counter++;
        }

        return $slug;
    }
}
