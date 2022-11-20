<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Emploi;

use App\Models\Prof;
use App\Models\Salle;
use App\Models\Classe;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmploiTest extends TestCase
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
    public function it_gets_emplois_list()
    {
        $emplois = Emploi::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.emplois.index'));

        $response->assertOk()->assertSee($emplois[0]->Ddebut);
    }

    /**
     * @test
     */
    public function it_stores_the_emploi()
    {
        $data = Emploi::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.emplois.store'), $data);

        $this->assertDatabaseHas('emplois', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_emploi()
    {
        $emploi = Emploi::factory()->create();

        $classe = Classe::factory()->create();
        $salle = Salle::factory()->create();
        $user = User::factory()->create();
        $prof = Prof::factory()->create();

        $data = [
            'Ddebut' => $this->faker->text(255),
            'Dfin' => $this->faker->text(255),
            'classe_id' => $classe->id,
            'salle_id' => $salle->id,
            'user_id' => $user->id,
            'prof_id' => $prof->id,
        ];

        $response = $this->putJson(route('api.emplois.update', $emploi), $data);

        $data['id'] = $emploi->id;

        $this->assertDatabaseHas('emplois', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_emploi()
    {
        $emploi = Emploi::factory()->create();

        $response = $this->deleteJson(route('api.emplois.destroy', $emploi));

        $this->assertModelMissing($emploi);

        $response->assertNoContent();
    }
}
