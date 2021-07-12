<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Company;
use App\Models\Customer;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyCustomersTest extends TestCase
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
    public function it_gets_company_customers()
    {
        $company = Company::factory()->create();
        $customers = Customer::factory()
            ->count(2)
            ->create([
                'comapany_id' => $company->id,
            ]);

        $response = $this->getJson(
            route('api.companies.customers.index', $company)
        );

        $response->assertOk()->assertSee($customers[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_company_customers()
    {
        $company = Company::factory()->create();
        $data = Customer::factory()
            ->make([
                'comapany_id' => $company->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.companies.customers.store', $company),
            $data
        );

        $this->assertDatabaseHas('customers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $customer = Customer::latest('id')->first();

        $this->assertEquals($company->id, $customer->comapany_id);
    }
}
