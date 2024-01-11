<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class sessionListMaker extends Controller
{
    function getMonthlySessions($month)
    {
        $year = date("Y");
        $fDay = date_create($year.'-'.$month.'-1');
        $lDay = date_create($year.'-'.($month+1).'-1');

        $result = DB::Select(
            "SELECT PLON_DATE FROM PLONGEE WHERE PLON_DATE >= ? AND PLON_DATE < ?",
            [$fDay, $lDay]
        );
        foreach($result as $line)
        {
            echo "<div class=\"session\"> ".$line->PLON_DATE."</div>";
        }
    }
}
