<?php

namespace App\Service\Person;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AvatarService
{
    public function getAvatarImage(string $name): string
    {
        $url = 'https://api.dicebear.com/7.x/initials/png?seed=' . urlencode($name);
        $response = Http::get($url);

        if ($response->successful()) {
            $fileName = 'avatars/' . uniqid() . '.png';
            Storage::disk('public')->put($fileName, $response->body());
        }

        return $fileName;
    }

    public function deleteAvatarImage(string $path): void
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
