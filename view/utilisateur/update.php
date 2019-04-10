<form method="get">
  <fieldset>

    <?php if ($verif == "mdp") {
      echo "Les deux mots de passe ne correspondent pas !";
    } elseif ($verif == "email") {
      echo '<p class="">l\'email n\'est pas valide !</p>';
    } ?>

    <legend class="text-center">Inscription </legend>
    <input type='hidden' name='action' value=<?php echo $action ?>>
    <input type='hidden' name='controller' value=<?php echo $controller ?>>
    <p>
      <label for="login_id">Login</label> :
      <input type="text" value="<?php echo $user->get('login');?>" name="login" id="login_id" placeholder="e.g: toto" <?php echo $champ ?>/>
    </p>
    <p>
      <label for="nom_id">Nom</label> :
      <input type="text" value="<?php echo $user->get('nom');?>" name="nom" id="nom_id" placeholder="e.g: Claude" required/>
    </p>
    <p>
      <label for="prenom_id">Prénom</label> :
      <input type="text" value="<?php echo $user->get('prenom');?>" name="prenom" id="prenom_id" placeholder="e.g: Francois" required/>
    </p>
    <p>
      <label for="mail_id">E-Mail</label> :
      <input type="text" value="<?php echo $user->get('mail');?>" name="mail" id="mail_id" placeholder="e.g: toto@yopmail.fr" required/>
    </p>
    <p>
      <label for="image_id">Lien de l'image</label> :
      <input type="text" value="<?php echo $user->get('image');?>" name="image" id="image_id" placeholder="e.g: jesuisuneimage.gif" required/>
    </p>
    <p>
      <label for="mdp_id">Mot de passe</label> :
      <input type="password" name="mdp" id="mdp_id" size="32" placeholder="passwd" required/>
    </p>
    <p>
      <label for="verif_mdp_id">Valider votre mot de passe</label> :
      <input type="password"  name="verif_mdp" id="verif_mdp_id" size="32" placeholder="passwd" required/>
    </p>
    <p>
      <input type="submit" value="Envoyer" />
    </p>
  </fieldset> 
</form>
