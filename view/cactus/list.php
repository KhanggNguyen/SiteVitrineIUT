<?php
    foreach ($tab_v as $v) {

        $vCactus = htmlspecialchars($v->getIdCactus()); 
        $vImage = htmlspecialchars($v->getImage());
        $pCactus = rawurlencode($v->getIdCactus());
        $vPrix = htmlspecialchars($v->getPrix()); 
        $vEspece = htmlspecialchars($v->getEspece()); 

        echo '<a href="index.php?action=read&controller=cactus&idc='.$pCactus.'">';
        echo '<div class="col-lg-3 col-md-3 col-sm-5 col-xs-12 text-center" >';     
		echo '<img src="'.$vImage.'" height="100" /> ';	  
        echo '<p>'.$vEspece.' - '.$vPrix.'€</p>';
        echo '</div>';
        echo '</a>';

        }
?>
