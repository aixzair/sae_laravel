<?php

namespace tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;


class ConnexionTest extends TestCase
{
    

    /**
     * Teste la connexion des adhérents sous différents rôles.
     *
     * @return void
     */
    public function testConnexionRolesSecretaireFonctionnelle()
    {
        // Teste la connexion pour le rôle 1 (Secrétaire)
        $response = $this->post('/gestionAuthentification', [
            'email' => 'abigail.garcia@gmail.com',
            'password' => 'Sunsh1n3!',
        ]);
		
        $response->assertStatus(200); // Vérifie si la requête a été redirigée
        $response->assertSessionHas('role', 1);

    }
	
	/*public function testConnexionRolesSecretaireErreur ()
    {	/*Pas fini*/
        // Teste la connexion pour le rôle 1 (Secrétaire)
        /*$response = $this->post('/gestionAuthentification', [
            'email' => 'abigail.garcia@gmail.com',
            'password' => 'Sunsh1n3!',
        ]);
		
        $response->assertStatus(200); // Vérifie si la requête a été redirigée
        $response->assertSessionHas('role', null);

    }*/
	
	public function testConnexionRolesAdhérentFonctionnelle()
    {
        // Teste la connexion pour le rôle 3 (Sécurité)
        $response = $this->post('/gestionAuthentification', [
            'email' => 'benjamin.allen@gmail.com',
            'password' => 'S@il0rM@rs',
        ]);
		
        $response->assertStatus(200); // Vérifie si la requête a été redirigée
        $response->assertSessionHas('role', 3);

    }
	
	
	public function testConnexionRolesDirecteurFonctionnelle()
    {
        // Teste la connexion pour le rôle 6 (Directeur de plongée)
        $response = $this->post('/gestionAuthentification', [
            'email' => 'ella.robinson@gmail.com',
            'password' => 'WinterSn0w*',
        ]);
		
        $response->assertStatus(200); // Vérifie si la requête a été redirigée
        $response->assertSessionHas('role', 5);

    }
	
	public function testConnexionRolesResponsableFonctionnelle()
    {
        // Teste la connexion pour le rôle 6 (Responsable de plongée)
        $response = $this->post('/gestionAuthentification', [
            'email' => 'emma.smith@gmail.com',
            'password' => 'P@ssw0rd123',
        ]);
		
        $response->assertStatus(200); // Vérifie si la requête a été redirigée
        $response->assertSessionHas('role', 6);

    }
	
}
