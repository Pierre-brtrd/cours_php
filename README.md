# Cours PHP

Ce dépôt à pour but de vous former aux bases du langage de programmation PHP.

Il fonctionne avec Docker pour la mise en place du server PHP ainsi que la configuration MySQL et PHPMyAdmin.

## Configuration de l'application

### Docker

Dans un premier temps, vous allez devoir builder le container Docker qui accueillera votre application.

Il faut donc avant toute chose installer Docker sur votre poste, <a href="https://docs.docker.com/get-docker/">cliquez-ici pour télécharger Docker</a>.

Les fichiers de configuration du build sont déjà mis en place, vous avez simplement à ouvrir le dépôt avec VsCode, ensuite ouvrir un terminal et rentrer la commande :

```bash
docker-compose up -d
```

### MySQL

L'application utilise une connection en base de données SQL, vous devez donc avant de lancer l'application créer la base de donnée ainsi que les tables qui sont utilisées dans l'application.

Si votre container Docker tourne sur votre poste, vous devez avoir PHPMyAdmin qui tourne également, vous pouvez votre rendre sur -> `http://localhost:8000` pour accéder à PHPMyAdmin qui vous aidera à créer la base de données ainsi que les tables.

Rentrez les informations de connexions :

- Utilisateur : `root`
- Mot de passe : `LAISSER VIDE`

Une fois dans PHPMyAdmin vous devez créer une **base de données** :

- nom de la base : **`data_site`**

Ensuite, vous allez devoir créer **3 tables** :

- **utilisateurs** :

  - id
  - nom
  - email
  - password
  - image
  - actif

- **features** :

  - id
  - feature_name
  - feature_desc
  - feature_image

- **articles** :
  - article_id
  - titre
  - auteur_id
  - Description
  - date

## Frontend application :

L'application PHP est maintenant prête à être utilisée.

Vous pouvez y accéder sur l'url -> `http://localhost:8080`.

Tous les fichiers de votre application (PHP, CSS, image etc..) se trouve dans le dossier app.

Vous avez simplement à modifier ou ajouter des fichiers dans le dossier app pour avoir un rendu sur le front de votre application web PHP.
