<?php

namespace Tests\Unit;

use App\Http\Controllers\PlongeeController;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function PHPUnit\Framework\assertTrue;

class sessionListTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function isRegisteredTest()
    {
        $date = date_create('2024-04-07');
        $sea_id = 2;

        session()->put('email', 'elijah.lewis@gmail.com');
        session()->put('password', 'P@ssw0rd123!');

        
        $this->assertTrue(PlongeeController::isRegistered($sea_id, $date, session('email')));
        $this->assertEquals(DB::select(
            "SELECT COUNT(*) FROM INSCRIRE
            WHERE AD_EMAIL = ? AND SEA_ID =  ? AND PLON_DATE =  ?",
            [session('email'), $sea_id, $date]
        ), 1);
    }

    public function registerTest()
    {
        $date = date_create('2024-10-01');
        $sea_id = 2;

        session()->put('email', 'emma.smith@gmail.com');
        session()->put('password', 'P@ssw0rd123');

        $this->assertEquals(DB::select(
            "SELECT COUNT(*) FROM INSCRIRE
            WHERE AD_EMAIL = ? AND SEA_ID =  ? AND PLON_DATE =  ?",
            [session('email'), $sea_id, $date]
        ), 0);

        PlongeeController::register($date, $sea_id);

        $this->assertEquals(DB::select(
            "SELECT COUNT(*) FROM INSCRIRE
            WHERE AD_EMAIL = ? AND SEA_ID =  ? AND PLON_DATE =  ?",
            [session('email'), $sea_id, $date]
        ), 1);
    }

    public function unregisterTest()
    {
        $date = date_create('2024-10-02');
        $sea_id = 2;

        session()->put('email', 'elijah.lewis@gmail.com');
        session()->put('password', 'P@ssw0rd123!');

        PlongeeController::register($date, $sea_id);

        $this->assertEquals(DB::select(
            "SELECT COUNT(*) FROM INSCRIRE
            WHERE AD_EMAIL = ? AND SEA_ID =  ? AND PLON_DATE =  ?",
            [session('email'), $sea_id, $date]
        ), 1);

        PlongeeController::unregister($date, $sea_id);

        $this->assertEquals(DB::select(
            "SELECT COUNT(*) FROM INSCRIRE
            WHERE AD_EMAIL = ? AND SEA_ID =  ? AND PLON_DATE =  ?",
            [session('email'), $sea_id, $date]
        ), 0);
    }

    public function isComplete()
    {
        $date = date_create('2024-04-02');
        $sea_id = 1;

        $nb_plon = DB::select(
            "SELECT PLON_EFFECTIFS_MAX FROM PLONGEE
            WHERE SEA_ID =  ? AND PLON_DATE =  ?",
            [$sea_id, $date]
        );
        
        $this->assertTrue(PlongeeController::isComplete($sea_id, $date));
        $this->assertEquals(DB::select(
            "SELECT COUNT(*) FROM INSCRIRE
            WHERE SEA_ID =  ? AND PLON_DATE =  ?",
            [$sea_id, $date]
        ), $nb_plon);
    }

    public function isRightLevel()
    {
        $date1 = date_create('2024-04-02');
        $date2 = date_create('2024-04-02');
        $sea_id = 1;

        session()->put('email', 'elijah.lewis@gmail.com');
        session()->put('password', 'P@ssw0rd123!');

        $nivMin = DB::select(
            "SELECT PLON_NIVEAU FROM PLONGEE
            WHERE SEA_ID =  ? AND PLON_DATE =  ?",
            [$sea_id, $date1]
        );

        $nivUser = DB::select(
            "SELECT AD_NIVEAU FROM ADHERENT
            WHERE AD_EMAIL =  ?",
            [session('email')]
        );

        assertTrue($nivUser >= $nivMin);

    }

    public function isValid()
    {
        
    }

    public function listDivers()
    {
        
    }
}
