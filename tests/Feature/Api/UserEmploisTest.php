<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Emploi;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserEmploisTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_user_emplois()
    {
        $user = User::factory()->create();
        $emplois = Emploi::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.emplois.index', $user));

        $response->assertOk()->assertSee($emplois[0]->Ddebut);
    }

    /**
     * @test
     */
    public function it_stores_the_user_emplois()
    {
        $user = User::factory()->create();
        $data = Emploi::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.emplois.store', $user),
            $data
        );

        $this->assertDatabaseHas('emplois', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $emploi = Emploi::latest('id')->first();

        $this->assertEquals($user->id, $emploi->user_id);
    }
}
