<?php
//use App\Models\sessionListModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PlongeeController;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    <title>Mes Plongées</title>
</head>

<body>
    @include('header')
    <main>
        <div class="monthContainer">
            <div class="scroll">
                <?php
                /**
                 * Get and displays the list of dives for the selected month
                 *
                 * @param [type] $month
                 * @return void
                 */
                function getMonthlySessions($month)
                {
                    $year = date("Y");
                    $fDay = date_create($year . '-' . $month . '-01');
                    $lDay = date_create($year . '-' . ($month + 1) . '-01');

                    $result = DB::Select("
                        SELECT SEA_ID, PLON_DATE, PLON_DEBUT, PLON_FIN, PLON_EFFECTIFS_MAX, PLON_EFFECTIFS_MIN
                        FROM PLONGEE 
                        JOIN adherent on ad_email = plon_directeur
                        WHERE PLON_DATE >= '2024-04-01' AND PLON_DATE < '2024-05-01'
                            AND ad_email = '".session('email')."'
                        ORDER BY PLON_DATE ASC
                    ");


                    foreach ($result as $line) {
                        $year = date("Y");
                        $fDay = date_create($year . '-' . $month . '-1');
                        $lDay = date_create($year . '-' . ($month + 1) . '-1');
                        //Also needs to get validity of session (show checkbox if yes, greys out if not)
                        /*$result = DB::Select(
                    "SELECT SEA_ID, PLON_DATE, PLON_DEBUT, PLON_FIN, PLON_EFFECTIFS_MAX, PLON_EFFECTIFS_MIN
                    FROM PLONGEE WHERE PLON_DATE >= ? AND PLON_DATE < ?
                    ORDER BY PLON_DATE ASC",
                    [$fDay, $lDay]
                );*/
                        //DD-MM-YYYY HH-mm format
                        $sea_id = $line->SEA_ID;
                        $plon_date = $line->PLON_DATE;
                        $fSessionDate = date("d-m-Y", strtotime($line->PLON_DATE));
                        $startingTime = date("H:i", strtotime($line->PLON_DEBUT));
                        $endingTime = date("H:i", strtotime($line->PLON_FIN));

                        //Changes background color if session is valid, invalid or full
                        if ($complete = PlongeeController::isComplete($sea_id, $plon_date)) {
                            //If full, container is redMarked
                            echo "<div class=\"redMarked session ";
                        } else {
                            echo "<div class=\"session ";
                        }
                        if (PlongeeController::isValid($sea_id, $plon_date)) {
                            if (!$complete) {
                                echo "greenMarked\">";
                            } else {
                                echo "\">";
                            }
                            // echo "<a href='{{ route('palanquees', ['PLON_DATE' => $plon_date, 'SEA_ID' => $sea_id]) }}'>
                            //     <p>{{ $plon_date }} {{ $startingTime }} à {{ $endingTime }}</p>
                            // </a>";

                            ?>

                            <form action="{{ route('directionPalanquees', ['PLON_DATE' => $plon_date, 'SEA_ID' => $sea_id]) }}" method="post">
                            @csrf
                            <input type="hidden" name="sea_id" value="{{$sea_id}}">
                            <input type="hidden" name="plon_date" value="{{$plon_date}}">
                                <button type="submit" style="border: none; background: none; cursor: pointer;">
                                    <p>{{ $plon_date }} {{ $startingTime }} à {{ $endingTime }}</p>
                                </button>
                            </form>

                        <?php

                        } else {
                            echo "\">";
                            echo "<p> " . $plon_date . ' ' . $startingTime . ' à ' . $endingTime . "</p><p></p>";
                        }


                        echo "</div>";
                    }
                }

                ?>
                <div id="Mars" class="month" ;>
                    <?php
                    getMonthlySessions(3);
                    ?>
                </div>
                <div id="Avril" class="month" style="display:none">
                    <?php
                    getMonthlySessions(4);
                    ?>
                </div>
                <div id="Mai" class="month" style="display:none">
                    <?php
                    getMonthlySessions(5);
                    ?>
                </div>
                <div id="Juin" class="month" style="display:none">
                    <?php
                    getMonthlySessions(6);
                    ?>
                </div>
                <div id="Juillet" class="month" style="display:none">
                    <?php
                    getMonthlySessions(7);
                    ?>
                </div>
                <div id="Aout" class="month" style="display:none">
                    <?php
                    getMonthlySessions(8);
                    ?>
                </div>
                <div id="Septembre" class="month" style="display:none">
                    <?php
                    getMonthlySessions(9);
                    ?>
                </div>
                <div id="Octobre" class="month" style="display:none">
                    <?php
                    getMonthlySessions(10);
                    ?>
                </div>
            </div>
    </main>
</body>
<script>
    const ingredientContainer = document.querySelector(".ingredient-container");
    const categorieTriggers = document.querySelectorAll(".categorie");

    categorieTriggers.forEach(trigger =>
        trigger.addEventListener("click", () => {
            categorieContainer.classList.toggle("active");
        })
    );

    function openMonth(monthName) {
        var i;
        var x = document.getElementsByClassName("month");
        var y = document.getElementsByClassName("monthButton");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
            y[i].style.backgroundColor = 'white';
            y[i].style.borderBottomStyle = "solid";
        }
        document.getElementById(monthName).style.display = "block";
        document.getElementById("bt" + monthName).style.backgroundColor = 'grey';
        document.getElementById("bt" + monthName).style.borderBottomStyle = "none";
    }
</script>

</html>