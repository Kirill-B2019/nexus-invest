<?php

namespace App\Domain\Projects;

use App\Models\Project;
use DomainException;

class ProjectWorkflow
{
    public function submitForModeration(Project $project): void
    {
        if ($project->status !== ProjectStatus::Draft->value) {
            throw new DomainException(__('Проект можно отправить на модерацию только из черновика.'));
        }

        $project->status = ProjectStatus::Moderation->value;
        $project->submitted_at = now();
        $project->moderation_comment = null;
    }

    public function approve(Project $project, int $moderatorId): void
    {
        if ($project->status !== ProjectStatus::Moderation->value) {
            throw new DomainException(__('Одобрить можно только проект на модерации.'));
        }

        $project->status = ProjectStatus::Approved->value;
        $project->moderated_by = $moderatorId;
        $project->moderated_at = now();
        $project->moderation_comment = null;
    }

    public function reject(Project $project, int $moderatorId, string $comment): void
    {
        if ($project->status !== ProjectStatus::Moderation->value) {
            throw new DomainException(__('Отклонить можно только проект на модерации.'));
        }

        $project->status = ProjectStatus::Rejected->value;
        $project->moderated_by = $moderatorId;
        $project->moderated_at = now();
        $project->moderation_comment = $comment;
    }
}
