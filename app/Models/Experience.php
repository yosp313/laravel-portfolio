<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'title',
        'company',
        'start_year',
        'end_year',
        'description',
    ];

    public static function cleanMarkdown($input)
    {
        $lines = preg_split('/\r\n|\r|\n/', $input);
        $cleaned = [];
        foreach ($lines as $line) {
            $trimmed = trim($line);
            if ($trimmed !== '') {
                $cleaned[] = $trimmed;
            }
        }
        return implode("\n", $cleaned);
    }
}
