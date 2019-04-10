<?php

require_once File::build_path(array("config","Conf.php"));

class Model {



public static $pdo;

	public static function Init() {

		$hostname = Conf::gethostname();
		$database_name = Conf::getDatabase();
		$login = Conf::getLogin();
		$password = Conf::getPassword();

		try{
			self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
   
			// On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
		catch(PDOException $e) {
			
			if (Conf::getDebug()) {
			    echo $e->getMessage(); // affiche un message d'erreur
			  } else {
			    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
			  }
		die();
			}

	}
	public static function selectAll(){

	$table_name = static::$object;
	$class_name = 'Model'.ucfirst($table_name);
    
	    try {
	      $rep = Model::$pdo->query("SELECT * FROM $table_name");
	      $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
	      $tab_all = $rep->fetchAll();
	      return $tab_all;
	      }
	    catch (Exception $e) {
	      echo 'Exception reçue : ',  $e->getMessage(), "\n";
	    }
	  } 

	public static function select($primary_value) {

    	$table_name = static::$object;
		$class_name = 'Model'.ucfirst($table_name);
		$primary_key = static::$primary;

      try {

        $sql = "SELECT * from $table_name WHERE $primary_key=:primary_val";
        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "primary_val" => $primary_value,
        );

        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab_select = $req_prep->fetchAll();

        if (empty($tab_select))
            return false;
        return $tab_select[0];
      }
    catch (Exception $e) {
     echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
  }  

	public function delete($primary_value){

		$table_name = static::$object;
		$primary_key = static::$primary;

	    try {
	        $sql = "DELETE FROM $table_name WHERE $primary_key=:primary_val";
	        $values = array("primary_val" => $primary_value);
	        $req_prep = Model::$pdo->prepare($sql);
	        $req_prep->execute($values);
	    }
	    catch (Exception $e) {
	        echo 'Exception reçue : ',  $e->getMessage(), "\n";
		}
	}  

	 public static function update($data){


    	$tabK = $data->tabKey();
    	$tabV = $data->tabVal();
		$table_name = static::$object;
		$primary_key = static::$primary;

    	foreach ($tabK as $v) {
     		try {
		        $sql = "UPDATE $table_name 
		                SET $v=:value 
		                WHERE $primary_key=:primary_val";
		        $values = array("primary_val" => $tabV[$primary_key],
		                        "value" => $tabV[$v]);

		        $req_prep = Model::$pdo->prepare($sql);
		        $req_prep->execute($values);
	    }
	        catch (Exception $e) {
	         	echo 'Exception reçue : ',  $e->getMessage(), "\n";
	        }
   		}  
	}

	public static function save($data){

		// Récupération d'un tableau d'attribut en fonction de l'objet $date (ex pour cactus : idc, espece ...)
		$tabK = $data->tabKey();
		// Récupération des valeurs pour chaque attribut dans l'objet $data
    	$tabV = $data->tabVal();

    	foreach ($tabK as $v) {
     		$tabVal[] = $tabV[$v];
    	}//[this->IdU, this->nom, ...]
		$table_name = static::$object;
		$primary_key = static::$primary;

		// strVal = chaine de caractère des valeurs mis en forme pour être placé directement dans "VALUES" 
		// ex pour cactus : (:idc, :espece, :date_acq, :prix, :description, :image)
		$strVal = ':'.$primary_key; // $strVal = ":IdU"
		for ($i = 1; $i < count($tabK); $i++) {
   		 $strVal = $strVal .',:'.$tabK[$i]; //":Idu . ',:nom' . ',: prenom"
		}

		// mise en forme pour INSERT INTO en intégrant tous les attributs
		$strK = join(',', $tabK);//(idu, nom, prenom, ...)
		//$strVal = join(':',\'', $tabVal).'\''; //(idu nom, prenom, ...)

      try {
        $sql = "INSERT INTO $table_name ($strK) VALUES ($strVal)";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute($tabV);
      }
      catch (Exception $e) {
         echo 'Exception reçue : ',  $e->getMessage(), "\n";
      }
    } 
}

Model::Init()

?>



