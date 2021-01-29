# Toby&Fifi

## Cloner le projet

Tout d'abord vous devez installez symfony, composer, nodeJS et yarn aux adresses suivantes : 

https://symfony.com/download
<br/>
https://getcomposer.org/download/
<br/>
https://nodejs.org/fr/download/
<br/>
https://classic.yarnpkg.com/en/docs/install/#windows-stable


Vous devez également installer XAMPP ou un équivalent(MAMMP par exemple)



Après avoir récupérer le projet sur git, et avoir lancer votre terminal dans le bon dossier. Vous faites les commandes suivantes : 

<br/>`composer require symfony/swiftmailer-bundle`
<br/>`composer require symfony/webpack-encore-bundle --dev`
<br/>`yarn install`
<br/>`yarn add @symfony/webpack-encore --dev`
<br/>`yarn add sass-loader@^9.0.1 node-sass --dev`
<br/>`npm uninstall node-sass `
<br/>`npm install node-sass@4.14.1`
<br/>`yarn encore dev`


Créez la BDD avec les commandes (Changer le .env si besoin) : 

<br/>`symfony console doctrine:database:create`
<br/>`symfony console doctrine:migrations:migrate`

Ensuite aller sur l'adresse suivante :

</br>`http://localhost:8080/phpmyadmin/`

Cliquez sur la base de donnée toby-fifi qui vient d'être créée. 
Cliquez sur `importer`, et importez le fichier .sql qui se trouve dans le git.

Enfin lancer votre server avec la commande : 
<br/>`symfony server:start`

Allez à cet url : 
<br/>`http://127.0.0.1:8000/home`


Identifiants de l'admin :
<br/>Email : TobyFifi@gmail.com
<br/>Mot de passe : admin33