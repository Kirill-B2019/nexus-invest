<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\ProjectDocument;
use App\Models\ProjectImage;
use App\Models\User;

class ProjectPolicy
{
    public function view(User $user, Project $project): bool
    {
        return $project->user_id === $user->id || $user->hasRole('super-admin') || $user->can('moderate-projects');
    }

    public function update(User $user, Project $project): bool
    {
        return $project->user_id === $user->id && $project->canEdit();
    }

    public function submit(User $user, Project $project): bool
    {
        return $project->user_id === $user->id && $project->canSubmit();
    }

    public function moderate(User $user, Project $project): bool
    {
        if (! ($user->hasRole('super-admin') || $user->can('moderate-projects'))) {
            return false;
        }

        return $project->status === Project::STATUS_MODERATION;
    }

    public function deleteImage(User $user, Project $project, ProjectImage $image): bool
    {
        return $this->update($user, $project) && $image->project_id === $project->id;
    }

    public function deleteDocument(User $user, Project $project, ProjectDocument $document): bool
    {
        return $this->update($user, $project) && $document->project_id === $project->id;
    }
}
