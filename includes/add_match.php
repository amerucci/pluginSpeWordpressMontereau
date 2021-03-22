<?php

require_once(plugin_dir_path(__FILE__) . 'functions.php');

$teams = ['Angers', 'Bordeaux', 'Brest', 'Dijon', 'Lens', 'Lille', 'Lorient', 'Lyon', 'Marseille', 'Metz', 'Monaco', 'Montpellier', 'Nantes', 'Nice', 'Nimes', 'Paris-SG', 'Reims', 'Rennes', 'Saint-Etienne', 'Strasbourg'];
?>

<style>
    .tabhead {
        background: #1d2327;
        color: #fff;
        padding: 10px;
        margin-bottom: 20px;
        text-align: center;
    }
</style>
<div class="row text-center">
<div class="col-12 mb-5">

    <form method="GET" action="?">
    <input type="hidden" name="page" value="footscore/includes/plugin_page.php">
    <input type="hidden" name="addmatch" value="">

    
        <label for="exampleDataList" class="form-label w-100" ><h2>Saisissez les résultats des matchs</h2></label>

    
        <select class="form-select my-4 w-50" aria-label="Default select example" style="display:inline" name="journee">
            <?php
                if(isset($_GET['journee'])){
                    if ($_GET['journee'] == '1') {
                        $journee = "ère";
                    } else {
                        $journee = "ème";
                    }
                    echo "<option value='".$_GET['journee']."'>" . $_GET['journee'] . "" . $journee . " journée</option>";
                }
                else{
                    echo "<option selected>Choisissez une journée</option>";
                }
            ?>
            
            
            <?php
            for ($i = 1; $i < 39; $i++) {
                if ($i == '1') {
                    $journee = "ère";
                } else {
                    $journee = "ème";
                }
                echo '<option value="' . $i . '">' . $i . "" . $journee . " journée" . '</option>';
            }
            ?>
        </select>

        <button type="submit" class="btn btn-warning w-54 my-4" name="refresh" style="padding:2px 10px; margin-left:10px">Afficher les scores déjà rentrés</button>



        <div class="row tabhead">
            <div class="col-4">Equipe à domicile</div>
            <div class="col-2">Score</div>
            <div class="col-2">Score</div>
            <div class="col-4">Equipe à l'extérieur</div>
        </div>


        <div class="row">

            <div class="col-4 mb-3">
                <input class="form-control" list="datalistOptions" id="exampleDataList" name="tdom" placeholder="Saisissez une équipe">
                <datalist id="datalistOptions">
                    <?php
                    foreach ($teams as $team) {
                        echo '<option value="' . $team . '">';
                    }
                    ?>
                </datalist>
            </div>

            <div class="col-2">
                <input type="number" name="sdom" id="" class="form-control">
            </div>
            <div class="col-2">
                <input type="number" name="sext" id="" class="form-control">
            </div>
            <div class="col-4">
                <input class="form-control" list="datalistOptions" id="exampleDataList" name="text" placeholder="Saisissez une équipe">
                <datalist id="datalistOptions">
                    <?php
                    foreach ($teams as $team) {
                        echo '<option value="' . $team . '">';
                    }
                    ?>
                </datalist>
            </div>
        </div>



        <button type="submit" class="btn btn-primary" name="save">Enregistrer les scrores de la journée</button>
       
    </form>
</div>

<div class="col-12">
<?php 
if(isset($_GET['journee'])){
    if ($_GET['journee'] == '1') {
        $journee = "ère";
    } else {
        $journee = "ème";
    }
    echo "<label for='exampleDataList' class='form-label w-100' ><h2>Les résultats de la " . $_GET['journee'] . "" . $journee . " journée</h2></label>";

    echo '<div class="row tabhead">
            <div class="col-5">Equipe à domicile</div>
            <div class="col-1">Score</div>
            <div class="col-1">Score</div>
            <div class="col-5">Equipe à l\'extérieur</div>
        </div>';

    $resultats = all();
    foreach ($resultats as $result) {
        echo '
        <div class="row text-center">
        <div class="col-5">'. $result['tdom'].'</div>
        <div class="col-1">'. $result['sdom'].'</div>
        <div class="col-1">'. $result['sext'].'</div>
        <div class="col-5">'. $result['text'].'</div>
        </div>
    ';
    }
}

?>
</div>
</div>

<?php

if(
    isset($_GET['journee']) 
    && isset($_GET['tdom']) 
    && isset($_GET['text'])
    && isset($_GET['sdom'])
    && isset($_GET['sext'])
    && isset($_GET['save'])
    && !empty($_GET['journee'])
    && !empty($_GET['tdom']) 
    && !empty($_GET['text'])
    && !empty($_GET['sdom'])
    && !empty($_GET['sext'])
    && $_GET['tdom']!=$_GET['text']
    &&  isset($_GET['save']) 
    
    ){
        add();
    }


    else if(isset($_GET['refresh'])) {
        redir('admin.php?page=footscore%2Fincludes%2Fplugin_page.php&addmatch&journee='.$_GET['journee']);

    }
  
    

?>