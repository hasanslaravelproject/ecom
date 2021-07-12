<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\MenuType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuTypeControllerTest extends TestCase
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
    public function it_displays_index_view_with_menu_types()
    {
        $menuTypes = MenuType::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('menu-types.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.menu_types.index')
            ->assertViewHas('menuTypes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_menu_type()
    {
        $response = $this->get(route('menu-types.create'));

        $response->assertOk()->assertViewIs('app.menu_types.create');
    }

    /**
     * @test
     */
    public function it_stores_the_menu_type()
    {
        $data = MenuType::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('menu-types.store'), $data);

        $this->assertDatabaseHas('menu_types', $data);

        $menuType = MenuType::latest('id')->first();

        $response->assertRedirect(route('menu-types.edit', $menuType));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_menu_type()
    {
        $menuType = MenuType::factory()->create();

        $response = $this->get(route('menu-types.show', $menuType));

        $response
            ->assertOk()
            ->assertViewIs('app.menu_types.show')
            ->assertViewHas('menuType');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_menu_type()
    {
        $menuType = MenuType::factory()->create();

        $response = $this->get(route('menu-types.edit', $menuType));

        $response
            ->assertOk()
            ->assertViewIs('app.menu_types.edit')
            ->assertViewHas('menuType');
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

        $response = $this->put(route('menu-types.update', $menuType), $data);

        $data['id'] = $menuType->id;

        $this->assertDatabaseHas('menu_types', $data);

        $response->assertRedirect(route('menu-types.edit', $menuType));
    }

    /**
     * @test
     */
    public function it_deletes_the_menu_type()
    {
        $menuType = MenuType::factory()->create();

        $response = $this->delete(route('menu-types.destroy', $menuType));

        $response->assertRedirect(route('menu-types.index'));

        $this->assertDeleted($menuType);
    }
}
