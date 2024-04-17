<?php

session_start();

if(isset($_GET["action"])) {
    switch($_GET["action"]){
        case "register":
            if($_POST["submit"]){
                // connexion à la bdd
                $pdo = new PDO("mysql:host=localhost;dbname=lucie_forum;charset=utf8", "root", "");

                // filtrer la saisie des champs du formulaire d'inscription
                $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if($nickname && $email && $pass1 && $pass2){
                    // on récupère l'email pour vérifier l'existance en BDD de l'utilisateur
                    $requete = $pdo->prepare("SELECT * FROM user WHERE email = :email");
                    $requete->execute(["email" => $email]);
                    $user = $requete->fetch();

                    // si l'utilisateur existe
                    if($user){
                        header("Location : register.php"); exit;
                    } else {
                        // si les mots de passe sont identiques et sup/= à 5
                        if($pass1 == $pass2 && strlen($pass1 >= 5)){
                            // insertion de l'utilisateur en BDD
                            $insertUser = $pdo->prepare("
                            INSERT INTO user (nickname, email, password) VALUES (:nickname, :email, :password)");
                            $insertUser->execute([
                                "nickname" => $nickname,
                                "email" => $email,
                                "password" => password_hash($pass1, PASSWORD_DEFAULT)
                            ]);
                        
                            // on indique à l'utilisateur que son compte a bien été créé
                            echo "Le compte a bien été créé !";
                            // on le redirige vers la connexion
                            header("Location : login.php"); exit;

                        } else {
                            // message d'erreur : "Les mots de passe ne correspondent pas ou mot de passe trop court"
                            echo "Les mots de passe ne correspondent pas ou mot de passe trop court";
                        } 
                    }
                } else {
                    // message d'erreur : problème de saisie dans les champs du formulaire
                    echo "problème de saisie dans les champs du formulaire";
                }
            }
            
            header("Location : register.php"); exit;
            
            break;
            
            case "login":
                
                if($_POST["submit"]){
                    // connexion à la bdd
                    $pdo = new PDO("mysql:host=localhost;dbname=lucie_forum;charset=utf8", "root", "");

                    //  on filtre les données du champ de formulaire
                    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                    $password = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    //  on vérifier si les filtres sont valides
                    if($email && $password) {
                        // on récupère les infos de l'utilisateur qui veut se connecter
                        $requete = $pdo->prepare("SELECT * FROM user WHERE email = :email");
                        $requete->execute(["email" => $email]);
                        $user = $requete->fetch();
                        // var_dump($user);die;

                        // si l'utilisateur existe
                        if($user){
                            // on récupère le mot de passe dans la tableau user
                            $hash = $user["password"];
                            // on vérifie le mdp : $password = mdp saisi, $hash = mdp dans la bdd
                            if(password_verify($password, $hash)) {
                                // on stocke le tableau user dans le tableau user de la superglobale user pour créer la session utilisateur
                                // on stocke en session l'intégralité des infos du user
                                $_SESSION["user"] = $user;
                                // on redirige l'utilisateur vers la page d'accueil
                                header("Location: home.php"); exit;
                                // dans le framework
                                // $this->redirectTo("home","index");
                            } else {
                                header("Location: login.php");exit;
                                // message utilisateur inconnu ou mdp incorrect
                            }
                        } else {
                            // message utilisateur inconnu ou mdp incorrect
                            header("Location: login.php");exit;
                        }
                    }
                }
                
                header("Location : login.php"); exit;
            break;

            case "profile":
                header("Location: profile.php");exit;
            break;

            case "logout":
                //  on supprime le tableau user qui est dans $_session
                // donc on le déconnecte
                unset($_SESSION["user"]);
                header("Location: home.php"); exit;
            break;
    }
}