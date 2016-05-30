<?php

require_once 'Modeles/utilisateurs.php';
require_once 'Vues/vue.php';

 class inscription{

   public function verif(){
     $user = new utilisateurs();

     $user = new utilisateurs();
     $nom=$_POST['nom'];
     $prenom=$_POST['Prenom'];
     $email=$_POST['Email'];
     $confirmEmail = $_POST['ConfirmEmail'];
     $pseudo=$_POST['pseudo'];
     $motDePasse=$_POST['MotDePasse'];
     $confirmMotDePasse = $_POST['ConfirmMotDePasse'];
     $envoyer = $_POST['Envoyer'];
     $jour = $_POST['jour'];
     $mois = $_POST['mois'];
     $annee = $_POST['annee'];
     $sexe = $_POST['Sexe'];

     if(isset($envoyer) && $envoyer == 'Envoyer'){
       if (($nom != "") && ($prenom != "") && ($sexe != "") && ($_POST['cp'] != "") && ($email != "") && ($confirmEmail != "") && ($pseudo != "") && ($motDePasse != "")
       && ($confirmMotDePasse != "")){
         $resultatP = $user->verifPseudo()->fetch();
         $resultatE = $user->verifEmail()->fetch();
         if(($email == $confirmEmail) && ($motDePasse == $confirmMotDePasse)){
           if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)){
             if (!$resultatP && !$resultatE){
               $resultatCP = $user->verifCP()->fetch();
               if ($resultatCP){
                 if (iconv_strlen($motDePasse)>=8){
                   if (iconv_strlen($pseudo)<=12){
                     $cle = md5(microtime(TRUE)*100000);
                     $user->ajoutUtilisateurBdd($cle);

                     $destinataire = $email;
                     $sujet = "Confirmation d'inscription" ;
                     $entete = "Inscription sur le site" ;
                     $message = "Bienvenue sur TeamHub,

    Merci de votre inscription et bienvenue sur TeamHub !
    Pour confirmer votre inscription, veuillez cliquer sur le lien ci-dessous :
    http://teamhub.pingfiles.fr/index.php?page=validationcompte&pseudo=".$_POST['pseudo']."&cle=".$cle."
    ---------------
    Ceci est un mail automatique, Merci de ne pas y répondre.";

                     mail($destinataire, $sujet, $message, $entete);

                     header("Location: index.php?page=mailnonconfirme");
                   } else {
                     ?> <script> alert("Votre Pseudo ne doit pas dépasser 12 caractères !")</script> <?php
                   }
                 } else {
                   ?> <script> alert("Votre mot de passe doit comporter plus de 8 caractères !")</script> <?php
                 }
               } else {
                 ?> <script> alert("Ce code Postal n'est pas valable !")</script> <?php
               }
             }
             else{
               if ($resultatP) {
                 ?> <script> alert("Ce pseudo est déjà utilisé")</script> <?php
                }
               elseif ($resultatE) {
                 ?> <script> alert("Vous êtes déjà inscrit")</script> <?php
                }
             }
           } else {
             ?> <script> alert("L'Email renseigné n'est pas correct !")</script> <?php
           }
         }
         else{
           if ($email != $confirmemail){
             ?> <script> alert("Les adresses mail saisies ne sont pas identiques.")</script> <?php
           }
           elseif ($motDePasse != $confirmMotDePasse){
             ?> <script> alert("Les mots de passe saisis ne sont pas identiques.")</script> <?php
           }
         }
       }

       else{
         ?> <script> alert("Des champs n'ont pas été remplis")</script> <?php
       }
     }
     $vue = new Vue('Inscription');
     $vue->generer();
   }

   public function affichageNonConfirme(){
     $vue = new Vue('MailNonConfirme');
     $vue->generer();
   }

   public function validationCompte(){
     $user = new utilisateurs();
     $cleActif = $user->recupCleActifCompte()->fetch();
     if (isset($_POST['validation'])){
       if ($cleActif[u_cle] == $_GET['cle']){
         $activationCompte = $user->validerCompte();
         header("Location: index.php?page=accueil");
       }
     }
     $vue = new Vue('ValidationCompte');
     $vue->generer();
   }
 }
 ?>
