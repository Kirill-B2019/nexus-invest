<?php

namespace App\Application\Projects;

use App\Domain\Projects\ProjectWorkflow;
use App\Events\ProjectApproved;
use App\Events\ProjectRejected;
use App\Models\Project;
use App\Models\User;

class ModerateProjectAction
{
    public function __construct(
        private readonly ProjectWorkflow $workflow
    ) {}

    public function handle(Project $project, User $moderator, string $action, ?string $comment = null): Project
    {
        if ($action === 'approve') {
            $this->workflow->approve($project, $moderator->id);
            $project->save();
            event(new ProjectApproved($project));

            return $project;
        }

        $this->workflow->reject($project, $moderator->id, (string) $comment);
        $project->save();
        event(new ProjectRejected($project));

        return $project;
    }
}
