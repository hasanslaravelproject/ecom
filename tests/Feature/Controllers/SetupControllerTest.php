<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Setup;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SetupControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_setups()
    {
        $setups = Setup::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('setups.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.setups.index')
            ->assertViewHas('setups');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_setup()
    {
        $response = $this->get(route('setups.create'));

        $response->assertOk()->assertViewIs('app.setups.create');
    }

    /**
     * @test
     */
    public function it_stores_the_setup()
    {
        $data = Setup::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('setups.store'), $data);

        $this->assertDatabaseHas('setups', $data);

        $setup = Setup::latest('id')->first();

        $response->assertRedirect(route('setups.edit', $setup));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_setup()
    {
        $setup = Setup::factory()->create();

        $response = $this->get(route('setups.show', $setup));

        $response
            ->assertOk()
            ->assertViewIs('app.setups.show')
            ->assertViewHas('setup');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_setup()
    {
        $setup = Setup::factory()->create();

        $response = $this->get(route('setups.edit', $setup));

        $response
            ->assertOk()
            ->assertViewIs('app.setups.edit')
            ->assertViewHas('setup');
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

        $response = $this->put(route('setups.update', $setup), $data);

        $data['id'] = $setup->id;

        $this->assertDatabaseHas('setups', $data);

        $response->assertRedirect(route('setups.edit', $setup));
    }

    /**
     * @test
     */
    public function it_deletes_the_setup()
    {
        $setup = Setup::factory()->create();

        $response = $this->delete(route('setups.destroy', $setup));

        $response->assertRedirect(route('setups.index'));

        $this->assertDeleted($setup);
    }
}
