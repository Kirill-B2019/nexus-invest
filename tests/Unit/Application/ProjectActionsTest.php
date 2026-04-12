<?php

namespace Tests\Unit\Application;

use App\Application\Projects\ModerateProjectAction;
use App\Application\Projects\SubmitProjectForModerationAction;
use App\Events\ProjectApproved;
use App\Events\ProjectSubmitted;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ProjectActionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_submit_action_dispatches_project_submitted_event(): void
    {
        Event::fake([ProjectSubmitted::class]);

        $user = User::factory()->create();
        $project = Project::create([
            'user_id' => $user->id,
            'status' => Project::STATUS_DRAFT,
            'name' => 'Test',
            'pitch' => 'Pitch',
            'description' => 'Description',
        ]);

        $action = app(SubmitProjectForModerationAction::class);
        $action->handle($project, [
            'name' => 'Test',
            'pitch' => 'Pitch',
            'description' => 'Description',
        ]);

        Event::assertDispatched(ProjectSubmitted::class);
        $this->assertSame(Project::STATUS_MODERATION, $project->fresh()->status);
    }

    public function test_moderate_action_dispatches_project_approved_event(): void
    {
        Event::fake([ProjectApproved::class]);

        $owner = User::factory()->create();
        $moderator = User::factory()->create();
        $project = Project::create([
            'user_id' => $owner->id,
            'status' => Project::STATUS_MODERATION,
            'name' => 'Test',
            'pitch' => 'Pitch',
            'description' => 'Description',
        ]);

        $action = app(ModerateProjectAction::class);
        $action->handle($project, $moderator, 'approve');

        Event::assertDispatched(ProjectApproved::class);
        $this->assertSame(Project::STATUS_APPROVED, $project->fresh()->status);
    }
}
