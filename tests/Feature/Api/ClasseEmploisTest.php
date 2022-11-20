<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Classe;
use App\Models\Emploi;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClasseEmploisTest extends TestCase
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
    public function it_gets_classe_emplois()
    {
        $classe = Classe::factory()->create();
        $emplois = Emploi::factory()
            ->count(2)
            ->create([
                'classe_id' => $classe->id,
            ]);

        $response = $this->getJson(route('api.classes.emplois.index', $classe));

        $response->assertOk()->assertSee($emplois[0]->Ddebut);
    }

    /**
     * @test
     */
    public function it_stores_the_classe_emplois()
    {
        $classe = Classe::factory()->create();
        $data = Emploi::factory()
            ->make([
                'classe_id' => $classe->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.classes.emplois.store', $classe),
            $data
        );

        $this->assertDatabaseHas('emplois', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $emploi = Emploi::latest('id')->first();

        $this->assertEquals($classe->id, $emploi->classe_id);
    }
}
