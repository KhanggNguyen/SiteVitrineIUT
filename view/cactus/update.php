<form method="get">
  <fieldset>
    <legend class="text-center">Mon formulaire</legend>

    <input type='hidden' name='action' value=<?php echo $action ?> controlleur='cactus'>
    <?php 
      if ($action =='updated') {
        echo '<p>
                <label for="idc_id">Id Cactus</label> :
                <input type="text" value="'.$cactus->getIdCactus().'" name="idc" id="idc_id" '.$champ.'/>
              </p>';
      }
    ?>

    <table class="text-center">
      <tr>
        <td class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
          <label for="espece_id">Espèce</label>
        </td>
        <td>
          <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="text" value="<?php echo $cactus->getEspece();?>" name="espece" id="espece_id" required/>
        </td>
      </tr>

      <tr>
        <td class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
          <label for="date_acq_id">Date acquise</label> 
        </td>
        <td>
          <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="date" value="<?php echo $cactus->getDateAcq();?>" name="date_acq" id="date_acq_id" required/>
        </td>
      </tr>
    
      <tr>
        <td class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
          <label for="prix_id">Prix</label> 
        </td>
        <td>
          <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="text" value="<?php echo $cactus->getPrix();?>" name="prix" id="prix_id" required/>   
        </td>
      </tr>
    
      <tr>
        <td class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
          <label for="description_id">Description</label> 
        </td>
        <td>
          <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="text" value="<?php echo $cactus->getDescription();?>" name="description" id="description_id" required/>
        </td>
      </tr>
    
      <tr>
        <td class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
          <label for="image_id">Image</label> 
        </td>
        <td>
          <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="text" value="<?php echo $cactus->getImage();?>" name="image" id="image_id" required/>
        </td>
      </tr>
    
    </table>

    <br>

    <p class="text-center">
      <input type="submit" value="Envoyer" />
    </p>


  </fieldset> 
</form>