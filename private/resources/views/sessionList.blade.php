<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toutes les séances</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <header>
    <img class = "Logo" src="../img/logo.png" alt="Logo">
    <nav>
      <div class="NavBar">
        <p class="NavText">Plongées annuelles restantes : 90</p>
        <button class = "NavButton">RESERVER SÉANCE</button>
        <button class = "NavButton">PROFIL</button>
        <img id="Logout" src="../img/right-from-bracket-solid.svg" alt="Déconnexion">
      </div>
    </nav>
  </header>
  <div class="monthContainer">
    <div class="monthBar">
        <button id="btMars" class="monthButton button" onclick="openMonth('Mars')" style="background-color: grey; border-bottom-style: none;">Mars</button>
        <button id="btAvril" class="monthButton button" onclick="openMonth('Avril')">Avril</button>
        <button id="btMai" class="monthButton button" onclick="openMonth('Mai')">Mai</button>
        <button id="btJuin" class="monthButton button" onclick="openMonth('Juin')">Juin</button>
        <button id="btJuillet" class="monthButton button" onclick="openMonth('Juillet')">Juillet</button>
        <button id="btAout" class="monthButton button" onclick="openMonth('Aout')">Août</button>
        <button id="btSeptembre" class="monthButton button" onclick="openMonth('Septembre')">Septembre</button>
        <button id="btOctobre" class="monthButton button" onclick="openMonth('Octobre')">Octobre</button>
    </div>
    <div class="scroll">

    <?php
    //WIP PHP can't find DB as of now
        use Illuminate\Support\Facades\DB;

        function getMonthlySessions($month, $servername, $username, $password, $dbname)
        {
            $year = date("Y");
            $fDay = date_create($year.'-'.$month.'-01');
            $lDay = date_create($year.'-'.($month+1).'-01');
            
            /*$result = DB::table('plongee')
                    ->where('plon_date',  '>=', $fDay)
                    ->where('plon_date',  '<', $lDay)
                    ->get();*/

            $result = DB::select("SELECT PLON_DATE FROM PLONGEE WHERE date >= $fDay AND date < $lDay");
            foreach($result as $line)
            {
                echo "<div class=\"session\"> ".$line->PLON_DATE."</div>";
            }
        
        }
        ?>

        <div id="Mars" class="month";>
            <h2>Toutes les séances de Mars (titre à supprimer)</h2>
            <?php
                getMonthlySessions(3, $servername, $username, $password, $dbname);
            ?>
        </div>    
        <div id="Avril" class="month" style="display:none">
            <h2>Toutes les séances de Avril</h2>
            <?php
                getMonthlySessions(4, $servername, $username, $password, $dbname);
            ?>
        </div>    
        <div id="Mai" class="month" style="display:none">
            <h2>Toutes les séances de Mai</h2>
            <?php
                getMonthlySessions(5, $servername, $username, $password, $dbname);
            ?>
        </div>
        <div id="Juin" class="month" style="display:none">
            <h2>Toutes les séances de Juin</h2>
            <?php
                getMonthlySessions(6, $servername, $username, $password, $dbname);
            ?>
        </div>    
        <div id="Juillet" class="month" style="display:none">
            <h2>Toutes les séances de Juillet</h2>
            <?php
                getMonthlySessions(7, $servername, $username, $password, $dbname);
            ?>
        </div>    
        <div id="Aout" class="month" style="display:none">
            <h2>Toutes les séances de Août</h2>
            <?php
                getMonthlySessions(8, $servername, $username, $password, $dbname);
            ?>
        </div>
        <div id="Septembre" class="month" style="display:none">
            <h2>Toutes les séances de Septembre</h2>
            <?php
                getMonthlySessions(9, $servername, $username, $password, $dbname);
            ?>
        </div>    
        <div id="Octobre" class="month" style="display:none">
            <h2>Toutes les séances de Octobre</h2>
            <?php
                getMonthlySessions(10, $servername, $username, $password, $dbname);
            ?>
        </div>
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s when a
        n unknown printer took a galley of type and scrambled it to make a type specimen book. 
        It has survived not only five centuries, but also the leap into electronic typesetting, 
        remaining essentially unchanged. It was popularised in the 1960s with the release of 
        Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing 
        software like Aldus PageMaker including versions of Lorem Ipsum. It is a long 
        established fact that a reader will be distracted by the readable content of a page
        when looking at its layout. The point of using Lorem Ipsum is that it has a 
        more-or-less normal distribution of letters, as opposed to using 'Content here, 
        content here', making it look like readable English. Many desktop publishing packages
        and web page editors now use Lorem Ipsum as their default model text, and a search 
        for 'lorem ipsum' will uncover many web sites still in their infancy.
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s when a
        n unknown printer took a galley of type and scrambled it to make a type specimen book. 
        It has survived not only five centuries, but also the leap into electronic typesetting, 
        remaining essentially unchanged. It was popularised in the 1960s with the release of 
        Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing 
        software like Aldus PageMaker including versions of Lorem Ipsum. It is a long 
        established fact that a reader will be distracted by the readable content of a page
        when looking at its layout. The point of using Lorem Ipsum is that it has a 
        more-or-less normal distribution of letters, as opposed to using 'Content here, 
        content here', making it look like readable English. Many desktop publishing packages
        and web page editors now use Lorem Ipsum as their default model text, and a search 
        for 'lorem ipsum' will uncover many web sites still in their infancy.
    </div>
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