<?php
    //use App\Models\sessionListModel;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <title>Liste Séance</title>
</head>
<body>
  <header>
    <img class = "Logo" src="{{ asset('/images/logo.png')}}" alt="Logo">
    <nav>
      <div class="NavBar">
        <p class="NavText">Plongées annuelles restantes : 90</p>
        <button class = "NavButton">RESERVER SÉANCE</button>
        <button class = "NavButton">PROFIL</button>
        <img id="Logout" src="{{ asset('images/right-from-bracket-solid.svg') }}" alt="Déconnexion">
      </div>
    </nav>
  </header>
  <div class="monthContainer">
    <div class="monthBar">
        <button id="btMars" class="monthButton" onclick="openMonth('Mars')" style="background-color: grey; border-bottom-style: none;">Mars</button>
        <button id="btAvril" class="monthButton" onclick="openMonth('Avril')">Avril</button>
        <button id="btMai" class="monthButton" onclick="openMonth('Mai')">Mai</button>
        <button id="btJuin" class="monthButton" onclick="openMonth('Juin')">Juin</button>
        <button id="btJuillet" class="monthButton" onclick="openMonth('Juillet')">Juillet</button>
        <button id="btAout" class="monthButton" onclick="openMonth('Aout')">Août</button>
        <button id="btSeptembre" class="monthButton" onclick="openMonth('Septembre')">Septembre</button>
        <button id="btOctobre" class="monthButton" onclick="openMonth('Octobre')">Octobre</button>
    </div>
    <div class="scroll">
        <?php
            use Illuminate\Support\Facades\DB;

        function getMonthlySessions($month)
        {
            $year = date("Y");
            $fDay = date_create('\''.$year.'-'.$month.'-01\'');
            $lDay = date_create('\''.$year.'-'.($month+1).'-01\'');
 
            /*$result = DB::table('PLONGEE')
                        ->select('PLON_DATE')
                        ->where('PLON_DATE','>=', $fDay)
                        ->where('PLON_DATE','<', $lDay)
                        ->get();*/
            echo 'Fday'.$fDay.'   lDay  '.$lDay;
            $result = DB::Select(
                //doesn't return anything with this query
                "SELECT PLON_DATE FROM PLONGEE WHERE PLON_DATE >= ? AND PLON_DATE < ?",
                [$fDay, $lDay]
                /*"SELECT PLON_DATE FROM PLONGEE"*/
            );
            foreach($result as $line)
            {
                echo "<div class=\"session\"> ".$line->PLON_DATE."</div>";
            }
        }
        ?>
        <div id="Mars" class="month";>
            <?php
                //sessionListController::getMonthlySessions(3);
                getMonthlySessions(3);
            ?>
        </div>    
        <div id="Avril" class="month" style="display:none">
            <?php
                //sessionListController::getMonthlySessions(4);
                getMonthlySessions(4);
            ?>
        </div>    
        <div id="Mai" class="month" style="display:none">
            <?php
                //sessionListController::getMonthlySessions(5);
                getMonthlySessions(5);
            ?>
        </div>
        <div id="Juin" class="month" style="display:none">
            <?php
                //sessionListController::getMonthlySessions(6);
                getMonthlySessions(6);
            ?>
        </div>    
        <div id="Juillet" class="month" style="display:none">
            <?php
                //sessionListController::getMonthlySessions(7);
                getMonthlySessions(7);
            ?>
        </div>    
        <div id="Aout" class="month" style="display:none">
            <?php
                //sessionListController::getMonthlySessions(8);
                getMonthlySessions(8);
            ?>
        </div>
        <div id="Septembre" class="month" style="display:none">
            <?php
                //sessionListController::getMonthlySessions(9);
                getMonthlySessions(9);
            ?>
        </div>    
        <div id="Octobre" class="month" style="display:none">
            <?php
                //sessionListController::getMonthlySessions(10);
                getMonthlySessions(10);
            ?>
</div>

</body>
<script>
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