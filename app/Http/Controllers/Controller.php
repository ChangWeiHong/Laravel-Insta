<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Intervention\Image\Laravel\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function transformUploadedImage(string $imagePath, int $width, int $height): void
    {
        if (! $this->supportsConfiguredImageDriver()) {
            return;
        }

        Image::decode(public_path("storage/{$imagePath}"))
            ->cover($width, $height)
            ->save(public_path("storage/{$imagePath}"));
    }

    private function supportsConfiguredImageDriver(): bool
    {
        $driver = strtolower((string) config('image.driver'));

        return match (true) {
            str_contains($driver, 'gd') => extension_loaded('gd'),
            str_contains($driver, 'imagick') => extension_loaded('imagick'),
            str_contains($driver, 'vips') => extension_loaded('vips'),
            default => extension_loaded('gd') || extension_loaded('imagick') || extension_loaded('vips'),
        };
    }
}
