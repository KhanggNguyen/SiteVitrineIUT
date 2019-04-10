<?php
require_once File::build_path(array("model","Model.php"));

class ModelCactus extends model {
   
  private $idc;
  private $espece;
  private $date_acq;
  private $prix;
  private $description;
  private $image;
  protected static $object = 'cactus';
  protected static $primary = 'idc';
      
  // un getter      
  public function getIdCactus() {
    return $this->idc;  
  }
  public function getEspece() {
    return $this->espece;  
  }
  public function getDateAcq() {
    return $this->date_acq;  
  }
  public function getPrix(){
    return $this->prix;
  }
  public function getDescription(){
    return $this->description;
  }
  public function getImage(){
    return $this->image;
  }
     
  // un setter 
  public function setEspece($espece2) {
       $this->espece = $espece2;
  }
  public function setCouleur($DateAcq2) {
       $this->getDateAcq = $DateAcq2;
  }
  public function setPrix($prix2) {
       $this->prix = $prix2;
  } 
  public function setDesciption($description2){
    return $this->description= $description2;
  }
  public function setImage($image2){
    return $this->image=$image2;
  }
  public function setIdc($idc2){
    return $this->idc=$idc2;
  }

  // un constructeur
  public function __construct($id = NULL, $e = NULL, $da = NULL, $p = NULL, $d = NULL, $i = NULL)  {
    if (!is_null($id) && !is_null($e) && !is_null($da) && !is_null($p) && !is_null($d) && !is_null($i)) {
      $this->idc=$id;
      $this->espece = $e;
      $this->date_acq = $da;
      $this->prix = $p;
      $this->description= $d;
      $this->image=$i;
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

    function creationPanier(){
        if (empty($_SESSION['panier'])){
            $_SESSION['panier']=array();
            $_SESSION['panier']['idc'] = array();
            $_SESSION['panier']['libelleProduit'] = array();
            $_SESSION['panier']['qteProduit'] = array();
            $_SESSION['panier']['prixProduit'] = array();
            $_SESSION['panier']['verrou'] = false;
        }
        return true;
    }

    function ajouterArticle($idc,$libelleProduit,$qteProduit,$prixProduit){
        //Si le panier existe
        if (ModelCactus::creationPanier() && !ModelCactus::isVerrouille())
        {
            //Si le produit existe déjà on ajoute seulement la quantité
            $positionProduit = array_search($idc,  $_SESSION['panier']['idc']);

            if ($positionProduit !== false)
            {
                $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
            }
            else
            {
         //Sinon on ajoute le produit
                array_push( $_SESSION['panier']['idc'],$idc);
                array_push( $_SESSION['panier']['libelleProduit'],$libelleProduit);
                array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
                array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
            }
        }
        else
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
        }

    function supprimerArticle($idc){
      //Si le panier existe
          if (ModelCactus::creationPanier() && !ModelCactus::isVerrouille())
          {
            //Nous allons passer par un panier temporaire
            $tmp=array();
            $tmp['idc'] = array();
            $tmp['libelleProduit'] = array();
            $tmp['qteProduit'] = array();
            $tmp['prixProduit'] = array();
            $tmp['verrou'] = $_SESSION['panier']['verrou'];

            for($i = 0; $i < count($_SESSION['panier']['idc']); $i++)
            {
                if ($_SESSION['panier']['idc'][$i] !== $idc)
                {
                    array_push( $tmp['idc'],$_SESSION['panier']['idc'][$i]);
                    array_push( $tmp['libelleProduit'],$_SESSION['panier']['libelleProduit'][$i]);
                    array_push( $tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
                    array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
                }

            }
            //On remplace le panier en session par notre panier temporaire à jour
            $_SESSION['panier'] =  $tmp;
            //On efface notre panier temporaire
            unset($tmp);
          }
            else
                echo "Un problème est survenu veuillez contacter l'administrateur du site.";
          }

    function modifierQTeArticle($idc,$qteProduit){
   //Si le panier éxiste
        if (ModelCactus::creationPanier() && !ModelCactus::isVerrouille())
        {
      //Si la quantité est positive on modifie sinon on supprime l'article
            if ($qteProduit > 0)
            {
            //Recharche du produit dans le panier
                $positionProduit = array_search($idc,  $_SESSION['panier']['idc']);

                if ($positionProduit !== false)
                {
                    $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
                }
            }
                else
                    supprimerArticle($idc);
        }
        else
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }

    function MontantGlobal(){
        $total=0;
        for($i = 0; $i < count($_SESSION['panier']['idc']); $i++)
        {
            $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
        }
        return $total;
    }

    function isVerrouille(){
        if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
            return true;
        else
            return false;
    }

    function supprimePanier(){
        unset($_SESSION['panier']);
    }
}

?>