<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Classe;
use App\Models\Reservation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClasseReservationsTest extends TestCase
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
    public function it_gets_classe_reservations()
    {
        $classe = Classe::factory()->create();
        $reservations = Reservation::factory()
            ->count(2)
            ->create([
                'classe_id' => $classe->id,
            ]);

        $response = $this->getJson(
            route('api.classes.reservations.index', $classe)
        );

        $response->assertOk()->assertSee($reservations[0]->Ddebut);
    }

    /**
     * @test
     */
    public function it_stores_the_classe_reservations()
    {
        $classe = Classe::factory()->create();
        $data = Reservation::factory()
            ->make([
                'classe_id' => $classe->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.classes.reservations.store', $classe),
            $data
        );

        unset($data['Ddebut']);
        unset($data['Dfin']);
        unset($data['user_id']);

        $this->assertDatabaseHas('reservations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $reservation = Reservation::latest('id')->first();

        $this->assertEquals($classe->id, $reservation->classe_id);
    }
}
