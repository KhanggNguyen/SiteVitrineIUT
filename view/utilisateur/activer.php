<form method="get">
  <fieldset>
    <legend>Mon formulaire d'activation :</legend>
    <input type='hidden' name='action' value='actived'>
    <input type='hidden' name='controller' value='utilisateur'>

     <p>
      <label for="login_id">Login</label> :
      <input type="text" placeholder="Ex : jean" name="login" id="login_id" required/>
    </p>

    <p>
      <label for="cle_id">Code d'activation</label> :
      <input type="text" placeholder="Ex : jean" name="cle" id="cle_id" required/>
    </p>
    <p>
      <input type="submit" value="Envoyer" />
    </p>
  </fieldset> 
</form>