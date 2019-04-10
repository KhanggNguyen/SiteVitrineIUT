<?php
require_once File::build_path(array("model","ModelCactus.php")); 
// chargement du modèle



class ControllerCactus {

    
private static $object = 'cactus';

    

    public static function accueil() {
        
        $view = 'accueil';
                
        $pagetitle = 'Accueil';
                
        require File::build_path(array("view","view.php"));  //"redirige" vers la vue
    }

    public static function readAll() {
        $tab_v = ModelCactus::selectAll();     //appel au modèle pour gerer la BD
        $view = 'list';
        $pagetitle = 'Liste des cactus';
        require File::build_path(array("view","view.php"));  //"redirige" vers la vue
    }

    public static function read() {

        if (isset($_SESSION["id"])) {
           $isAdmin = ModelUtilisateur::isAdmin($_SESSION["id"]);
           if ($isAdmin==1) {

                $v = ModelCactus::select($_GET["idc"]);     //appel au modèle pour gerer la BD
                if ($v) {
                    $view = 'detailAdmin';
                    $pagetitle = 'cactus';
                    require File::build_path(array("view","view.php"));  //"redirige" vers la vue
                }
                else {
                    $view = 'error';
                    $pagetitle = 'ERROR 404';
        	        $message = "Ce cactus n'existe pas.";
        	        require File::build_path(array("view","view.php"));  //"redirige" vers la vue
                }
                
            }
        }
        else {
            $v = ModelCactus::select($_GET["idc"]);     //appel au modèle pour gerer la BD
            if ($v) {
                $view = 'detail';
                $pagetitle = 'cactus';
                require File::build_path(array("view","view.php"));  //"redirige" vers la vue
            }
            else {
                $view = 'error';
                $pagetitle = 'ERROR 404';
                $message = "Ce cactus n'existe pas.";
                require File::build_path(array("view","view.php"));  //"redirige" vers la vue
            }
        }
    }
    
    public static function create() {

        if (isset($_SESSION["id"])) {
           $isAdmin = ModelUtilisateur::isAdmin($_SESSION["id"]);
           if ($isAdmin==1) {

                $cactus = new ModelCactus("","","","","","");
                $view = 'update';
                $champ = "required";
                $action = 'created';
                $pagetitle = 'Formulaire de création';
    	      	require File::build_path(array("view","view.php"));  //"redirige" vers la vue
            }
        }
        if (!isset($_SESSION["id"]) || $isAdmin!=1) {
            $view = 'pasAdmin';
            $pagetitle = 'Listes des utilisateurs';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue        
        }
    }

    public static function created() {

        if (isset($_SESSION["id"])) {
           $isAdmin = ModelUtilisateur::isAdmin($_SESSION["id"]);
           if ($isAdmin==1) {

                $cactus = new ModelCactus('NULL',
                                         $_GET["espece"],
                                         $_GET["date_acq"],
                                         $_GET["prix"],
                                         $_GET["description"],
                                         $_GET["image"]);

                ModelCactus::save($cactus);
                $view = 'created';
                $pagetitle = 'Formulaire de creation';
                require File::build_path(array("view","view.php"));
            }
        }
        if (!isset($_SESSION["id"]) || $isAdmin!=1) {
            $view = 'pasAdmin';
            $pagetitle = 'Listes des utilisateurs';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue        
        }
    }

    public static function delete() {

        if (isset($_SESSION["id"])) {
           $isAdmin = ModelUtilisateur::isAdmin($_SESSION["id"]);
           if ($isAdmin==1) {

                $view = 'delete';
                $pagetitle = 'Formulaire de suppression';
                require File::build_path(array("view","view.php"));  //"redirige" vers la vue
            }
        }
        if (!isset($_SESSION["id"]) || $isAdmin!=1) {
            $view = 'pasAdmin';
            $pagetitle = 'Listes des utilisateurs';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue        
        }
    }

    public static function deleted() {

        if (isset($_SESSION["id"])) {
           $isAdmin = ModelUtilisateur::isAdmin($_SESSION["id"]);
           if ($isAdmin==1) {

                $controller = "cactus";
                ModelCactus::delete($_GET["idc"]);
                require File::build_path(array("view","cactus","deleted.php"));
                ControllerCactus::readAll();
            }
        }
        if (!isset($_SESSION["id"]) || $isAdmin!=1) {
            $view = 'pasAdmin';
            $pagetitle = 'Listes des utilisateurs';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue        
        }
    }

    public static function update() {

        if (isset($_SESSION["id"])) {
            $isAdmin = ModelUtilisateur::isAdmin($_SESSION["id"]);
            if ($isAdmin==1) {

                $cactus = ModelCactus::select($_GET["idc"]);
                $view = 'update';
                $champ = 'readonly';
                $action = 'updated';
                $pagetitle = 'Formulaire de modification';
                require File::build_path(array("view","view.php"));  //"redirige" vers la vue
            }
        }
        if (!isset($_SESSION["id"]) || $isAdmin!=1) {
            $view = 'pasAdmin';
            $pagetitle = 'Listes des utilisateurs';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue        
        }
    }

    public static function updated() {

        if (isset($_SESSION["id"])) {
            $isAdmin = ModelUtilisateur::isAdmin($_SESSION["id"]);
            if ($isAdmin==1) {

                $cactus = new ModelCactus($_GET["idc"],
                                         $_GET["espece"],
                                         $_GET["date_acq"],
                                         $_GET["prix"],
                                         $_GET["description"],
                                         $_GET["image"]);

                ModelCactus::update($cactus);
                $view = 'updated';
                $pagetitle = 'Formulaire de modification';
                require File::build_path(array("view","view.php"));
            }
        }
        if (!isset($_SESSION["id"]) || $isAdmin!=1) {
            $view = 'pasAdmin';
            $pagetitle = 'Listes des utilisateurs';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue        
        }
    }

    public static function monPanier(){
        $view = 'panier';
        $pagetitle = 'Votre Panier';
        require File::build_path(array("view","view.php"));  
    }

    public static function ajouterCactus(){
        $vQte = $_GET["qte"];
        $v = ModelCactus::select($_GET["idc"]);
        $vEspece = $v->getEspece();
        $vPrix = $v->getPrix();
        ModelCactus::ajouterArticle($_GET["idc"],$vEspece, $vQte, $vPrix); 
        $view = 'panier';
        $pagetitle = 'Votre Panier';
        require File::build_path(array("view","view.php"));
    }

    public static function supprimerCactus(){
        $vIdc = $_GET["idc"];
        ModelCactus::supprimerArticle($vIdc);
        $view = 'panier';
        $pagetitle = 'Votre Panier';
        require File::build_path(array("view","view.php"));
    }


}
?>