<?php

class Security {

	private static $seed = 'Je suis un cactus';

	function chiffrer($texte_en_clair) {
	  $texte_chiffre = hash('sha256', Security::getSeed().$texte_en_clair);
	  return $texte_chiffre;
	}

	static public function getSeed() {
   		return self::$seed;
	}
}

?>