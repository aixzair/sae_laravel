<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class sessionListMaker extends Model
{
    use HasFactory;

    static function getMonthlySessions($month)
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
