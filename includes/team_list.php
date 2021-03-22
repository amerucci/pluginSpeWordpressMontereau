<div class="wrap">
  <h1>Foot Score</h1>
  <p>Là on est sur notre page d'administration de notre plugin</p>


  <style>
  div#v-pills-tab {
    height: calc(100vh - 185px);
    width: 33%;
    overflow: hidden;
    overflow-y: auto;
  }
</style>

<?php $equipes = ['Angers', 'Bordeaux', 'Brest', 'Dijon', 'Lens', 'Lille', 'Lorient', 'Lyon', 'Marseille', 'Metz', 'Monaco', 'Montpellier', 'Nantes', 'Nice', 'Nimes', 'Paris-SG', 'Reims', 'Rennes', 'Saint-Etienne', 'Strasbourg']; ?>
  <div class="d-flex align-items-start">
    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <?php
      for ($i = 1; $i <= 36; $i++) {
        if ($i == '1') {
          $journee = "ère";
        } else {
          $journee = "ème";
        }
        echo ' <button class="nav-link" id="v-pills-' . $i . '-tab" data-bs-toggle="pill" data-bs-target="#v-pills-' . $i . '" type="button" role="tab" aria-controls="v-pills-home" aria-selected="false">' . $i . "" . $journee . " journée" . '</button>';
      }
      ?>
    </div>

    <!-- Les tabs de droite -->
    <div class="tab-content" id="v-pills-tabContent">
      <?php

      for ($i = 1; $i <= 36; $i++) {

        echo ' <div class="tab-pane fade " id="v-pills-' . $i . '" role="tabpanel" aria-labelledby="v-pills-' . $i . '-tab"><form>';

        for ($m = 1; $m <= 9; $m++) {
          echo "<div class='row'>
     <div class='col-3'>
     
  <select name='' id=''>";
          foreach ($equipes as $equipe) {
            echo  "<option value='" . $equipe . "'>" . $equipe . "</option>";
          }

          echo "</select>

     </div>
     <div class='col-3'>
     <input type='number' name='sdom' class='form-control'>
     </div>
     <div class='col-3'>
     <input type='number' name='sext'  class='form-control'>
     </div>
     <div class='col-3'>
     <select name='' id=''>";
          foreach ($equipes as $equipe) {
            echo  "<option value='" . $equipe . "'>" . $equipe . "</option>";
          }

          echo "</select>
          </div>
     </div>";
        }





        echo '</div>';
      }
      echo "</div>";
      echo "</div>


  </div>";

      ?>
    </div>






  </div>