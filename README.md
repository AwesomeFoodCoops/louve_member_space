La Louve member space
=====================

Site membre de la coopérative "La Louve".

Installation
------------

Pour installer les dépendances::

    cd html
    composer install

Développer en local
-------------------

Le site se lance en local::

    cd html/public
    php -S localhost:8080 index.php

Le site est alors accessible dans un navigateur à l'url `localhost:8080`.
Des données "fake" permettent d'éviter la communication avec Odoo, le ldap et la BDD MySQL.
Il faudra quand même installer la librairie ldap PHP: http://stackoverflow.com/questions/36834926/php-ldap-connection-fonction-issue

Déploiement (à mettre à jour)
-----------------------------

Utilisation d'un .htaccess => AllowOverride All dans la conf apache du dossier servi:

```
<VirtualHost *:8080>
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

Ne pas oublier d'installer les dépendances avec `composer install`

Le script `deploy_site_member.sh` permet de mettre à jour le site avec la dernière version de master.

Pour l'utiliser, se connecter en SSH sur le serveur puis::

	cd site_deploy/
	./deploy_site_member.sh

Par défaut le script échoue si il y a des différences entre le serveur et Git afin de ne pas supprimer des hotfixes sur le serveur. Pour forcer la mise à jour du code, on peut ajouter `--force`::

	./deploy_site_member.sh --force

Pour ne pas mettre les infos de Git dans le dossier servi par Apache, le "repository" Git et le "working tree" (là où sont effectivement les fichiers) sont séparés. De même seul le dossier `html` de ce projet est "copié" dans `/var/www`

```bash
├── root
│   └── site_deploy
│       ├── deploy_site_member.sh
│       └── .git/						# Git local repository
|
└── var
    └── wwww							# Git working tree = where files are
		└── html						# Only html directory is retrieved
```

