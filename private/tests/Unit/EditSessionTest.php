<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class EditSessionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_editAllValues()
    {
        $response = $this->post('{{ route(\'session/edit.submit\') }}',
        [
            'day-start' => '2024-01-22',
            'session' => 'morning'
        ]);
    }
}
