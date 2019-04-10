<?php
require_once File::build_path(array("model","Model.php"));

class ModelCommande extends model {
   
  private $idcommande;
  private $login;
  private $datecommande;
  private $montant;

  protected static $object = 'commande';
  protected static $primary = 'idcommande';
      
 // Getter générique
    public function get($nom_attribut) {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    // Setter générique
    public function set($nom_attribut, $valeur) {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }

  // un constructeur
  public function __construct($idcom = NULL, $log = NULL, $date = NULL, $m = NULL )  {
    if (!is_null($idcom) && !is_null($log) && !is_null($date) && !is_null($m)) {
      $this->idcommande=$idcom;
      $this->login=$log;
      $this->datecommande=$date;
      $this->montant=$m;      
    }
  } 

  public function tabKey () {

    $tab = array();
    foreach ($this as $key => $value) {
      $tab[]=$key;
    }
    return $tab;
  }

  public function tabVal () {

    $tab = array();
    foreach ($this as $key => $value) {
      $tab[$key] = $value;
    }
    return $tab;
  }

  public static function saveLigneCommande($idcom, $idc, $prix_actuel, $quantite){
      try {
        $sql = "INSERT INTO ligneCommande (idcommande, idc, prix_actuel, quantite) VALUES (:idcom, :idc, :prix_actuel, :quantite)";
        $tabV = array('idcom' => $idcom,
                      'idc' => $idc,
                      'prix_actuel' => $prix_actuel,
                      'quantite' => $quantite);
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute($tabV);
      }
      catch (Exception $e) {
         echo 'Exception reçue : ',  $e->getMessage(), "\n";
      }
    }

  public static function getLastId($login){
    try {
      $sql = "SELECT idcommande FROM commande WHERE login = :login ORDER BY idcommande DESC LIMIT 0, 1";
      $tab = array('login' => $login);
      $req_prep = Model::$pdo->prepare($sql);
      $req_prep->execute($tab);
      $tabLastId = $req_prep->fetch(PDO::FETCH_ASSOC);
      return $tabLastId["idcommande"];
    }
    catch (Exception $e) {
      echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
  }

  public static function selectCommande($login){
    
    try {
      $sql = "SELECT * 
              FROM commande C, ligneCommande LC, cactus Ca
              WHERE C.idcommande = LC.idcommande
              AND LC.idc = Ca.idc
              AND C.login =  :login";
      $tab = array('login' => $login);
      $req_prep = Model::$pdo->prepare($sql);
      $req_prep->execute($tab);
      $tabC = $req_prep->fetchAll(PDO::FETCH_ASSOC);
      return $tabC;
    }
    catch (Exception $e) {
      echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
  }
}

?>