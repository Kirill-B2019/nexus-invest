<?php

namespace App\Support;

use Illuminate\Support\Str;

/**
 * Очистка HTML тела редакционной статьи (allowlist тегов).
 */
class HtmlSanitizer
{
    private const ALLOWED_TAGS = '<p><br><strong><b><em><i><ul><ol><li><a><h2><h3><blockquote><img>';

    public static function clean(?string $html): ?string
    {
        if ($html === null || trim($html) === '') {
            return null;
        }

        $cleaned = strip_tags($html, self::ALLOWED_TAGS);

        // Убрать javascript: и on*-атрибуты из оставшихся тегов
        $cleaned = preg_replace_callback(
            '/<(a|img)\b([^>]*)>/iu',
            static function (array $m): string {
                $tag = strtolower($m[1]);
                $attrs = $m[2];
                $safe = [];

                if ($tag === 'a' && preg_match('/\bhref\s*=\s*("|\')(.*?)\1/iu', $attrs, $href)) {
                    $url = trim($href[2]);
                    if (Str::startsWith(strtolower($url), ['http://', 'https://', '/', 'mailto:'])) {
                        $safe[] = 'href="' . e($url) . '"';
                        $safe[] = 'rel="noopener noreferrer"';
                    }
                }

                if ($tag === 'img') {
                    if (preg_match('/\bsrc\s*=\s*("|\')(.*?)\1/iu', $attrs, $src)) {
                        $url = trim($src[2]);
                        if (Str::startsWith(strtolower($url), ['http://', 'https://', '/'])) {
                            $safe[] = 'src="' . e($url) . '"';
                        }
                    }
                    if (preg_match('/\balt\s*=\s*("|\')(.*?)\1/iu', $attrs, $alt)) {
                        $safe[] = 'alt="' . e($alt[2]) . '"';
                    }
                    $safe[] = 'loading="lazy"';
                }

                return '<' . $tag . (count($safe) ? ' ' . implode(' ', $safe) : '') . '>';
            },
            $cleaned
        );

        return $cleaned;
    }
}
