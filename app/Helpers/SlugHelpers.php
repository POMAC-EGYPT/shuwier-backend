<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Str;

class SlugHelpers
{
    public static function generateSlug(string $string, int $id): string
    {
        $slug = Str::slug($string);

        $digits = strlen((string)$id);

        if ($digits == 6)
            $suffix = $id;
        elseif ($digits > 6)
            $suffix = substr((string)$id, -6);
        else {
            $missing = 6 - $digits;

            $randomPrefix = '';

            for ($i = 0; $i < $missing; $i++)
                $randomPrefix .= random_int(0, 9);

            $suffix = $randomPrefix . $id;
        }

        return $slug . '-' . $suffix;
    }
}
