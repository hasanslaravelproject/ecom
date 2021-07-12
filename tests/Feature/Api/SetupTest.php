<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Setup;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SetupTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_setups_list()
    {
        $setups = Setup::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.setups.index'));

        $response->assertOk()->assertSee($setups[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_setup()
    {
        $data = Setup::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.setups.store'), $data);

        $this->assertDatabaseHas('setups', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_setup()
    {
        $setup = Setup::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->putJson(route('api.setups.update', $setup), $data);

        $data['id'] = $setup->id;

        $this->assertDatabaseHas('setups', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_setup()
    {
        $setup = Setup::factory()->create();

        $response = $this->deleteJson(route('api.setups.destroy', $setup));

        $this->assertDeleted($setup);

        $response->assertNoContent();
    }
}
