<?php

declare(strict_types = 1);

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

it('should be able to create a new question bigger than 255 characters', function () {
    // Arrange :: Preparar
    $user = User::factory()->create();
    actingAs($user); // Função que faz agir como o usuário, ele vai logar com o usuário de teste

    // Act :: Agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . "?",
    ]);

    // Assert :: Verificar
    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);
});
