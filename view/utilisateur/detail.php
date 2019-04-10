
<?php
	$vLogin = htmlspecialchars($v->get('login'));
    $vNom = htmlspecialchars($v->get('nom'));
    $vPrenom = htmlspecialchars($v->get('prenom'));
    $pLogin = rawurlencode($v->get('login'));
    echo '<p> Utilisateur ayant pour login : '.$vLogin.', pour nom : '.$vNom.' et pour prénom : '.$vPrenom.' .</p><br>';
    echo '<p>Pour modifier l\'utilisateur cliquez <a href="index.php?action=update&controller=utilisateur&login='.$pLogin.'">ici</a></p>';
    echo '<p>Pour supprimer l\'utilisateur cliquez <a href="index.php?action=deleted&controller=utilisateur&login='.$pLogin.'">ici</a></p>';
    echo '<p>Pour voir l\'historique des commandes cliquez <a href="index.php?action=readHistorique&controller=commande&login='.$pLogin.'">ici</a></p>';

?>
