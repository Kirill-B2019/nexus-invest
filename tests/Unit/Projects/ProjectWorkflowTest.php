<?php

namespace Tests\Unit\Projects;

use App\Domain\Projects\ProjectWorkflow;
use App\Models\Project;
use App\Models\User;
use DomainException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_submit_for_moderation_changes_status_and_submitted_at(): void
    {
        $user = User::factory()->create();
        $project = Project::create([
            'user_id' => $user->id,
            'status' => Project::STATUS_DRAFT,
        ]);

        $workflow = app(ProjectWorkflow::class);
        $workflow->submitForModeration($project);

        $this->assertSame(Project::STATUS_MODERATION, $project->status);
        $this->assertNotNull($project->submitted_at);
    }

    public function test_approve_throws_exception_for_non_moderation_status(): void
    {
        $this->expectException(DomainException::class);

        $user = User::factory()->create();
        $project = Project::create([
            'user_id' => $user->id,
            'status' => Project::STATUS_DRAFT,
        ]);

        $workflow = app(ProjectWorkflow::class);
        $workflow->approve($project, $user->id);
    }
}
