<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class AddTest extends TestCase
{
    /**
     * Check the add with all values
     *
     * @return void
     */
    public function testAddAllValues()
    {
        $response = $this->post('{{ route(\'session/add.submit\') }}',
        [
            'day-start' => '2024-05-24',
            'session' => 'morning',
            'pilot' => 'ella.robinson@gmail.com',
            'security' => 'abigail.garcia@gmail.com',
            'director' => 'ethan.jackson@gmail.com',
            'boat' => '1',
        ]);


    }

    /**
     * Check the add with some values
     *
     * @return void
     */
    public function testAddWithSomeValues()
    {
        $response = $this->post('{{ route(\'session/add.submit\') }}',
        [
            'day-start' => '2024-05-24',
            'session' => 'morning',
            'security' => 'abigail.garcia@gmail.com',
            'director' => 'ethan.jackson@gmail.com'
        ]);

        $response->assertSessionHas('role', 6);// Verify that the session variable corresponds to the role of the test
    }

    /**
     * Check the add without niche and date (required).
     *
     * @return void
     */
    public function testAddValueError()
    {
        $response = $this->post('{{ route(\'plongée/add.submit\') }}',
        [
            'pilot' => 'ella.robinson@gmail.com',
            'security' => 'abigail.garcia@gmail.com',
            'director' => 'ethan.jackson@gmail.com',
            'boat' => '1'
        ]);

        $response->assertSessionHas('role', 6);// Verify that the session variable corresponds to the role of the test
    }
}
