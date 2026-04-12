<?php

namespace App\Application\Projects;

use App\Models\Project;
use App\Services\ProjectFileService;
use Illuminate\Http\Request;

class SaveProjectDraftAction
{
    public function __construct(
        private readonly ProjectFileService $fileService
    ) {}

    public function handle(Request $request, array $validatedData): array
    {
        $data = $validatedData;
        unset(
            $data['step'],
            $data['image_cover'],
            $data['image_card'],
            $data['document_presentation'],
            $data['document_business_plan'],
            $data['document_financial_model']
        );

        $project = new Project([
            'user_id' => $request->user()->id,
            'status' => Project::STATUS_DRAFT,
        ]);
        $project->fill(array_filter($data));
        $project->save();

        $createdImages = $this->fileService->syncProjectFiles($request, $project);

        return [
            'project' => $project,
            'created_images' => $createdImages,
        ];
    }
}
