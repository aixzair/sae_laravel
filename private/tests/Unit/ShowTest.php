<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class ShowTest extends TestCase
{
    /**
     * Check the overview of the session
     *
     * @return void
     */
    public function testShowAllValues()
    {
        $response = $this->post('{{ route(\'plongée/show?SEA_ID=3&PLON_DATE=2024-01-22\') }}',
        [
            'day-start' => '2024-01-22',
            'session' => 'evening',
            'pilot' => 'ella.robinson@gmail.com',
            'security' => 'abigail.garcia@gmail.com',
            'director' => 'ethan.jackson@gmail.com',
            'boat' => '1'
        ]);

        $response->assertSessionHas('role', 2);// Verify that the session variable corresponds to the role of the test
    }

    /**
     * Check the overview if no parameters a set in the URL.
     *
     * @return void
     */
    public function testShowWithoutParametersError()
    {
        $response = $this->post('{{ route(\'plongée/show\') }}',
        [
            'day-start' => '3',
            'session' => '2024-01-22',
            'pilot' => 'ella.robinson@gmail.com',
            'security' => 'abigail.garcia@gmail.com',
            'director' => 'ethan.jackson@gmail.com',
            'boat' => '1'
        ]);

        $response->assertSessionHas('role', 2);// Verify that the session variable corresponds to the role of the test
    }
}
