<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\MenuType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuTypeTest extends TestCase
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
    public function it_gets_menu_types_list()
    {
        $menuTypes = MenuType::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.menu-types.index'));

        $response->assertOk()->assertSee($menuTypes[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_menu_type()
    {
        $data = MenuType::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.menu-types.store'), $data);

        $this->assertDatabaseHas('menu_types', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_menu_type()
    {
        $menuType = MenuType::factory()->create();

        $data = [
            'date' => $this->faker->dateTime,
        ];

        $response = $this->putJson(
            route('api.menu-types.update', $menuType),
            $data
        );

        $data['id'] = $menuType->id;

        $this->assertDatabaseHas('menu_types', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_menu_type()
    {
        $menuType = MenuType::factory()->create();

        $response = $this->deleteJson(
            route('api.menu-types.destroy', $menuType)
        );

        $this->assertDeleted($menuType);

        $response->assertNoContent();
    }
}
