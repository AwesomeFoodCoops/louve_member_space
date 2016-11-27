La Louve member space
=====================

Espace membre de la coopérative "La Louve".

Installation
------------

Pour installer les dépendances:

    cd html
    composer install
    
Pour installer composer (Ubuntu):    

    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer

Développer en local
-------------------

Commencez déjà par créer votre propre branche. Il s'agit de faire un *fork* sur GitHub, puis un *clone* depuis votre machine. Si vous êtes n'êtes pas familier avec Git/GitHub, prenez le temps de tester [ce petit example](https://help.github.com/articles/fork-a-repo/).

Naviguez ensuite sur votre branche, et lancez le site via le serveur built-in de PHP :

    $> cd html/public
    $> php -S localhost:8080 index.php

À partir de là, le site est alors accessible dans un navigateur à l'url `localhost:8080`.

Des données "fake" permettent d'éviter la communication avec Odoo, le ldap et la BDD MySQL.
Il faudra quand même installer la librairie ldap PHP (Ubuntu): 

    sudo apt-get install php7.0-ldap	

Une fois le boulot terminé en local (sur votre *clone*), rapatriez vos modifications sur GitHub (sur votre *fork*) :

    $> git add -A
    $> git commit -m "Un p'tit message expliquant votre travail."
    $> git push origin master

À noter que vous devrez avoir une [clé SSH](https://help.github.com/articles/generating-an-ssh-key/) publique affectée à votre compte GitHub, à laquelle est associée une clé privée sur votre machine (l'exemple, cité au début, vous fera parcourir tout le workflow).

Il ne vous reste plus qu'à demander une [*pull request*](https://help.github.com/articles/about-pull-requests/)–Quelqu'un s'occupera d'inclure vos modifications pour la prochaine mise en prod'.

**P.S.** Si vous bloquez, n'hésitez pas à contacter un membre.

Déploiement (à mettre à jour)
-----------------------------

Utilisation d'un .htaccess => AllowOverride All dans la conf apache du dossier servi:

```
<VirtualHost *:80>
        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/html/public
        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
        <Directory "/var/www/html/public">
                # On peut mettre un fichier .htaccess pour rédéfinir tous
                # les paramètres d'accès au dossier
                AllowOverride All
        </Directory>
</VirtualHost>
```
Autoriser `mod_rewrite`::

    sudo a2enmod rewrite

Ne pas oublier d'installer les dépendances avec `composer install` (et la lib ldap php voir au dessus)

Le script `deploy_site_member.sh` permet de mettre à jour le site avec la dernière version de master.

Pour l'utiliser, se connecter en SSH sur le serveur puis:

	cd ~/deploy/espacemembres
	sudo ./deploy.sh

Par défaut le script échoue si il y a des différences entre le serveur et Git afin de ne pas supprimer des hotfixes sur le serveur. Pour forcer la mise à jour du code, on peut ajouter l'option`force`:

	./deploy_site_member.sh force

Pour ne pas mettre les infos de Git dans le dossier servi par Apache, le "repository" Git et le "working tree" (là où sont effectivement les fichiers) sont séparés. De même seul le dossier `html` de ce projet est "copié" dans `/data/espacemembres`

```bash
├── ~
│   └── deploy
│       └── espacemembres
│	    └── deploy.sh
│           	└── .git/					# Git local repository
|
└── data
    └── espacemembres						# Git working tree = where files are
	└── html						# Only html directory is retrieved
```

