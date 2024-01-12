<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class EditSessionTest extends TestCase
{
    /**
     * Check the edit of this specific session
     *
     * @return void
     */
    public function testEditAllValues()
    {
        $response = $this->post('{{ route(\'plongée/edit?SEA_ID=3&PLON_DATE=2024-01-22\') }}',
        [
            'day-start' => '2024-05-24',
            'session' => 'morning',
            'pilot' => 'ella.robinson@gmail.com',
            'security' => 'abigail.garcia@gmail.com',
            'director' => 'ethan.jackson@gmail.com',
            'boat' => '1',
            'pSession' => '3',
            'pDate' => '2024-01-22'
        ]);

        $response->assertSessionHas('role', 6);// Verify that the session variable corresponds to the role of the test
    }

    /**
     * Check the edit without changing the niche (morning, afternoon, evening) and date.
     *
     * @return void
     */
    public function testEditWithoutPeriodAndDate()
    {
        $response = $this->post('{{ route(\'plongée/edit?SEA_ID=3&PLON_DATE=2024-01-22\') }}',
        [
            'pilot' => 'ella.robinson@gmail.com',
            'security' => 'abigail.garcia@gmail.com',
            'director' => 'ethan.jackson@gmail.com',
            'boat' => '1',
            'pSession' => '3',
            'pDate' => '2024-01-22'
        ]);

        $response->assertSessionHas('role', 6);// Verify that the session variable corresponds to the role of the test
    }
}
