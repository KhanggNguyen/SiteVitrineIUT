<form method="get">
  <fieldset>
    <legend>Mon formulaire :</legend>
    <input type='hidden' name='action' value='deleted'>
    <input type='hidden' name='controller' value='utilisateur'>
    <p>
      <label for="login_id">Login</label> :
      <input type="text" placeholder="Ex : jean" name="login" id="login_id" required/>
    </p>
    <p>
      <input type="submit" value="Envoyer" />
    </p>
  </fieldset> 
</form>