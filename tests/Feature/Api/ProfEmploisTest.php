<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Prof;
use App\Models\Emploi;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfEmploisTest extends TestCase
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
    public function it_gets_prof_emplois()
    {
        $prof = Prof::factory()->create();
        $emplois = Emploi::factory()
            ->count(2)
            ->create([
                'prof_id' => $prof->id,
            ]);

        $response = $this->getJson(route('api.profs.emplois.index', $prof));

        $response->assertOk()->assertSee($emplois[0]->Ddebut);
    }

    /**
     * @test
     */
    public function it_stores_the_prof_emplois()
    {
        $prof = Prof::factory()->create();
        $data = Emploi::factory()
            ->make([
                'prof_id' => $prof->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.profs.emplois.store', $prof),
            $data
        );

        $this->assertDatabaseHas('emplois', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $emploi = Emploi::latest('id')->first();

        $this->assertEquals($prof->id, $emploi->prof_id);
    }
}
