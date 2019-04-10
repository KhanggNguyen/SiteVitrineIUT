<form method="get">
  <fieldset>
    <legend>Créer un cactus :</legend>
    <input type='hidden' name='action' value=<?php echo $action ?> controller='cactus'>
    
    <p>
      <label for="espece_id">Espèce</label> :
      <input type="text" value="<?php echo $cactus->getEspece();?>" name="espece" id="espece_id" required/>
    </p>
    <p>
      <label for="date_acq_id">Date acquise</label> :
      <input type="date" value="<?php echo $cactus->getDateAcq();?>" name="date_acq" id="date_acq_id" required/>
    </p>
    <p>
      <label for="prix_id">Prix</label> :
      <input type="text" value="<?php echo $cactus->getPrix();?>" name="prix" id="prix_id" required/>
    </p>
    <p>
      <label for="description_id">Description</label> :
      <input type="text" value="<?php echo $cactus->getDescription();?>" name="description" id="description_id" required/>
    </p>
    <p>
      <label for="image_id">Image</label> :
      <input type="text" value="<?php echo $cactus->getImage();?>" name="image" id="image_id" required/>
    </p>
    <p>
      <input type="submit" value="Envoyer" />
    </p>
  </fieldset> 
</form>