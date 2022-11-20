<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Salle;
use App\Models\Emploi;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalleEmploisTest extends TestCase
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
    public function it_gets_salle_emplois()
    {
        $salle = Salle::factory()->create();
        $emplois = Emploi::factory()
            ->count(2)
            ->create([
                'salle_id' => $salle->id,
            ]);

        $response = $this->getJson(route('api.salles.emplois.index', $salle));

        $response->assertOk()->assertSee($emplois[0]->Ddebut);
    }

    /**
     * @test
     */
    public function it_stores_the_salle_emplois()
    {
        $salle = Salle::factory()->create();
        $data = Emploi::factory()
            ->make([
                'salle_id' => $salle->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.salles.emplois.store', $salle),
            $data
        );

        $this->assertDatabaseHas('emplois', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $emploi = Emploi::latest('id')->first();

        $this->assertEquals($salle->id, $emploi->salle_id);
    }
}
