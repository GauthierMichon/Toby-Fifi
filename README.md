# Toby&Fifi

## Cloner le projet

Tout d'abord vous devez installez yarn à l'adresse suivante : 

https://classic.yarnpkg.com/en/docs/install/#windows-stable

Après avoir récupérer le projet sur git, et avoir lancer votre terminal dans le bon dossier. Vous faites les commandes suivantes : 

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
<br/>`symfony console doctrine:fixtures:load`

Enfin lancer votre server avec la commande : 
<br/>`symfony server:start`

Allez à cet url : 
<br/>`http://127.0.0.1:8000/`