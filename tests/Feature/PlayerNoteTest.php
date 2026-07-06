<?php
//tests/Feature/PlayerNoteTest.php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Player;
use App\Models\PlayerNote;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Livewire;
use App\Livewire\PlayerNotes;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlayerNoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_support_agent_can_create_note(): void
    {
        // Setup permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $permission = Permission::create(['name' => 'create player note']);
        $role = Role::create(['name' => 'support_agent']);
        $role->givePermissionTo($permission);

        // Create user with role
        $user = User::factory()->create();
        $user->assignRole('support_agent');

        // Create player
        $player = Player::create(['name' => 'Test Player', 'email' => 'test@test.com']);

        // Test Livewire component
        Livewire::actingAs($user)
            ->test(PlayerNotes::class, ['player' => $player])
            ->set('content', 'This is a test note')
            ->call('saveNote')
            ->assertHasNoErrors();

        // Verify in database
        $this->assertDatabaseHas('player_notes', [
            'player_id' => $player->id,
            'user_id' => $user->id,
            'content' => 'This is a test note',
        ]);
    }

    public function test_viewer_cannot_see_create_form(): void
    {
        // Setup permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'create player note']);
        Permission::create(['name' => 'view player notes']);
        $role = Role::create(['name' => 'viewer']);
        $role->givePermissionTo('view player notes');

        $user = User::factory()->create();
        $user->assignRole('viewer');

        $player = Player::create(['name' => 'Test Player', 'email' => 'test@test.com']);

        Livewire::actingAs($user)
            ->test(PlayerNotes::class, ['player' => $player])
            ->assertDontSee('Add Note');
    }
}