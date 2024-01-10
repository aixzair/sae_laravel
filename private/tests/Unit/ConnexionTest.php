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
        $response->assertSessionHas('role', 1);//Verifie la valeur de la variable de session

    }
	
	public function testConnexionRolesSecretaireErreur ()
    {	/*Pas fini*/
        // Teste la connexion pour le rôle 1 (Secrétaire)
        $response = $this->post('/gestionAuthentification', [
            'email' => 'abigail.garcia@gmail.com',
            'password' => 'Sunsh1',
        ]);
		
        $response->assertStatus(200); // Vérifie si la requête a été redirigée
        $response->assertSessionHas('role', 0);//Verifie la valeur de la variable de session

    }
	
	public function testConnexionRolesAdhérentFonctionnelle()
    {
        // Teste la connexion pour le rôle 3 (Sécurité de Surface)
        $response = $this->post('/gestionAuthentification', [
            'email' => 'benjamin.allen@gmail.com',
            'password' => 'S@il0rM@rs',
        ]);
		
        $response->assertStatus(200); // Vérifie si la requête a été redirigée
        $response->assertSessionHas('role', 3);//Verifie la valeur de la variable de session

    }
	
	public function testConnexionRolesAdhérentErreur ()
    {	/*Pas fini*/
        // Teste la connexion pour le rôle 3 (Sécurité de Surface)
        $response = $this->post('/gestionAuthentification', [
            'email' => 'benjamin.allen@gmail.com',
            'password' => 'S@il0rM@',
        ]);
		
        $response->assertStatus(200); // Vérifie si la requête a été redirigée
        $response->assertSessionHas('role', 0);//Verifie la valeur de la variable de session

    }
	
	
	public function testConnexionRolesDirecteurFonctionnelle()
    {
        // Teste la connexion pour le rôle 6 (Directeur de plongée)
        $response = $this->post('/gestionAuthentification', [
            'email' => 'ella.robinson@gmail.com',
            'password' => 'WinterSn0w*',
        ]);
		
        $response->assertStatus(200); // Vérifie si la requête a été redirigée
        $response->assertSessionHas('role', 5);//Verifie la valeur de la variable de session

    }
	
		public function testConnexionRolesDirecteurErreur ()
    {	/*Pas fini*/
        // Teste la connexion pour le rôle 3 (Directeur de plongée)
        $response = $this->post('/gestionAuthentification', [
            'email' => 'ella.robinson@gmail.com',
            'password' => 'WinterS',
        ]);
		
        $response->assertStatus(200); // Vérifie si la requête a été redirigée
        $response->assertSessionHas('role', 0);//Verifie la valeur de la variable de session

    }
	
	public function testConnexionRolesResponsableFonctionnelle()
    {
        // Teste la connexion pour le rôle 6 (Responsable de plongée)
        $response = $this->post('/gestionAuthentification', [
            'email' => 'emma.smith@gmail.com',
            'password' => 'P@ssw0rd123',
        ]);
		
        $response->assertStatus(200); // Vérifie si la requête a été redirigée
        $response->assertSessionHas('role', 6);//Verifie la valeur de la variable de session

    }
		public function testConnexionRolesResponsableErreur ()
    {	/*Pas fini*/
        // Teste la connexion pour le rôle 6 (Responsable de plongée)
        $response = $this->post('/gestionAuthentification', [
            'email' => 'emma.smith@gmail.co',
            'password' => 'P@ssw0rd123',
        ]);
		
        $response->assertStatus(200); // Vérifie si la requête a été redirigée
        $response->assertSessionHas('role', 0);//Verifie la valeur de la variable de session

    }
	
}
