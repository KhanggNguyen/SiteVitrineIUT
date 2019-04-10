<?php
    foreach ($tab_v as $v) {

        $vLogin = htmlspecialchars($v->get('login'));   
        $pLogin = rawurlencode($v->get('login'));
        $vImage = htmlspecialchars($v->get('image'));

        echo '<a href="index.php?action=read&controller=utilisateur&login='.$pLogin.'">';
        echo '<div class="col-lg-3 text-center">';

        echo '<img src="'.$vImage.'" height="100" /> ';
        echo '<p>'.$vLogin.'</p>';
        echo '</div>';
        echo '</a>';
        }
?>
