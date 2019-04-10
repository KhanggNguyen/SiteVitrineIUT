<?php

require_once File::build_path(array("model","Model.php"));

class ModelUtilisateur extends model {

    private $login;
    private $nom;
    private $prenom;
    private $mail;
    private $mdp;
    private $cle;
    private $image;

    protected static $object = 'utilisateur';
    protected static $primary = 'login';

    // Getter générique (pas expliqué en TD)
    public function get($nom_attribut) {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    // Setter générique (pas expliqué en TD)
    public function set($nom_attribut, $valeur) {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }

    // un constructeur
    public function __construct($login = NULL, $nom = NULL, $prenom = NULL, $mail = NULL, $mdp = NULL, $image = NULL) {
        if (!is_null($login) && !is_null($nom) && !is_null($prenom) && !is_null($mail) && !is_null($mdp) && !is_null($image)) {
            $this->login = $login;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->mail = $mail;
            $this->mdp = $mdp;
            $this->image = $image;
            $clef = ModelUtilisateur::random(5);
            $this->cle = $clef;
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

    public static function isUser ($login, $mdp) {

        try {
            $sql = "SELECT actif, login, mdp from utilisateur WHERE mdp=:mdp_tag AND login=:log_tag";
            $values = array(
            "log_tag" => $login,
            "mdp_tag" => $mdp,
            );
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($values);
            $res = $req_prep->fetch();//récuperer l'actif de la bdd
            $stt_user = $res['actif'];
            // compte le nombre de ligne trouvé par le requête
            if($stt_user==1 && $res['mdp']== $mdp && $res['login']==$login){
                $nb = 1; // Tous juste
            }
            elseif($stt_user==0 && $res['mdp']== $mdp && $res['login']==$login ){
                $nb = 2; //Pas actif
            }
            else{
                $nb = 0; // Nom utilisateur ou mot de passe non valide
            }
        }
        catch (Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
        return $nb;
    }  

    public static function isAdmin ($login) {

        try {
            $sql = "SELECT isAdmin from utilisateur WHERE login=:log_tag";
            $values = array(
            "log_tag" => $login,
            );
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($values);
            $res = $req_prep->fetch();//récuperer l'actif de la bdd
            return $res['isAdmin'];
        }
        catch (Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }  
    
    public static function random($car) {
        $string = "";
        $chaine = "abcdefghijklmnopqrstuvwxyz";
        $chaine = "abcdefghijklmnopqrstuvwxyz";
        srand((double)microtime()*1000000);
        for($i=0; $i<$car; $i++) {
           $string .= $chaine[rand()%strlen($chaine)];
        }
        return $string;
    }
    
    public static function envoieClefUser($login){
        try {
            
            $sql ="SELECT mail, cle FROM utilisateur WHERE login=:login_tag";
            $values = array(
                "login_tag" => $login,
            );
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($values);
            $res = $req_prep->fetch();//récuperer la ligne de la bdd
            $clefbdd = $res['cle'];//récuperer la cle géneré de la bdd
            $to = $res['mail'];//récuperer le mail de $login 
            $sujet = "Activer votre compte";
            $entete = "From: Admin@Cactaceae.com";
            $message = "Bienvenue sur notre site,\r\n
            veuillez cliquer sur le lien ci dessous ou \r\n
            copier/coller dans votre navigateur \r\n
            <a href=\"http://infolimon.iutmontp.univ-montp2.fr/~nguyenh/Projet/index.php?action=activer&controller=utilisateur\">Cliquez ici !</a>\r\n
            Votre code d`activation est : ".$clefbdd."\r\n
            --------\r\n";
            //'Ceci est un mail automatique, merci de ne pas y répondre.';
            mail ($to, $sujet, $message, $entete);          
        }
        catch(Exception $e){
            echo 'Exception reçue : ', $e->getMessage(), "\n";
        }
    }

    public static function verifUser($login, $clef){
        try{

            $sql = " SELECT cle, actif FROM utilisateur WHERE login = :login_tag";
            $values = array(
                "login_tag" => $login);
            $req_prep = Model::$pdo-> prepare($sql);
            $req_prep->execute($values);
            $res = $req_prep->fetch();//récuperer la ligne de tab correspondant
            $clebdd = $res['cle'];//récuperer la clé de la bdd
            $actif = $res['actif'];//récuperer la valeur de l'actif

            if($actif == '1'){
                $bool = 2;
            }
            else{
                if($clef == $clebdd){
                    $sql = "UPDATE utilisateur SET actif = 1 WHERE login = :login_tag";
                    $values = array("login_tag" => $login);
                    $req_prep = Model::$pdo->prepare($sql);
                    $req_prep->execute($values);
                    $bool = 1;
                    //return 1 si code est bon réussi 
                }
                else{
                    echo "Erreur! votre compte ne peut être activé...";
                    $bool = 0;
                    //0 sinon
                }
            }
            return $bool;
        }
        catch(Exception $e){
            echo 'Exception reçue : ', $e->getMessage(), "\n";
        }
    }
}