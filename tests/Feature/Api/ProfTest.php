<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Prof;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfTest extends TestCase
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
    public function it_gets_profs_list()
    {
        $profs = Prof::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.profs.index'));

        $response->assertOk()->assertSee($profs[0]->nom);
    }

    /**
     * @test
     */
    public function it_stores_the_prof()
    {
        $data = Prof::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.profs.store'), $data);

        $this->assertDatabaseHas('profs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_prof()
    {
        $prof = Prof::factory()->create();

        $data = [
            'nom' => $this->faker->text(255),
        ];

        $response = $this->putJson(route('api.profs.update', $prof), $data);

        $data['id'] = $prof->id;

        $this->assertDatabaseHas('profs', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_prof()
    {
        $prof = Prof::factory()->create();

        $response = $this->deleteJson(route('api.profs.destroy', $prof));

        $this->assertModelMissing($prof);

        $response->assertNoContent();
    }
}
