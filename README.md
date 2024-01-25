# Projet Vide

Bienvenu dans ce projets vide !   

C'est un projets Symfony 7 vide.  
La documentation de [symfony, c'est ici !](https://symfony.com/doc/current/index.html)

## Note
Pour ce projets, je vous laisse le choix de le faire marcher avec docker ou non.  
Certain on des problème de performance/lenteur avec docker, vous pourrez utiliser votre composer/php local en gardant bien en tête que ce n'est pas une bonne pratique.

Sur la configuration docker ; vous verez une ligne "user" pour le service php. Elle sert a préciser quel user écrira sur la machine hote, par defaut l'identifiant du user et du groupe est 1000.  
Vous trouverez votre valeur avec la commande suivante, et changer si cela est necessaire.
```bash
echo "UID: ${UID}"
```

## Prérequis
Il faut respecter une de ces deux conditions:
- `Docker` avec `docker compose`
- `php8.2` avec les extension php`CType`, `iconv`, `session`, `simpleXML` et `Tokenizer`. Et bien sur `composer`

## Installation
Il suffi d'installer les depandance via composer

```bash
docker composer run --rm php composer install
```

ou sans docker

```bash
composer install
```

## Demarage du projets
```bash
docker compose up
```

```bash
php -S 0.0.0.0:8080 -t public
```


## Resultat Attendu
Il faut créer rapidement une petite application, avec les commande proposer par symfony. 

Vous avez la liste des maker disponible via la commande suivante:
```bash
# Avec docker
docker compose php bin/console make

# Sans docker
php bin/console make
```
Exemple de petite application:
Avoir une liste de personnes avec leurs informations de bases, une liste de batiments, et lié les personnes au batiments

Listes des points attendu:
- [ ] Créer au moins une entité avec les commandes
- [ ] Créer le fichier de migration avec la commande symfony
- [ ] Créer au moins un controller avec sa vue twig
- [ ] Créer une commande qui ajoute des données en BDD
- [ ] script bash qui execute tout les test

Listes des points bonus
- [ ] La commande d'ajout de données utilise FakerPHP
- [ ] Ajouter des test unitaire
- [ ] un dossier Githook, avec un precommit et prepush qui execute tout les tests

Listes des point bonus si vous avez le projet sur github
- [ ] Ajouter une Github Action qui execute phpstan/phpcs/phpunit


