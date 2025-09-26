<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginViewTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste 1: Garante que um visitante (não logado) consegue
     * ver a página de login sem problemas.
     * @test
     */
    public function a_guest_can_view_the_login_page(): void
    {
        // Act: Acessa a rota de login
        $response = $this->get(route('login'));

        // Assert: Verifica se a página carregou com sucesso e mostra o texto 'Email'
        $response->assertStatus(200);
        $response->assertSee('Email');
    }

    /**
     * Teste 2: Garante que um usuário já autenticado é redirecionado
     * para longe da página de login.
     * @test
     */
    public function an_authenticated_user_is_redirected_from_the_login_page(): void
    {
        // Arrange: Cria um usuário (professor, por padrão) e o define como logado
        $user = User::factory()->create();
        $this->actingAs($user);

        // Act: Tenta acessar a rota de login
        $response = $this->get(route('login'));

        // Assert: Verifica se foi redirecionado para o painel do professor
        $response->assertRedirect(route('documents.dashboard'));
    }
}