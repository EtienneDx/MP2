# MP2
Projet d'année 2019-2020: Balance ton train

## Installation

Pour copier le code sur votre machine:

```
git clone https://github.com/EtienneDx/MP2
```

Ce projet nécéssite (composer)[https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos] pour gérer ses différentes dépendances. Une fois composer installé, il est nécéssaire d'insatller les dépendances avec la commande suivante:

```
composer install
```

Le projet nécéssite aussi une base de données accessible, dont les informations de connexion doivent être indiquées dans le fichier *.env*, fichier n'étant pas synchronisé avec git (il faut le créer à la main, à partir du fichier distant *.env.dist*)

Pour mettre à jour la base de données à partir des différentes entités (classes):

La première fois :

```
vendor/bin/doctrine orm:schema-tool:create
```

Les fois suivantes :

```
vendor/bin/doctrine orm:schema-tool:update --force --dump-sql
```

Pour lancer le programme, il suffit d'executer la commande suivante:

```
composer run
```

Il peut arriver des erreurs liées au proxy des entités, qui doivent alors être regenerés:

```
vendor/bin/doctrine orm:generate-proxies
```
