# test-technique
test-technique njuko

Test technique njuko.com
=======================

Description
------------

Ce test technique à pour but d'évaluer les compétences en développement Web sur le framework ZF2 à l'aide de l'ORM Doctrine 2

Le but de ce test est de réaliser les étapes suivantes :

1. Faire fonctionner le bouton de supression d'un utilisateur

2. Terminer l'édition d'un utilisateur

3. Rajouter la possibilité de saisir la date de naissance d'un utilisateur (création / édition)

4. Rajouter la possibilité de saisir l'adresse postale d'un utilisateur (création / édition)

5. Rajouter dans la listes des utilisateurs les informations de date de naissace et d'adresse postale

6. Rendre le tableau des utilisateurs "triable"

A savoir
------------

La mise à jour du modèle ce fait en ligne de commande en utilisant doctrine avec la commande (executée à la racine du projet) : ./vendor/bin/doctrine-module orm:schema-tool:update --force

La génération de proxies (spécifiques à Doctrine) : ./vendor/bin/doctrine-module orm:generate-proxies

Les dépendances sont gérées à l'aide de composer : composer.phar install --dev

Contact
------------
david@njuko.com

skype ribes_david

tel 0630194957



ZendSkeletonApplication
=======================

Introduction
------------
This is a simple, skeleton application using the ZF2 MVC layer and module
systems. This application is meant to be used as a starting place for those
looking to get their feet wet with ZF2.


Installation
------------

Using Composer (recommended)
----------------------------
The recommended way to get a working copy of this project is to clone the repository
and use `composer` to install dependencies using the `create-project` command:

    curl -s https://getcomposer.org/installer | php --
    php composer.phar create-project -sdev --repository-url="https://packages.zendframework.com" zendframework/skeleton-application path/to/install

Alternately, clone the repository and manually invoke `composer` using the shipped
`composer.phar`:

    cd my/project/dir
    git clone git://github.com/zendframework/ZendSkeletonApplication.git
    cd ZendSkeletonApplication
    php composer.phar self-update
    php composer.phar install

(The `self-update` directive is to ensure you have an up-to-date `composer.phar`
available.)

Another alternative for downloading the project is to grab it via `curl`, and
then pass it to `tar`:

    cd my/project/dir
    curl -#L https://github.com/zendframework/ZendSkeletonApplication/tarball/master | tar xz --strip-components=1

You would then invoke `composer` to install dependencies per the previous
example.

Using Git submodules
--------------------
Alternatively, you can install using native git submodules:

    git clone git://github.com/zendframework/ZendSkeletonApplication.git --recursive

Virtual Host
------------
Afterwards, set up a virtual host to point to the public/ directory of the
project and you should be ready to go!

Alternatively — if you are using PHP 5.4 or above — you may start the internal PHP cli-server in the public
directory:

    cd public
    php -S 0.0.0.0:8080 index.php

This will start the cli-server on port 8080, and bind it to all network
interfaces.
