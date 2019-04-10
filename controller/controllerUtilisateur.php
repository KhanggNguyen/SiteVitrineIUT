<?php
require_once File::build_path(array("model","ModelUtilisateur.php")); // chargement du modèle
require_once File::build_path(array("lib","Security.php")); // chargement du modèle

class ControllerUtilisateur {
    
    protected static $object = 'utilisateur';

    public static function readAll() {

        if (isset($_SESSION["id"])) {
           $isAdmin = ModelUtilisateur::isAdmin($_SESSION["id"]);
           if ($isAdmin==1) {
        
            $tab_v = ModelUtilisateur::selectAll();     //appel au modèle pour gerer la BD
            $view = 'list';
            $controller = 'utilisateur';
            $pagetitle = 'Listes des utilisateurs';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue
            }
        }
        if (!isset($_SESSION["id"]) || $isAdmin!=1) {
            $view = 'pasAdmin';
            $controller = 'utilisateur';
            $pagetitle = 'Listes des utilisateurs';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue        
        }
    }   

    public static function read() {

        if (isset($_SESSION["id"])) {
           $isAdmin = ModelUtilisateur::isAdmin($_SESSION["id"]);

           if ($isAdmin==1 || $_SESSION["id"]==$_GET["login"]) {

                $v = ModelUtilisateur::select($_GET["login"]);     //appel au modèle pour gerer la BD
                $controller = 'utilisateur';
                if ($v) {
                    $view = 'detail';
                    $pagetitle = 'Utilisateur';
                    require File::build_path(array("view","view.php"));  //"redirige" vers la vue
                }
            }
            if (!isset($_SESSION["id"]) || ($isAdmin!=1 && $_SESSION["id"]!=$_GET["login"])) {
                $view = 'pasAdmin';
                $controller = 'utilisateur';
                $pagetitle = 'Listes des utilisateurs';
                require File::build_path(array("view","view.php"));  //"redirige" vers la vue        
            }
            
        }   
        else {
            $view = 'pasAdmin';
            $controller = 'utilisateur';
            $pagetitle = 'Listes des utilisateurs';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue        
        }
    }

    public static function delete() {

        if (isset($_SESSION["id"])) {
           $isAdmin = ModelUtilisateur::isAdmin($_SESSION["id"]);
           if ($isAdmin==1 || $_SESSION["id"]==$_GET["login"]) {

                $view = 'delete';
                $controller = 'utilisateur';
                $pagetitle = 'Formulaire de suppression';
                require File::build_path(array("view","view.php"));  //"redirige" vers la vue
            }
        }
        if (!isset($_SESSION["id"]) || ($isAdmin!=1 && $_SESSION["id"]!=$_GET["login"])) {
            $view = 'pasAdmin';
            $controller = 'utilisateur';
            $pagetitle = 'Listes des utilisateurs';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue        
         }

    }

    public static function deleted() {

        if (isset($_SESSION["id"])) {
           $isAdmin = ModelUtilisateur::isAdmin($_SESSION["id"]);
           if ($isAdmin==1 || $_SESSION["id"]==$_GET["login"]) {

                ModelUtilisateur::delete($_GET["login"]);
                require File::build_path(array("view","utilisateur","deleted.php"));
                ControllerUtilisateur::readAll();
            }
        }
        if (!isset($_SESSION["id"]) || ($isAdmin!=1 && $_SESSION["id"]!=$_GET["login"])) {
            $view = 'pasAdmin';
            $controller = 'utilisateur';
            $pagetitle = 'Listes des utilisateurs';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue        
         }
    }

    public static function create() {

        if (isset($_SESSION["id"])) {
            $isAdmin = ModelUtilisateur::isAdmin($_SESSION["id"]);
            if ($isAdmin!=1) {
                $view = 'pasAdmin';
                $controller = 'utilisateur';
                $pagetitle = 'Listes des utilisateurs';
                require File::build_path(array("view","view.php"));  //"redirige" vers la vue        

            }
        }
        if (!isset($_SESSION["id"])) {

                $user = new ModelUtilisateur("", "", "","", "","");
                $controller = 'utilisateur';
                $view = 'update';
                $champ = "required";
                $verif = "true";
                $action = 'created';
                $pagetitle = 'Formulaire de création';
                require File::build_path(array("view","view.php"));  //"redirige" vers la vue
                
        }
    }

    public static function created() {

        if (isset($_SESSION["id"])) {
           $isAdmin = ModelUtilisateur::isAdmin($_SESSION["id"]);
           if ($isAdmin!=1) {

            $view = 'pasAdmin';
            $controller = 'utilisateur';
            $pagetitle = 'Listes des utilisateurs';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue  

            }
        }
        if (!isset($_SESSION["id"]) || $isAdmin==1) {
            
            $hash = Security::chiffrer($_GET["mdp"]);
            $verif_hash = Security::chiffrer($_GET["verif_mdp"]);
            $user = new ModelUtilisateur($_GET["login"],
                                         $_GET["nom"],
                                         $_GET["prenom"],
                                         $_GET["mail"],
                                         $hash,
                                         $_GET["image"]);

            if (filter_var($_GET["mail"], FILTER_VALIDATE_EMAIL)) {
                if ($verif_hash==$hash) {

                    ModelUtilisateur::save($user);
                    ModelUtilisateur::envoieClefUser($_GET["login"]);            
                    $view = 'created';
                    $controller = 'utilisateur';
                    $pagetitle = 'Formulaire de creation';
                    require File::build_path(array("view","view.php"));
                }
                else {
                    $view = 'update';
                    $champ = "required";
                    $action = 'created';
                    $verif = "mdp";
                    $controller = 'utilisateur';
                    $pagetitle = 'Nouvelle tentative';
                    require File::build_path(array("view","view.php"));
                }
            }
            else{
                $view = 'update';
                $champ = "required";
                $action = 'created';
                $verif = "email";
                $controller = 'utilisateur';
                $pagetitle = 'Nouvelle tentative';
                require File::build_path(array("view","view.php"));
            }
        }            
    }

    public static function update() {

        if (isset($_SESSION["id"])) {
           $isAdmin = ModelUtilisateur::isAdmin($_SESSION["id"]);
           if ($isAdmin==1 || $_SESSION["id"]==$_GET["login"]) {

                $user = ModelUtilisateur::select($_GET["login"]);
                $controller = 'utilisateur';
                $view = 'update';
                $champ = 'readonly';
                $verif = "true";
                $action = 'updated';
                $pagetitle = 'Formulaire de modification';
                require File::build_path(array("view","view.php"));  //"redirige" vers la vue
            }
        }
        if (!isset($_SESSION["id"]) || ($isAdmin!=1 && $_SESSION["id"]!=$_GET["login"])) {
            $view = 'pasAdmin';
            $controller = 'utilisateur';
            $pagetitle = 'Listes des utilisateurs';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue        
        }            
    }

    public static function updated() {

        if (isset($_SESSION["id"])) {
    
           $isAdmin = ModelUtilisateur::isAdmin($_SESSION["id"]);
           if ($isAdmin==1 || $_SESSION["id"]==$_GET["login"]) {

                $hash = Security::chiffrer($_GET["mdp"]);

                if ($_GET["verif_mdp"]==$_GET["mdp"]) {
                $user = new ModelUtilisateur($_GET["login"],
                                             $_GET["nom"],
                                             $_GET["prenom"],
                                             $_GET["mail"],
                                             $hash,
                                             $_GET["image"]);

                ModelUtilisateur::update($user);
                $view = 'updated';
                $verif = "false";
                $controller = 'utilisateur';
                $pagetitle = 'Formulaire de modification';
                require File::build_path(array("view","view.php"));
                }
                else {
                    $view = 'update';
                    $champ = "required";
                    $action = 'created';
                    $verif = "false";
                    $controller = 'utilisateur';
                    $pagetitle = 'Nouvelle tentative';
                    require File::build_path(array("view","view.php"));
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

    public static function connect() {

        if (!isset($_SESSION["id"])) {
            $controller = 'utilisateur';
            $view = 'connect';
            $action = 'connected';
            $pagetitle = 'Formulaire de connexion';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue
        }
        else {
            $view = 'dejaConnect';
            $controller = 'utilisateur';
            $pagetitle = 'Listes des utilisateurs';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue        
        }   
    }
    public static function connected() {

        if (!isset($_SESSION["id"])) {
            $hash = Security::chiffrer($_GET["mdp"]);
            $isConnect = ModelUtilisateur::isUser($_GET["login"],$hash);
            if ($isConnect==1) {
                //$_SESSION['login'] = $_GET["login"];
                $res=ModelUtilisateur::select($_GET["login"]);
                $login = $res->get('login');
                $_SESSION['id'] = $login;
                $prenom = $res->get('prenom');
                $view = 'connected';
                $controller = 'utilisateur';
                $pagetitle = 'Bienvenue';
                require File::build_path(array("view","view.php"));  //"redirige" vers la vue
            } 
            elseif($isConnect == 2){
                ModelUtilisateur::envoieClefUser($_GET["login"]);
                $view = 'pasActif';
                $controller = 'utilisateur';
                $pagetitle = 'Page d`activation';
                require File::build_path(array("view","view.php"));
            }
            else {
                $view = 'errorConnect';
                $controller = 'utilisateur';
                $pagetitle = 'Pas Bienvenue';
                require File::build_path(array("view","view.php"));  //"redirige" vers la vue
            } 
        }
        else {
            $view = 'dejaConnect';
            $controller = 'utilisateur';
            $pagetitle = 'Listes des utilisateurs';
            require File::build_path(array("view","view.php"));  //"redirige" vers la vue        
        }  
            
    }

    public static function activer(){

        $view = 'activer';
        $controller = 'utilisateur';
        $pagetitle = 'Page d`activation';
        require File::build_path(array("view","view.php"));
        
    }

    public static function actived(){

        $login = $_GET['login'];
        $cle = $_GET['cle'];
        $isVerif = ModelUtilisateur::verifUser($login, $cle);
        if($isVerif==1){
            $view = 'verifie';
            $controller = 'utilisateur';
            $pagetitle = 'Page d`activation';
            require File::build_path(array("view","view.php"));
        }
        elseif($isVerif==2){
            $view= 'dejaActif';
            $controller = 'utilisateur';
            $pagetitle = 'Page d`activation';
            require File::build_path(array("view","view.php"));
        }
        else{
            $view = 'errorVerification';
            $controller = 'utilisateur';
            $pagetitle = 'Echec d`activation';
            require File::build_path(array("view","view.php"));
        }
    }

    public static function deconnect(){

        if (isset($_SESSION["id"])) {
            unset($_SESSION['id']);
            $_SESSION = array();
            $view = 'deconnexion';
            $controller = 'utilisateur';
            $pagetitle = 'deconnexion';
            require File::build_path(array("view","view.php"));
        }
        else{
            $view = 'pasConnect';
            $controller = 'utilisateur';
            $pagetitle = 'Echec deconnexion';
            require File::build_path(array("view","view.php"));
        }
    }

}


?>