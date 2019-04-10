
<?php
	$vIdc = htmlspecialchars($v->getIdCactus());
    $vEspece = htmlspecialchars($v->getEspece());
    $vDateAcq = $v->getDateAcq();
    $vPrix = $v->getPrix();
    $vDescription = htmlspecialchars($v->getDescription());
    $vImage = htmlspecialchars($v->getImage());
    $pIdc = rawurlencode($v->getIdCactus());


    
    echo '<div class="text-center" >';
    echo '<img src="'.$vImage.'" height="200" /> ';   
    
    echo '<p> Cactus d\'id '.$vIdc.' d\'espèce '.$vEspece.' ayant été acquis le '.$vDateAcq.' et coutant '.$vPrix.' €.  </p></br> Description : '.$vDescription;
    echo ' <form method=get>
            <input type="hidden" name="action" value="ajouterCactus" >
            <input type="hidden" name="controller" value="cactus" >
            <input type="hidden" name="idc" value='.$vIdc.'>'.
            '<label for="qte_id">Quantite</label><input type="number" name="qte" id="qte_id" required>
            <p><input type="submit" value="Ajouter" /></p>';
    echo '<p>Pour modifier l\'annonce cliquez <a href="index.php?action=update&idc='.$vIdc.'">ici</a></p>';
    echo '<p>Pour supprimer l\'annonce cliquez <a href="index.php?action=deleted&idc='.$pIdc.'">ici</a></p>';
    echo '</div>';

?>
