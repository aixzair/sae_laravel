<?php

namespace tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;


class ConnexionTest extends TestCase
{
    

    /**
     * Tests the connection of members under different roles.
     *
     * @return void
     */
    public function testConnexionRolesSecretaryFunctional()
    {
        // Test connection for role 1 (Secretary)
        $response = $this->post('/gestionAuthentification', [
            'email' => 'abigail.garcia@gmail.com',
            'password' => 'Sunsh1n3!',
        ]);
		
        $response->assertStatus(200); // Check if the request was redirected
        $response->assertSessionHas('role', 1);// Verify the value of the session variable is the same of the secretary role

    }
	
	public function testConnexionRolesSecretaryError()
    {	
        // Test error connection for role 1 (Secretary) with incorrect password
        $response = $this->post('/gestionAuthentification', [
            'email' => 'abigail.garcia@gmail.com',
            'password' => 'Sunsh1',
        ]);
		
        $response->assertStatus(200); // Check if the request was redirected
        $response->assertSessionHas('role', 0);// Verify that the session variable corresponds to 0 (the error)

    }
	
	public function testConnexionRolesMemberFunctional()
    {
        // Test connection for role 3 (Surface Security)
        $response = $this->post('/gestionAuthentification', [
            'email' => 'benjamin.allen@gmail.com',
            'password' => 'S@il0rM@rs',
        ]);
		
        $response->assertStatus(200); 
        $response->assertSessionHas('role', 3);// Verify that the session variable corresponds to the role of the test

    }
	
	public function testConnexionRolesMemberError()
    {	
        // Test error connection for role 3 (Surface Security) with incorrect password
        $response = $this->post('/gestionAuthentification', [
            'email' => 'benjamin.allen@gmail.com',
            'password' => 'S@il0rM@',
        ]);
		
        $response->assertStatus(200); // Check if the request was redirected
        $response->assertSessionHas('role', 0);// Verify that the session variable corresponds to 0 (the error)

    }
	
	
	public function testConnexionRolesDirectorFunctional()
    {
        // Test connection for role 5 (Dive Director)
        $response = $this->post('/gestionAuthentification', [
            'email' => 'ella.robinson@gmail.com',
            'password' => 'WinterSn0w*',
        ]);
		
        $response->assertStatus(200); // Check if the request was redirected
        $response->assertSessionHas('role', 5);// Verify that the session variable corresponds to the role of the test

    }
	
		public function testConnexionRolesDirectorError()
    {	
        // Test connection for role 5 (Dive Director) with incorrect password
        $response = $this->post('/gestionAuthentification', [
            'email' => 'ella.robinson@gmail.com',
            'password' => 'WinterS',
        ]);
		
        $response->assertStatus(200); // Check if the request was redirected
        $response->assertSessionHas('role', 0);// Verify that the session variable corresponds to 0 (the error)

    }
	
	public function testConnexionRolesResponsibleFunctional()
    {
        // Test connection for role 6 (Dive Supervisor)
        $response = $this->post('/gestionAuthentification', [
            'email' => 'emma.smith@gmail.com',
            'password' => 'P@ssw0rd123',
        ]);
		
        $response->assertStatus(200); // Check if the request was redirected
        $response->assertSessionHas('role', 6);// Verify that the session variable corresponds to the role of the test

    }
		public function testConnexionRolesResponsibleError()
    {	
        // Test connection for role 6 (Dive Supervisor) with incorrect email
        $response = $this->post('/gestionAuthentification', [
            'email' => 'emma.smith@gmail.co',
            'password' => 'P@ssw0rd123',
        ]);
		
        $response->assertStatus(200); // Check if the request was redirected
        $response->assertSessionHas('role', 0);// Verify that the session variable corresponds to 0 (the error)

    }
	
}
