<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectDocument;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProjectFileService
{
    public function syncProjectFiles(Request $request, Project $project): array
    {
        $createdImages = [];

        $maxSortCover = $project->coverImages()->max('sort_order') ?? -1;
        foreach (Arr::wrap($request->file('image_cover')) as $file) {
            if (! $file) {
                continue;
            }

            $path = $file->store("projects/{$project->id}/images", 'public');
            $img = ProjectImage::create([
                'project_id' => $project->id,
                'type' => ProjectImage::TYPE_COVER,
                'path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'sort_order' => ++$maxSortCover,
            ]);

            $createdImages[] = $this->mapImagePayload($project, $img);
        }

        $maxSortCard = $project->cardImages()->max('sort_order') ?? -1;
        foreach (Arr::wrap($request->file('image_card')) as $file) {
            if (! $file) {
                continue;
            }

            $path = $file->store("projects/{$project->id}/images", 'public');
            $img = ProjectImage::create([
                'project_id' => $project->id,
                'type' => ProjectImage::TYPE_CARD,
                'path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'sort_order' => ++$maxSortCard,
            ]);

            $createdImages[] = $this->mapImagePayload($project, $img);
        }

        foreach ([
            'document_presentation' => ProjectDocument::TYPE_PRESENTATION,
            'document_business_plan' => ProjectDocument::TYPE_BUSINESS_PLAN,
            'document_financial_model' => ProjectDocument::TYPE_FINANCIAL_MODEL,
        ] as $key => $type) {
            if (! $request->file($key)) {
                continue;
            }

            $project->documents()->where('type', $type)->each(fn (ProjectDocument $document) => $document->deleteFile());
            ProjectDocument::storeFile($project, $request->file($key), $type);
        }

        return $createdImages;
    }

    private function mapImagePayload(Project $project, ProjectImage $image): array
    {
        return [
            'id' => $image->id,
            'type' => $image->type,
            'url' => asset('storage/'.$image->path),
            'delete_url' => url('/lk/projects/'.$project->id.'/images/'.$image->id),
        ];
    }
}
