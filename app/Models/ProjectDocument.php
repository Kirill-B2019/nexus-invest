<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * |KB 2026-03-13 Документ проекта (презентация, бизнес-план и т.д.).
 */
class ProjectDocument extends Model
{
    public const TYPE_PRESENTATION = 'presentation';
    public const TYPE_BUSINESS_PLAN = 'business_plan';
    public const TYPE_FINANCIAL_MODEL = 'financial_model';
    public const TYPE_OTHER = 'other';

    protected $fillable = ['project_id', 'type', 'path', 'original_name', 'sort_order'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public static function storeFile(Project $project, UploadedFile $file, string $type): self
    {
        $path = $file->store("projects/{$project->id}/documents", 'public');

        return self::create([
            'project_id' => $project->id,
            'type' => $type,
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function deleteFile(): void
    {
        if ($this->path && Storage::disk('public')->exists($this->path)) {
            Storage::disk('public')->delete($this->path);
        }
        $this->delete();
    }

    public static function typeLabel(string $type): string
    {
        return match ($type) {
            self::TYPE_PRESENTATION => __('Презентация'),
            self::TYPE_BUSINESS_PLAN => __('Бизнес-план'),
            self::TYPE_FINANCIAL_MODEL => __('Финансовая модель'),
            self::TYPE_OTHER => __('Другое'),
            default => $type,
        };
    }
}
