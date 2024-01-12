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
        $response = $this->post('{{ route(\'session/edit.submit\') }}',
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


    }

    /**
     * Check the edit without changing the period (morning, afternoon, evening) and date.
     *
     * @return void
     */
    public function testEditWithoutPeriodAndDate()
    {
        $response = $this->post('{{ route(\'session/edit.submit\') }}',
        [
            'pilot' => 'ella.robinson@gmail.com',
            'security' => 'abigail.garcia@gmail.com',
            'director' => 'ethan.jackson@gmail.com',
            'boat' => '1',
            'pSession' => '3',
            'pDate' => '2024-01-22'
        ]);

        
    }
}
