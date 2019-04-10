<form method="get">
  <fieldset>
    <legend class="text-center">Connexion</legend>
    
    <input type='hidden' name='action' value=<?php echo $action ?> />
    <input type='hidden' name='controller' value='utilisateur' />

    <table class="text-center">
      <tr>

          <td class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right"><label for="login_id">Login</label></td>
          <td><input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="text" name="login" id="login_id" required/></td>

      </tr>

      <tr>

          <td class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right"><label for="mdp_id">Mot de Passe</label></td>
          <td><input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="password" name="mdp" id="mdp_id" required/></td>
          
      </tr> 

    </table>

    <br>

    <a href="#"><p class="text-center"> Mot de passe oublié</p></a>
    <a href="index.php?action=create&controller=utilisateur"><p class="text-center"> S'inscrire</p></a>
    <p class="text-center"> <input  type="submit" value="Envoyer" /> </p>
  </fieldset> 
</form>
