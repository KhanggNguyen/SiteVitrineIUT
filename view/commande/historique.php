<?php
	$valtest=-1;
	$nbElement = count($tab_c);
	$position=0;
    $montant = htmlspecialchars($tab_c[0]["montant"]);
    foreach ($tab_c as $v) {

    	$position++;
    	$pIdc = rawurlencode($v["idc"]);
    	$quantite = htmlspecialchars($v["quantite"]);
    	$espece = htmlspecialchars($v["espece"]);
    	$datecommande = htmlspecialchars($v["datecommande"]);
    	$prix_actuel = htmlspecialchars($v["prix_actuel"]);

		if ($valtest!=$v["idcommande"]) {
			if ($position!=1) {
				echo 'Montant : '.$montant.'€ <br><br>';
			}
    	echo 'Le '.$datecommande.' : <br>';
    	$valtest = $v["idcommande"];
    	}

    	echo '- '.$quantite.'x ';
        echo '<a href="index.php?action=read&controller=cactus&idc='.$pIdc.'">';
        echo $espece.'</a>';
        echo ' à '.$prix_actuel.'€/U <br>';

    	if ($position==$nbElement) {
    		echo 'Montant : '.$montant.'€';
    	}
    	$montant = htmlspecialchars($v["montant"]);
    }
?>
