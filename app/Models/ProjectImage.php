<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * |KB 2026-03-13 Изображение проекта (обложка 1:1 или карточка 16:9).
 */
class ProjectImage extends Model
{
    public const TYPE_COVER = 'cover';

    public const TYPE_CARD = 'card';

    protected $fillable = ['project_id', 'type', 'path', 'original_name', 'sort_order'];

    protected $casts = [];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function deleteFile(): void
    {
        if ($this->path) {
            Storage::disk('public')->delete($this->path);
        }
        $this->delete();
    }
}
