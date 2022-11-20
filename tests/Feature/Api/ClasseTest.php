<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Classe;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClasseTest extends TestCase
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
    public function it_gets_classes_list()
    {
        $classes = Classe::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.classes.index'));

        $response->assertOk()->assertSee($classes[0]->nom);
    }

    /**
     * @test
     */
    public function it_stores_the_classe()
    {
        $data = Classe::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.classes.store'), $data);

        $this->assertDatabaseHas('classes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_classe()
    {
        $classe = Classe::factory()->create();

        $data = [
            'nom' => $this->faker->text(255),
            'qte' => $this->faker->randomNumber(0),
        ];

        $response = $this->putJson(route('api.classes.update', $classe), $data);

        $data['id'] = $classe->id;

        $this->assertDatabaseHas('classes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_classe()
    {
        $classe = Classe::factory()->create();

        $response = $this->deleteJson(route('api.classes.destroy', $classe));

        $this->assertModelMissing($classe);

        $response->assertNoContent();
    }
}
