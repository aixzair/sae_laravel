<?php

namespace tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\PlongeeModel;

class PlongeeTest extends TestCase{

    public function testSessionListWorks(){
        $response = $this->get('/sessionList');
        $response->assertStatus(200);
    }

    use RefreshDatabase;

    /**
     * Test the register method.
     *
     * @return void
     */
    /*public function testRegister()
    {
        $model = new PlongeeModel();

        $sea_id = 2;
        $plon_date = '2024-04-01';
        $user_email = 'chloe.young@gmail.com';

        $this->assertTrue($model->register($sea_id, $plon_date, $user_email));

        $this->assertTrue($model->isRegistered($sea_id, $plon_date, $user_email));
    }*/

    /**
     * Test the unregister method.
     *
     * @return void
     */
    /*public function testUnregister()
    {
        $model = new PlongeeModel();

        $sea_id = 1;
        $plon_date = '2024-04-01';
        $user_email = 'olivier.clark@gmail.com';
        $model->register($sea_id, $plon_date, $user_email);

        $this->assertTrue($model->unregister($sea_id, $plon_date, $user_email));

        $this->assertFalse($model->isRegistered($sea_id, $plon_date, $user_email));
    }*/

    /**
     * Test the isComplete method
     *
     * @return void
     */
    public function testIsComplete(){
        $model = new PlongeeModel();

        $sea_id = 1;
        $plon_date = '2024-04-01';
       $this->assertFalse($model->isComplete($sea_id, $plon_date));
    }
}


?>