<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

/**
 * Проверка минимальных размеров изображения (ширина × высота).
 */
class ImageMinDimensions implements ValidationRule
{
    public function __construct(
        private int $minWidth,
        private int $minHeight
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $value instanceof UploadedFile || ! $value->isValid()) {
            return;
        }

        $path = $value->getRealPath();
        $info = @getimagesize($path);

        if ($info === false) {
            $fail(__('Файл не является корректным изображением.'));
            return;
        }

        $width = $info[0] ?? 0;
        $height = $info[1] ?? 0;

        if ($width < $this->minWidth || $height < $this->minHeight) {
            $fail(__('Минимальный размер изображения: :minWidth×:minHeight px.', [
                'minWidth' => $this->minWidth,
                'minHeight' => $this->minHeight,
            ]));
        }
    }
}
