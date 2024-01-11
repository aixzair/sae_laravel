<?php
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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
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
<?php
    
    /*if(isset($_GET['action'])){
        if($_GET['action']=='register'){
            $controller->register($_GET['sea_id'], $_GET['plon_date'], session('email'));
        }else{
            $controller->unregister($_GET['sea_id'], $_GET['plon_date'], session('email'));
        }
        
    }*/
    //PlongeeController::displayDivings();
?>

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
        /**
         * Get and displays the list of dives for the selected month
         *
         * @param [type] $month
         * @return void
         */
        function getMonthlySessions($month)
        {
            $year = date("Y");
            $fDay = date_create($year.'-'.$month.'-01');
            $lDay = date_create($year.'-'.($month+1).'-01');

            $result = DB::Select(
                "SELECT SEA_ID, PLON_DATE, PLON_DEBUT, PLON_FIN, PLON_EFFECTIFS_MAX, PLON_EFFECTIFS_MIN, PLON_NIVEAU
                FROM PLONGEE WHERE PLON_DATE >= ? AND PLON_DATE < ?
                ORDER BY PLON_DATE ASC",
                [$fDay, $lDay]
            );
            

            foreach($result as $line)
            {
                $year = date("Y");
                $fDay = date_create($year.'-'.$month.'-1');
                $lDay = date_create($year.'-'.($month+1).'-1');
                
                //DD-MM-YYYY HH-mm format
                $sea_id = $line->SEA_ID;
                $plon_date = $line->PLON_DATE;
                $plon_niveau = $line->PLON_NIVEAU;

                $fSessionDate = date("d-m-Y",strtotime($line->PLON_DATE));
                $startingTime = date("H:i",strtotime($line->PLON_DEBUT));
                $endingTime = date("H:i",strtotime($line->PLON_FIN));
                
                //Changes background color if session is valid, invalid or full
                if($complete = PlongeeController::isComplete($sea_id, $plon_date))
                {
                    //If full, container is redMarked
                    echo "<div class=\"redMarked session ";
                }
                else
                {
                    echo "<div class=\"session ";
                }
                if(PlongeeController::isValid($sea_id, $plon_date))
                {
                    if(!$complete)
                    {
                        echo "greenMarked\">";
                    }
                    else{
                        echo "\">";
                    }
                    echo "<p>$plon_date de $startingTime à $endingTime        Niveau min. : $plon_niveau</p>";
                    //echo "Test : sea:$sea_id date:$plon_date isReg:".PlongeeController::isRegistered($sea_id, $plon_date, "chloe.young@gmail.com");
                    if(PlongeeController::isRegistered($sea_id, $plon_date, "chloe.young@gmail.com")){ //TODO : replacer l'adresse mail de l'utilisateur
                        echo "<div class=\"regButton\"><a href=\"unregister/$plon_date/$sea_id\">Se retirer</a></div>";
                    }else if($complete){
                        echo "<p>COMPLET</p>";
                    }
                    else{
                        //echo "<div class=\"regButton\"><a href=\"register/$plon_date/$sea_id\">S'inscrire</a></div>";
                        if(PlongeeController::isRightLevel($sea_id, $plon_date, "chloe.young@gmail.com"))
                        {
                            echo "<div class=\"regButton\"><a href=\"register/$plon_date/$sea_id\">S'inscrire</a></div>";
                        }
                        else
                        {
                            echo "<div class=\"regButton\"><a>Niveau Insuffisant</a></div>";
                        }
                    }
                }
                else{
                    echo "\">";
                    echo "<p> ".$plon_date.' '.$startingTime.' à '.$endingTime."</p><p></p>";
                }
                

                echo "</div>";
            }
        }
        
        ?>
        <div id="Mars" class="month";>
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

    <!--modal
    <div class="modal-container categorie-container">
        <div class="overlay categorie "></div>
            <div class="modal">
                <button class="close-modal categorie ">X</button>
                <h1>Catégories</h1>
                <form action="" method="post">

                    <input type="checkbox" name="entree" id="entree">
                    <label for="entree">Entrée</label>
                    <br>
                    <input type="checkbox" name="plats" id="plats">
                    <label for="plats">Plats</label>
                    <br>
                    <input type="checkbox" name="dessert" id="dessert">
                    <label for="dessert">Dessert</label>
                    <br>
                    <input class="modalValidate" value="Valider" type="submit" name="valider-categorie" id="valider-categorie">
                </form>
            </div>
        </div>
        <button class="modal-btn categorie ">Catégories</button>
    </div>
    -->
    </div>
</body>
<script>
    const ingredientContainer = document.querySelector(".ingredient-container");
    const categorieTriggers = document.querySelectorAll(".categorie");

    categorieTriggers.forEach(trigger =>
        trigger.addEventListener("click", ()=>{
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