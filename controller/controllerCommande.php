<?php
require_once File::build_path(array("model","ModelCommande.php")); 
// chargement du modèle

class ControllerCommande {
  
private static $object = 'commande';

    public static function readHistorique() {

        if (isset($_SESSION["id"])) {
           $isAdmin = ModelUtilisateur::isAdmin($_SESSION["id"]);

           if ($isAdmin==1 || $_SESSION["id"]==$_GET["login"]) {

                $tab_c = ModelCommande::selectCommande($_GET["login"]);     //appel au modèle pour gerer la BD
                if (!empty($tab_c)) {
                    $view = 'historique';
                    $pagetitle = 'Commande';
                    require File::build_path(array("view","view.php"));  //"redirige" vers la vue
                }
                else {
                    $view = 'noHistorique';
                    $pagetitle = 'Commande';
                    require File::build_path(array("view","view.php"));  //"redirige" vers la vue
                }
            }
            
        }

        if (!isset($_SESSION["id"]) || ($isAdmin!=1 && $_SESSION["id"]!=$_GET["login"])) {
            $view = 'pasAdmin';
            $controller = 'utilisateur';
            $pagetitle = 'Listes des utilisateurs';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue        
        }
    } 

    public static function terminerCommande() {

        if (!isset($_SESSION["id"])) { // Verifie si l'utilisateur est connecté
            echo "<div class='alert alert-warning'>Veuillez vous connecter pour terminer votre commande</div>";
            controllerUtilisateur::connect();

        }
        else {
            $nbArticles=count($_SESSION['panier']['idc']); // Compte le nombre de produit présent dans le panier
            if ($nbArticles <= 0)
                echo "<tr><td>Votre panier est vide </ td></tr>";
                else {
                    $commande = new ModelCommande('NULL', $_SESSION["id"], date("Y-m-d"), ModelCactus::MontantGlobal());
                    ModelCommande::save($commande);
                    $idcom = ModelCommande::getLastId($_SESSION["id"]);
                    for ($i=0 ;$i < $nbArticles ; $i++) {
                        ModelCommande::saveLigneCommande($idcom, $_SESSION['panier']['idc'][$i], 
                                                                 $_SESSION['panier']['prixProduit'][$i], 
                                                                 $_SESSION['panier']['qteProduit'][$i]);
                    }
                    ModelCactus::supprimePanier();
                }
            $view = 'commandeValidee';
            $pagetitle = 'Commande validée';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue        
        }
    }
}
?>