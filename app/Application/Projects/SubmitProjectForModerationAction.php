<?php

namespace App\Application\Projects;

use App\Domain\Projects\ProjectWorkflow;
use App\Events\ProjectSubmitted;
use App\Models\Project;

class SubmitProjectForModerationAction
{
    public function __construct(
        private readonly ProjectWorkflow $workflow
    ) {}

    public function handle(Project $project, array $validatedData): Project
    {
        $project->fill($validatedData);
        $this->workflow->submitForModeration($project);
        $project->save();

        event(new ProjectSubmitted($project));

        return $project;
    }
}
