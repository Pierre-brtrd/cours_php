# PHP

Ce cours a pour but de vous former au langage PHP, vous donner les bases pour pouvoir mettre en place une application web avec PHP pour concevoir un site dynamique.

Vous aurez besoin de vos compétences en HTML, CSS et Javascript ainsi que des compétences en langage SQL pour mener à bien ce cour.



## Comment ça marche ?

Lorsque vous consultez un site dynamique, le client (navigateur) envoie une demande de page au serveur.

Le serveur va ensuite recevoir la demande, et générer la page (spécialement pour le client), enfin le serveur renvoi la page qu'il vient de générer.

![16334390434907_p1c2-5](https://user.oc-static.com/upload/2021/10/05/16334390434907_p1c2-5.png)

La page web est générée à chaque fois qu'un client la réclame. C'est précisément ce qui rend les sites dynamiques "vivants" : le contenu d'une même page peut changer d'un instant à l'autre.

Pour générer la page web, votre serveur a donc besoin de pouvoir décoder le code PHP, il faut configurer le serveur ou votre environnement afin de pouvoir générer la page à partir de votre code PHP.



## Utiliser PHP en Local

Avant de commencer à coder en PHP, vous avez besoin d'un système qui puisse lire le PHP et le décoder pour générer une page.

Nous allons donc utiliser Docker pour construire un container capable de simuler un serveur web avec PHP.

### Builder le container Docker

Pour créer un container Docker et l'ouvrir sur un port en local, nous allons utiliser le fichier docker-compose.yml que vous trouverez dans le dossier PHP.

Ce fichier va permettre de construire une image PHP/Apache pour lancer un serveur web PHP en local sur le `port 8080`. Pour construire cette image, Docker va utiliser le dossier de configuration `PHP, c'est dans ce dossier que nous configurons PHP ainsi que le serveur Apache.

Pour construire l'image et créer un container vous devez rentrer la commande 

```bash
docker-compose up -d
```

Cette commande va builder l'image et construire le container, enfin elle va lancer le container qui est ouvert sur le port 8080, pour vérifier si votre container tourne vous pouvez ouvrir l'application Docker, ou vous rendre sur l'url http://localhost:8080/ dans votre navigateur, vous devriez voir une page avec écrit `Hello World!`.

En paralèlle du serveur Php/Apache, le container Docker lance une imager MySQL pour gérer une base de donnée et configure un PhpMyAdmin sur le port 8000 pour avoir accès à la base de donnée (l'id est `root` et il n'y as pas de mot de passe).

## Commencer le développement

Les fichiers de votre app (index.php, CSS, JS) doivent se trouver dans le dossier app.

Pour débuter le développement, vous pouvez ouvrir le fichier index.php, c'est ce fichier que nous allons utiliser pour apprendre le PHP.

En ouvrant le fichier Index.php vous retrouverez une structure HTML, c'est normal, votre page web n'est pas entièrement dynamique, vous allez vouloir avoir seulement certains contenus en dynamique.

C'est pourquoi la partie statique de votre page web sera écrite en HTML, et le contenu dynamique sera intégrer en php avec des balises spécifiques.

## Les balises PHP

Pour ouvrir une balise PHP dans votre page et ainsi écrire du code PHP, vous devez ouvrir la balise : 

- `<?php echo "Bonjour"; ?>` -> Ouverture de la balise avec __<?php__ et fermeture de la balise avec __?>__. Vous placez vos instructions PHP à l'intérieur de la balise. Vous pouvez également écrire les balises avec ces différentes écriture :
  - `<? ?>` 
  - `<?= ?>`

Voici un exemple d'intégration PHP dans du code HTML :

```php+HTML
<div class="container">
	<h1>Hello World!</h1>
  <?php echo "Bonjour"; ?>
  <!-- OU -->
  <?php echo("Bonjour"); ?>
  
  <!-- EXEMPLE CODE PHP DANS BALISE HTML -->
  <p> <?php echo "Ceci est un texte écrit en PHP"; ?> </p>
</div>
```

Ici, nous avons du code HTML qui affiche `Hello World` et du code PHP qui affiche `Bonjour`. Vous pouvez également intégrer des balises PHP dans des balises HTML. 

## Les bases

Nous allons maintenant voir les instructions de base de PHP.

Pour commencer, toutes les instructions PHP doivent se terminer par un __`;`__ pour définir la fin de la ligne d'instruction.

### La balise echo

L'instruction `echo` en Php permet d'afficher quelque chose : une chaine de caractère ou même une variable.

```php
echo 'Affiche une chaine de caratère';
echo $variable;
```

### Les variables

Pour définir une variable en PHP, vous devez utiliser le caractère `$` :

```php
$variable = "Ma variable";
echo $variable;
```

Vous pouvez également concaténer différentes variables à l'aide `.` : 

```php
$firstName = "Pierre";
$lastName = "Bertrand";

$fullName = $firstName . " " . $lastName;
```

Pour concaténer une chaine de caractère ou des variables, vous pouvez également le faire directement dans la chaîne de caractère, mais vous devez utiliser les `"` pour que cela fonctionne : 

```php
$name = "Pierre Bertrand";

echo "Bonjour $name, comment allez-vous ?";
```

Vous voyez ici que la variable dans la chaine de caractère est mise en avant, c'est parce que le code PHP sait qu'il doit remplacer le nom de la variable par sa valeur.

### Les commentaires

Pour faire un commentaire en PHP vous avez simplement à utiliser `//` pour un commentaire sur une ligne, sinon `/* */` pour un block de commentaire : 

```php
echo "Bonjour"; // Ceci est un commentaire
/* Ceci est un 
block de commentaire
*/
```

### Php Info

Une bonne pratique avant de débuter votre développement est de connaitre votre environnement ainsi que la configuration de php.

Pour ça, vous pouvez utiliser dans votre code la balise Php __`phpinfo();`__.

Faites un essai dans le fichier index.php :

```php+HTML
<main>
  <div class="container">
    <h1>Hello World!</h1>
    <?php phpinfo(); ?>
  </div>
</main>
```

En rechargeant la page vous devriez voir cette page qui vous affiche toute la configuration de votre serveur php.

![image-20211224165528630](/Users/pierre/Library/Application Support/typora-user-images/image-20211224165528630.png)



## Cas pratique Variable

Maintenant que vous avez les bases, vous allez vous entrainer à définir des variables et de les afficher sur la page.

Vous devez créer une variable nom, prénom, age et afficher les informations sur la page web avec concaténer les informations.



## Les calculs simples

Si vous avez besoin d'effectuer des calculs en PHP vous devez simplement utiliser les opérateurs de calcul :

- `+`
- `-`
- `/`
- `*`

Exemple :

```php
$numero = 10 + 10; // Prends la valeur 20

// Vous pouvez aussi calculer des variable entres elles

$calcul = $numero - 15;

// Calcul plus complexe avec parenthèses
$calcul = ($numero - 5) * 100
```



## Les structures conditionnelles

Dans certains cas, vous allez vouloir contrôler le comportement de votre application en fonction de certaines conditions, pour ça, vous devrez utiliser les conditions __`if... else`__.

Pour utiliser cette condition, vous devez connaitre les opérateurs de comparaisons :

| Symbole  |       Définition        |
| :------: | :---------------------: |
| __`==`__ |       Est égal à        |
| __`>`__  |     Est supérieur à     |
| __`<`__  |     Est inférieur à     |
| __`>=`__ | Est supérieur ou égal à |
| __`<=`__ | Est inférieur ou égal à |
| __`!=`__ |    Est différent de     |

Voici un exemple de condition simple si l'utilisateur est connecté :

```php
$isConnected = true;

if($isConnected == true) {
    echo "Vous êtes autorisé(e) à accéder au site ✅";
}
```

Maintenant si nous voulons gérer l'affichage si l'utilisateur n'est pas connecter, nous allons écrire le else (__sinon__) :

```php
$isConnected = false;

if ($isConnected == true) {
  echo "Vous êtes autorisé(e) à accéder au site ✅";
} 
else {
  echo "Accès refusé ❌ ";
}
```

Maintenant, si nous voulons gérer des conditions multiples, nous allons utiliser le __`elseif`__ qui veut dire _sinon si_ et qui permet de rajouter une autre condition :

```php
$autorisation = "oui";

if ($autorisation == "oui") {
  echo "Tu es autorisé";
} 
elseif ($autorisation == "non") {
  echo "Tu n'es pas autorisé";
} 
else {
  echo "Je ne sais pas";
}
```

Maintenant, nous avons un affichage si `$autorisation` est égal à "oui", si elle est égal à "non", et pour d'autres valeurs pour $autorisation.

### Utilisation des conditions booléenne

Dans l'exemple précédent, nous avons définit la condition à `if ($autorisation == "oui")...`, maintenant nous pouvons l'écrire de manière plus courte :

```php
if ($autorisation) {
  echo "Tu es autorisé";
}
```

Le fait d'écrire seulement le nom de la variable dans la condition veut simplement dire : __si $autorisation est définit__, donc si $autorisation == true.

On peut également faire la même chose pour lui définir la condition à false :

```php
if (! $autorisation) {
  echo "Tu es autorisé";
}
```

Ici, le `!` veut dire si $autorisation n'est pas définit, donc si $autorisation == "non".

### Utilisation des conditions multiples

Nous avons vu que nous pouvions utiliser la technique du __`elseif`__, mais nous avons une autre solution pour faire une condition multiples avec 2 mots clés dans notre if :

| Mot clé | Signification | Symbole |
| ------- | ------------- | ------- |
| AND     | Et            | &&      |
| OR      | Ou            | \|\|    |

Voici un

```php
$isAutorise = true;
$isProprietaire = true;

if($isAutorise && $isProprietaire) {
  echo "Accès autorisé";
}
```

Vous pouvez ajouter des conditions AND et des conditions OR :

```php
$isAutorise = true;
$isProprietaire = false;
$isAdmin = true

if (($isAutorise && $isProprietaire) || $isAdmin) {
  echo "Accès autorisé";
}
```

Ici, nous avons une condition qui vérifie si l'utilisateur est autorisé ET s'il est propriétaire, OU s'il est admin.

### Comprendre la syntaxe :

Pour les conditions if, nous venons de voir comment l'écrire dans une seule balise PHP, maintenant dans certains cas, vous aurez besoin d'avoir des instructions en HTML dans votre condition pour mettre en forme votre page.

Pour faire ça vous pouvez utiliser une autre syntaxe pour les conditions :

```php+HTML
<?php $isAutorise = true; ?>

<?php if ($isAutorise): ?> <!-- Ne pas oublier le ":" -->

<h1>Vous êtes autorisé</h1>

<?php else : ?>

<h1>Vous n'êtes pas autorisé</h1>

<?php endif; ?> <!-- Ni le ";" après le endif -->
```

Ici, nous avons une condition if qui est découpé en plusieurs balises PHP avec des instructions html à l'intérieur du if.

Pour comprendre cette nouvelle logique : 

- Faire le if -> `<?php if ($isAutorise): ?>` Attention de ne pas oublier le __`:`__ à la fin de la ligne.
- Faire ces instructions -> `<h1>Liste des recettes à base de poulet</h1>`
- Fermer le if -> `<?php endif; ?>` Attention de ne pas oublier le `;` à la fin de la ligne pour fermer l'instruction PHP.

### Utiliser le Switch

Dans certains cas, vous allez devoir gérer des conditions plus complexes avec plusieurs `elseif`, ce qui peut vous donner un code complexe avec beaucoup d'accolade ou de balise php à ouvrir et fermer.

Dans ce cas, nous allons pouvoir utiliser une autre syntaxe pour faire une condition qui est plus "légère" en terme de code : __`le switch`__.

Pour illustrer cette nouvelle syntaxe, prenons un exemple, des conditions en fonction d'une note reçu.

Avec un if classique nous aurions :

```php
$note = 16;

if ($note == 0) {
  echo "C'est nul";
} 
elseif ($note == 5) {
  echo "C'est mauvais";
}
elseif ($note == 7) {
  echo "Ce n'est pas bon";
}
elseif ($note == 10) {
  echo "C'est la moyenne";
}
elseif ($note == 12) {
  echo "C'est pas mal";
}
elseif ($note == 16) {
  echo "C'est bien";
}
elseif ($note == 20) {
  echo "Excellent travail, c'est parfait";
}
else {
  echo "La note n'est pas valide";
}
```

Comme vous le voyez, le code est long et répétitif, dans ce cas, nous pouvons utiliser le __switch__ pour alléger ce code et avoir un code propre et une condition fonctionnelle :

```php
switch ($note) // On indique ici qu'on travail sur la variable note
{
  case 0: // dans le cas où note est 0
    echo "C'est nul";
    break;
  case 5: // dans le cas où note est 5
    echo "C'est mauvais";
    break;
  case 7:
    echo "Ce n'est pas bon";
    break;
  case 10:
    echo "C'est la moyenne";
    break;
  case 12:
    echo "C'est pas mal";
    break;
  case 16:
    echo "C'est bien";
    break;
  case 20:
    echo "Excellent travail, c'est parfait";
    break;
  default:
    echo "La note n'est pas valide";
}
```

Avec le switch nous vérifions si la valeur de `$note` est égale aux différents `case` que nous avons écrit : `case 0:` par exemple.

__Attention, le case ne vérifie que des égalités !__ Cela ne marche pas avec les autres symboles :`< > <= >= !=`.

Le mot clé __`default`__ représente le else, c'est le message qui s'affiche par défaut, quelle que soit la valeur de la variable. 

Une dernière chose à évoquer sur le switch : contrairement au `if`, il va continuer de lire toutes les instructions, il faut donc intégrer à chaque case un break si nous voulons sortir du switch une fois que la condition est remplie.

#### Quand utiliser doit on utiliser if/switch ?

C'est surtout un problème de présentation et de clarté du code :

1. Pour une condition simple et courte, on utilise le  `if`.
2. Quand on a une série de conditions à analyser, on préfère utiliser `switch` pour rendre le code plus clair.

### Les ternaires ou conditions condensés

Il existe une autre forme de condition, elle est moins fréquente que celles que nous venons de voir mais sont à connaitre.

Prenons un exemple simple avec un `if...else ` et qui met un booléen `$majeur` à vrai ou faux selon l'âge de l'utilisateur :

```php
$userAge = 24;

if ($userAge >= 18) {
  $majeur = true;
}
else {
  $majeur = false;
}
```

Maintenant, en utilisant les __ternaires__, nous pouvons tout écrire sur une seule ligne :

```php
$userAge = 24;

$majeur = ($userAge >= 18) ? true : false;
```

Ici, tout notre test précédent a été fait sur une seule ligne !

La condition testée est `$userAge >= 18`.

Si c'est vrai, alors la valeur indiquée après le point d'interrogation (ici `true`) sera affectée à la variable  `$majeur` .

Sinon, c'est la valeur qui suit le symbole `:` (ici `false` ) qui sera affectée à  `$majeur`.



## Les listes et les boucles

Dans beaucoup de cas vous allez vouloir afficher beaucoup d'information sur votre page, par exemple, afficher la liste des utilisateurs.

Pour ça, vous allez devoir stocker toutes les informations sur chaque utilisateurs et ensuite les afficher, pour aller plus vite, vous allez utiliser un tableau qui va stocker toutes les informations et ensuite utiliser une boucle pour parcourir votre tableau afin d'afficher toutes les informations.

### Création des utilisateurs

Pour illustrer, nous allons prendre l'exemple des utilisateurs, dans un premier temps, vous allez devoir créer plusieurs utilisateurs, vous pouvez le faire comme ceci :

```php
// Premier utilisateur
$userName1 = 'Mickaël Andrieu';
$userEmail1 = 'mickael.andrieu@exemple.com';
$userPassword1 = 'S3cr3t';
$userAge1 = 34;

// Deuxième utilisatrice
$userName2 = 'Laurène Castor';
$userEmail2 = 'laurene.castor@exemple.com';
$userPassword2 = 'P4ssW0rD';
$userAge2 = 28;

// ... et ainsi de suite pour les autres utilisateurs.
```

Si vous faites ça, vous allez devoir créer une variable pour chaque information de vos utilisateurs et ça, pour chaque utilisateur. Ce qui fait que vous allez devoir créer une quantité trop grande de variable, vous allez perdre beaucoup de temps.

C'est pour ça que nous allons utiliser des tableaux :

```php
$user1 = ['Mickaël', "mickael.andrieu@exemple.com", 'S3cr3t', 34];

echo $user1[0]; // "Mickaël"
echo $user1[1]; // "mickael.andrieu@exemple.com"
echo $user1[2]; // "S3cr3t"
echo $user1[3]; // 34
```

Plusieurs choses sont à prendre en compte dans les tableaux :

- On définit un tableau avec les crochets __`[]`__
- Les informations dans le tableau possèdent des indices : 0, 1, 2... (Les indices commencent toujours pas 0)
- on peut accéder à un élément du tableau à partir de ces indices.

Mais vous pouvez également construire des tableaux de tableaux :

```php
$mickael = ['Mickaël', 'mickael.andrieu@exemple.com', 'S3cr3t', 34];
$mathieu = ['Mathieu', 'mathieu.nebra@exemple.com', 'devine', 33];
$laurene = ['Laurène', 'laurene.castor@exemple.com', 'P4ssw0rD', 28];

$users = [$mickael, $mathieu, $laurene];

echo $users[1][1]; // "mathieu.nebra@exemple.com"
```

Maintenant, vous savez créer des tableaux plus complexe. 

Nous allons maintenant voir comment afficher rapidement toutes les informations de notre tableau d'utilisateurs.

### Les boucles

Nous allons maintenant voir les __boucles__ en PHP pour parcourir le tableau plus rapidement.

Il existe deux grand type de boucle :

- La boucle __`for`__ qui répète des instructions autant de fois qu'on lui définit -> __`Pour chaque élément ... fais ça`__

```php
for ($line = 1; $line <= 3; $line++) {
  echo "<p>ligne numéro $line</p>";
}
```

Dans notre boucle, nous avons définit notre condition d'arrêt : __$line__, que nous avons définit à 1 (c'est notre index), ensuite nous avons définit que la boucle doit se répéter jusqu'à ce que $line soit égal ou supérieur à 3. Enfin, nous avons incrémenté $line avec __$line++__, ça veut dire qu'à chaque tour de boucle on ajoute 1 à line.

Ce qui donne que la boucle répète 2 fois.

- La boucle `While` qui répète des instructions jusqu'à qu'une condition soit rempli ou non -> __`Tant que ... fait ça`__

```php
$line = 1;

while ($line <=100) {
  echo "<p>ligne numéro $line</p>";
  $line++;
}
```

Ici nous avons définit $line au dessus de la boucle while, nous avons définit la condition et à la fin de notre boucle, nous ajoutons 1 à $line à chaque tour.

Dans les deux cas, il faut utiliser une condition pour que la boucle puisse s'arrêter à un moment donné.

#### La boucle Foreach

La boucle __Foreach__, est une boucle spécifique pour les tableaux en php, elle indique pour chaque élément.

Voici comment la mettre en place :

```php
$mickael = ['Mickaël', 'mickael.andrieu@exemple.com', 'S3cr3t', 34];
$mathieu = ['Mathieu', 'mathieu.nebra@exemple.com', 'devine', 33];
$laurene = ['Laurène', 'laurene.castor@exemple.com', 'P4ssw0rD', 28];

$users = [$mickael, $mathieu, $laurene];

foreach ($users as $user) {
  echo "<p>$user[0]</p>";
}
```

La boucle Foreach va parcourir tous les éléments du tableau, le __as $user__ veut dire que l'élément en question pour chaque boucle peut être appelé dans le foreach grâce à la variable user.

### Les tableaux associatif

Nous venons de voir les tableaux simple avec des éléments numérotés (indice), mais il est également possible en PHP de créer des tableaux associatif, c'est à dire d'associer une clé à une valeur pour retrouver des éléments dans le tableau.

Par exemple, si nous devons créer un tableau associatif pour un utilisateur, nous utiliser cette syntax :

```php
$user = [
  'Prénom' => 'Pierre',
  'Nom' => 'Bertrand',
  'age' => 24,
  'email' => 'test@test.com',
];
```

Pour créer une clé et associer une valeur vous avez simplement à écrire votre clé et ajouter à la suite __`=>`__, PHP va alors créer une clé et l'associer à la valeur que vous allez mettre à la suite de la flèche.

Mais vous pouvez également créer un tableau associatif comme ceci :

```php
$user2['prenom'] = "Pierre";
$user2['nom'] = "Bertrand";
```

Maintenant, pour afficher les informations du tableau associatif vous pouvez simplement appeler la variable contenant le tableau suivi de la clé avec les [] :

```php
echo $user2['prenom'];
```

### Parcourir le tableau associatif

Nous avons vu que pour les tableaux, il était plus simple d'utiliser la boucle __foreach__, pour les tableaux associatif, c'est encore plus vrai car nous allons pouvoir réutiliser les clé très facilement : 

```php
$user = [
  "prenom" => "Pierre",
  "nom" => "Bertrand",
  "age" => 24,
];
  
foreach ($user as $info => $infoValue) {
  echo $info . " : " . $infoValue;
}
```

Dans la définition du foreach, vous allez appeler le tableau (__`$user`__ ) et ensuite vous allez définir la variable pour récupérer la clé (__`$info`__) ainsi que stocker la valeur dans une autre variable pour la réutiliser (__`$infoValue`__).

Entre la définition de la variable clé et la variable valeur vous allez intégrer __`=>`__ pour que PHP puisse comprendre qu'il faut stocker la clé dans __$info__ et la valeur dans __$infoValue__. Enfin, dans la boucle foreach, vous pourrez appeler la clé ainsi que la valeur grâce à ces 2 variables.

### Le déboggage d'un tableau

Dans certains cas, vous allez vouloir afficher le tableau brut sur la page (SEULEMENT à des fins de déboggage), pour vérifier les informations du tableau, ou simplement pour vérifier que le tableau contient des éléments.

Pour ça vous devrez utiliser la fonction __`print_r()`__ qui va vous permettre d'afficher le tableau "brut" :

```php
$tableau = ["Pierre", "Paul", "Jacques"];
print_r($tableau);

// Renvoi -> Array ( [0] => Pierre [1] => Paul [2] => Jacques )
```

Si vous souhaitez mettre en forme le tableau vous pouvez utiliser __`print_r()`__ dans des balises __`<pre>`__ qui va automatiquement mettre en forme les données renvoyez :

```php
$tableau = ["Pierre", "Paul", "Jacques"];

echo '<pre>';
print_r($tableau);
echo '</pre>';

/* Renvoi
Array
(
    [0] => Pierre
    [1] => Paul
    [2] => Jacques
)
*/
```

Vous pouvez utiliser cette technique a des fins de déboggage, il est rare d'afficher sur une page web un Array mis en forme comme ça.

### Rechercher dans un tableau

En PHP, vous pouvez rechercher des informations dans un tableau avant de les afficher, rechercher par exemple si une clé existe dans le tableau ou non, et en fonction afficher tel ou tel chose sur votre page.

Nous avons 3 types de recherche dans un tableau en PHP :

1. `array_key_exists` pour vérifier si une **clé** existe dans le tableau.
2. `in_array` pour vérifier si une **valeur** existe dans le tableau.
3. `array_search` pour récupérer la clé d'une valeur dans le tableau.



#### 1. Recherche de clé dans un tableau

Voici notre problème : on a un array, mais on ne sait pas si la clé qu'on cherche s'y trouve.
Pour vérifier ça, on va utiliser la fonction `array_key_exists` qui va parcourir le tableau pour nous, et nous dire s'il contient cette clé.

On doit lui donner :

- Le nom de la clé à rechercher.

- Puis le nom du tableau dans lequel on fait la recherche :

```php+HTML
<?php array_key_exist('clé', $tableau); ?>
```

La fonction renvoi un booléen (true ou false), nous pouvons donc facilement créer une condition d'affichage suivant ce que nous renvoi la fonction :

```php
$user = [
  "prenom" => "Pierre",
  "nom" => "Bertrand",
  "age" => 24,
];

if(array_key_exists('prenom', $user)) {
  echo 'La clé "prenom" se trouve dans le tableau !';
};

if(array_key_exists('nom', $user)) {
  echo 'La clé "nom" se trouve dans le tableau !';
};
```



#### 2. Recherche une valeur dans un tableau

Le principe est le même que `array_key_exists` mais cette fois on recherche dans les **valeurs**. 

```php
$user = [
  "prenom" => "Pierre",
  "nom" => "Bertrand",
  "age" => 24,
];

if(in_array('Pierre', $user)) {
  echo '"Pierre" se trouve dans le tableau !';
};

if(in_array('Jean-Claude', $user)) {
  echo '"Jean-Claude" se trouve dans le tableau !';
};
```

Ici, on ne verra pas le deuxième message, car "Jean-Claude" n'est pas dans le tableau.



#### 3. Récupérez la clé d'une valeur dans un tableau

`array_search` fonctionne comme `in_array` : il travaille sur les valeurs d'un tableau.

Mais cette fois, elle ne va pas renvoyer un booléen, si la fonction trouve une valeur, elle va renvoyer la valeur, si elle ne trouve pas, elle renverra 'false'.

```php
$user = ["Pierre","Bertrand", 24];

$indexPierre = array_search('Pierre', $user); // Renverra 0 car Pierre a l'index 0 dans le tableau

$indexJacques = array_search('Jacques', $user); // Renverra false car Jacques n'est pas dans le tableau
```



## Afficher des informations avec des conditions

Maintenant que nous avons vu les tableaux, nous allons pouvoir mettre en forme un affichage propre et conditionnel des informations sur les utilisateurs.

Nous avons un tableau regroupant les utilisateurs :

```php
$users = [
    [
        "prenom" => "Pierre",
        "nom" => 'Bertrand',
        "age" => 24,
        "actif" => true,
    ],
    [
        "prenom" => "Paul",
        "nom" => 'Dupont',
        "age" => 33,
        "actif" => true,
    ],
    [
        "prenom" => "Jacques",
        "nom" => 'Dumont',
        "age" => 36,
        "actif" => true,
    ],
    [
        "prenom" => "Thérèse",
        "nom" => 'toto',
        "age" => 45,
        "actif" => false,
    ],
];
```

Nous avons un nouveau champ dans les tableaux d'utilisateurs __`actif`__ définit à true ou false, maintenant, nous allons vouloir afficher sur la page seulement les informations sur les utilisateurs actifs.

Pour ça nous allons :

- Contrôler la que la clé __`actif`__ existes
- Vérifier la valeur de la clé __`actif`__

Ce qui donne en PHP :

```php+HTML
<h1>Utilisateurs actif :</h1>
	
	<!-- Boucle sur les utilisateurs -->
  <?php foreach ($users as $user) : ?>
		<!-- Vérification de la clé actif -->
    <?php if (array_key_exists('actif', $user) && $user["actif"] == true) : ?>

      <article>
        <h2><?php echo $user["prenom"] . " " . $user["nom"]; ?></h2>
        <em><?php echo $user['age']; ?></em>
      </article>

    <?php endif; ?>
  <?php endforeach; ?>
```



## Les fonctions

Comme les boucles, les fonctions permettent d'éviter d'avoir à répéter du code PHP que l'on utilise souvent. Mais alors que les boucles sont de bêtes machines tout juste capables de répéter deux cents fois la même chose, les fonctions sont des robots « intelligents » qui s'adaptent en fonction de ce que vous voulez faire, et qui automatisent grandement la plupart des tâches courantes.

Prenons un exemple très simple, vous voulez créer une fonction qui va afficher Bonjour sur la page :

```php
function bonjour() {
  echo "Bonjour";
}

bonjour(); // renvoi Bonjour
```

Pour déclarer une nouvelle fonction, vous devez utiliser le mot clé __`function`__, ensuite lui donner un nom, les parenthèse servent à intégrer des paramètres par défaut (ce sont des valeurs que la fonction devra utiliser quand nous allons l'exécuter), dans notre cas, la fonction n'a pas besoin de paramètre par défaut.

Une fois notre fonction définit, nous avons simplement à l'appeler dans le code pour l'exécuter.

Noter qu'en PHP, l'appel des fonctions n'est pas sensible à la casse, ce qui veut dire que pour appeler la fonction vous pouvez l'écrire en majuscule ou minuscule, PHP va comprendre quelle fonction il doit exécuter :

```php
function bonjour() {
  echo "Bonjour";
}

bonjour(); // renvoi Bonjour
BONJOUR(); // renvoi également Bonjour
```

Maintenant, nous voulons afficher Bonjour et le nom de l'utilisateur, donc notre fonction doit avoir un paramètre par défaut que nous lui enverrons quand nous allons l'exécuter :

```php
$utilisateur = "Pierre";
function bonjour($name)
{
  echo "Bonjour $name";
}

bonjour($utilisateur); // renvoi Bonjour Pierre
```

Maintenant, on peut créer une fonction plus complexe avec un traitement sur les données que nous allons utiliser, par exemple, faire une addition :

```php
$nbr1 = 12;
$nbr2 = 20;

function calcul($val1, $val2) {
  echo $val1 . " + " . $val2 . " = " . ($val1 + $val2);
}

calcul($nbr1, $nbr2);
```

Vous pouvez passer plusieurs paramètres à votre fonction.

### Fonction complexe

Maintenant que nous avons vu comment créer une fonction simple, nous allons voir comment créer une fonction plus complexe, pour ça, nous allons reprendre notre exemple d'affichage utilisateur seulement s'ils sont actif ou non.

Mais cette fois, nous allons créer une fonction de vérification d'utilisateur actif pour gérer l'affichage.

Nous avons le tableau d'utilisateurs suivant :

```php
$users = [
    [
        "prenom" => "Pierre",
        "nom" => 'Bertrand',
        "age" => 24,
        "actif" => true,
    ],
    [
        "prenom" => "Paul",
        "nom" => 'Dupont',
        "age" => 33,
        "actif" => true,
    ],
    [
        "prenom" => "Jacques",
        "nom" => 'Dumont',
        "age" => 36,
        "actif" => true,
    ],
    [
        "prenom" => "Thérèse",
        "nom" => 'toto',
        "age" => 45,
      	"actif" => false,
    ],
];
```

Nous voulons maintenant créer une fonction qui va vérifier si la clé actif existe et si la clé actif est à true, cette fonction renverra un booléen true ou false pour savoir si l'utilisateur doit être affiché ou non.

```php
function showUser(array $utilisateur) : bool {
  
  if (array_key_exists('actif', $utilisateur) && $utilisateur["actif"]) {
        $isActif = true;
    } else {
        $isActif = false;
    }

    return $isActif;
}
```

Ici vous voyez que dans les paramètres para défaut, nous avons définit le mot clé __`array`__ avant de définir le nom du paramètre par défaut. C'est simplement car nous savons que le paramètre par défaut sera un tableau, donc nous préfixons le paramètre en imposant le type tableau lors de l'envoi du paramètre à la fonction. Ce n'est pas obligatoire, mais cela fait partie des bonnes pratiques de PHP.

Ensuite, après les parenthèses, nous avons écrit : __`: bool`__, c'est tout simplement parce que notre fonction va renvoyer un booléen, donc nous définissons le type de données de sortie de la fonction.

Si nous décortiquons la fonction, nous voyons que nous avons intégré une condition qui va vérifier si la clé actif est présente dans le tableau ET que la clé actif est à true, si c'est le cas, la fonction renverra true, sinon elle renverra false.

Maintenant que nous avons notre fonction de vérification, nous pouvons gérer l'affichage plus simplement en appelant seulement la fonction dans une condition :

```php+HTML
<?php
function showUser(array $utilisateur) : bool {
  
  if (array_key_exists('actif', $utilisateur) && $utilisateur["actif"]) {
        $isActif = true;
    } else {
        $isActif = false;
    }

    return $isActif;
}
?>
<?php foreach ($users as $user) : ?>
  <article>
    <?php if (showUser($user)) : ?>
      <p>
        <?php echo $user["prenom"]; ?>
      </p>
      <?php else : ?>
      <p>
        <?php echo "Utilisateur pas actif"; ?>
      </p>
    <?php endif; ?>
  </article>
<?php endforeach; ?>
```

Dans la boucle qui parcourt le tableau, nous avons intégré une condition qui va exécuter la fonction de vérification, si c'est true, nous affichons le prénom de l'utilisateur, sinon un message comme quoi l'utilisateur n'est pas actif.



### Les fonctions standard PHP

Il existe des fonctions standard et prête à l'emploi en PHP, vous avez simplement à appeler les bonnes fonctions pour avoir ce que vous voulez.

Voici une petite liste de fonctions utiles avec les liens vers la documentation PHP :

- `str_replace` pour [rechercher et remplacer](https://www.php.net/manual/fr/function.str-replace.php) des mots dans une variable ;
- `strlen` pour <a href="https://www.php.net/manual/fr/function.strlen.php">compter le nombre de caractères</a> dans un string ;
- `move_uploaded_file` pour [envoyer un fichier sur un serveur](https://www.php.net/manual/fr/function.move-uploaded-file) ;
- `imagecreate` pour [créer des images miniatures](https://www.php.net/manual/fr/function.imagecreate) (aussi appelées "thumbnails") ;
- `mail` pour [envoyer un mail](https://www.php.net/manual/fr/function.mail) avec PHP (très pratique pour faire une newsletter) ;
- de [nombreuses options](https://www.php.net/manual/fr/book.image) pour modifier des images, y écrire du texte, tracer des lignes, des rectangles, etc. ;
- `crypt` pour [crypter des mots de passe](https://www.php.net/manual/fr/function.crypt) ;
- `date` pour [renvoyer l'heure, la date](https://www.php.net/manual/fr/function.date), etc.

Vous pouvez explorer les fonctions déjà définit en PHP sur la <a href="https://www.php.net/manual/fr/">documentation PHP</a>.



## Les erreurs

Pendant votre développement, vous pourrez souvent être confronter à certaines erreurs. Mais dans certains cas, PHP vous renverra des erreurs pas forcément compréhensibles.

Pour mieux les comprendre, nous allons voir les erreurs "courantes" et ce qu'elles veulent dire.

Vous pourrez retrouver 3 types d'erreurs :

1. "Parse error".
2. "Undefined function".
3. "Wrong parameter count".

### "Parse error" = si vous formulez mal une instruction

Si on devait dire qu'il existe UNE erreur de base, ça serait très certainement celle-là. Impossible de programmer en PHP sans y avoir droit un jour.

Le message d'erreur que vous obtenez ressemble à celui-ci :

```
Parse error: syntax error in error.php on line 7
```

Ce message vous indique une erreur dans error `.php` à la ligne 7.

Une "parse error" est en fait une instruction PHP mal formée. Il peut y avoir plusieurs causes :

- **Oublier le point-virgule à la fin de l'instruction.**

  Comme toutes les instructions doivent se terminer par un point-virgule, si vous oubliez d'en mettre un, ça provoquera une parse error. Par exemple :

  ```php
  $id_news = 5
  ```

  … génèrera une parse error. Si vous mettez le point-virgule à la fin, tout rentrera dans l'ordre !

  ```php
  $id_news = 5;
  ```

  

- **Oublier de fermer un guillemet (une apostrophe ou une parenthèse).**

  Par exemple :

  ```php
  echo "Bonjour !;
  ```

  Il suffit de fermer correctement les guillemets et vous n'aurez plus de problème :

  ```php
  echo "Bonjour !";
  ```

  

- **Se tromper dans la concaténation et oublier un point.**

  ```php
  echo "J'ai " . $age " ans";
  ```



- **Mal fermer une accolade.**

  Cela peut être le cas pour une structure en `if` , par exemple.

  Vérifiez que vous avez correctement fermé toutes vos accolades.

  

### "Undefined function" = si vous utilisez une fonction non reconnue

Une autre erreur assez classique, c'est la fonction inconnue.

Vous obtenez ce message d'erreur :

```
Fatal Error: Call to undefined function: is_valid_recipe() in fichier.php on line 27
```

Là, il faut comprendre que vous avez utilisé une fonction qui n'existe pas.

Deux possibilités :

- Soit **la fonction n'existe vraiment pas**. Vous avez probablement fait une faute de frappe, vérifiez si une fonction à l'orthographe similaire existe.
- Soit la fonction existe vraiment, mais PHP ne la reconnaît pas. C'est parce que cette fonction se trouve dans **une extension de PHP que vous n'avez pas activée**. Par exemple, si vous essayez d'utiliser la fonction `imagepng` alors que vous n'avez pas activé la bibliothèque nécessaire pour les images en PHP, on vous dira que la fonction n'existe pas. Activez la bibliothèque qui utilise la fonction, et tout sera réglé.



### "Wrong parameter count" = si vous entrez un nombre incorrect de paramètres pour une fonction

Si vous utilisez mal une fonction, vous aurez cette erreur :

```
Warning: Wrong parameter count for fonction() in fichier.php on line 112
```

Cela signifie que :

- vous avez oublié des paramètres pour la fonction ;
- ou même que vous en avez trop mis.

Par exemple, la fonction `fopen` requiert au minimum deux paramètres :

- Le premier pour le nom du fichier à ouvrir.

- Et le second pour le mode d'ouverture (en lecture seule, écriture, etc.).

Si vous ne mettez que le nom du fichier à ouvrir, comme ceci :

```
$fichier = fopen("fichier.txt");
```

… vous aurez l'erreur « Wrong parameter count ». Pensez donc à rajouter le paramètre qui manque, par exemple comme ceci :

```
$fichier = fopen("fichier.txt", "r");
```



### "Maximum execution time exceeded" = si vous avez fait une boucle infinie

Ça, c'est le genre d'erreur qui arrive le plus souvent à cause d'une boucle infinie !

```
Fatal error: Maximum execution time exceeded in fichier.php on line 57
```

maginez que vous fassiez une boucle `while` mais que celle-ci ne s'arrête jamais : votre script PHP va tourner en boucle sans jamais s'arrêter.

Heureusement, PHP limite le temps d'exécution d'une page PHP à 30 secondes par défaut.

Si une page met plus de 30 secondes à se générer, PHP arrête tout en signalant que c'est trop long. Et il fait bien, parce que sinon cela pourrait ralentir tout le serveur et rendre votre site inaccessible !



## Organiser ces pages avec des blocs fonctionnels

Si vous avez un projet avec plusieurs pages, certains éléments de vos pages vont être identiques, prenons l'exemple du header et du footer, sur un site, ils sont quasiment identiques sur toutes les pages du site.

Donc plutôt que d'écrire sur chaque page le code de votre header et footer, vous allez pouvoir créer un bloc pour le header et un pour le footer que vous appellerez sur chacune de vos pages. Ça vous évitera de dupliquer du code inutilement et facilitera les modifications de ces 2 éléments sur toutes les pages de votre site.

Avant de rentrer dans le vif du sujet, il faut avant tout bien découper toutes ces pages pour savoir quels éléments vont être identiques sur plusieurs pages, ainsi vous pourrez savoir à l'avance quels éléments ont besoin d'être créer sous format blocks que nous appellerons sur les pages.

Pour l'exemple du header et footer nous pouvons découper les pages comme suit : 

![Ce schéma montre le découpage usuel d'une page web : la section du haut est dédiée à l'en-tête ; la section du milieu est consacrée au contenu, le corps d'une page ; et la section du bas correspond au pied de page.](https://user.oc-static.com/upload/2021/09/30/16330115240769_p2c7-1.png)

Imaginons une page d'accueil très simple en html :

```html
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours PHP</title>
</head>

<body>

    <header>
        <nav>
            <h3>Titre du menu</h3>
            <ul>
                <li><a href="#">Lien 1</a></li>
                <li><a href="#">Lien 1</a></li>
                <li><a href="#">Lien 1</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <article>
                <h1>Mon super site PHP !</h1>
                <p>
                    Bienvenue sur mon super site en PHP<br>
                    Il est écrit en PHP et doit appeler le header ainsi que le footer avec la fonction include de PHP.
                </p>
            </article>
        </section>
    </main>

    <footer>
        <p>Copyright moi-même, tous droit réservés.</p>
    </footer>
</body>

</html>
```

Ce code html doit être dans le fichier index.php, pour le moment, il n'y a pas de balise Php, c'est normal pour le moment, le serveur génère la page en HTML en exécutant le code php, s'il n'y a pas de balise PHP, la page sera quand même rendu en html.

Nous voyons sur ce code que nous avons créé un header et un footer, ces 2 éléments seront communs à chaque page, nous voulons donc créer un block fonctionnel pour éléments, et ensuite appeler ces blocks sur les différentes pages du site.

Pour créer un block fonctionnel, vous avez simplement à créer un nouveau fichier php que nous appellerons dans le fichier index.php par la suite.

Créons un fichier __header.php__ dans un dossier __templates__ (afin de bien ranger les fichiers) qui contiendra le code de notre header :

```php+HTML
#templates/header.php
<header>
  <nav>
    <h3>Titre du menu</h3>
    <ul>
      <li><a href="#">Lien 1</a></li>
      <li><a href="#">Lien 1</a></li>
      <li><a href="#">Lien 1</a></li>
    </ul>
  </nav>
</header>
```

Le fichier __header.php__ contient seulement le code html de notre header, c'est normal.

Maintenant, nous pouvons remplacer le code html du header dans le fichier __`index.php`__ par la fonction __include()__ qui va nous permettre d'inclure un autre fichier php à l'emplacement indiqué : 

````php+HTML
#index.php
<body>
  <?php include('templates/header.php'); ?>
  <!-- Code du corps de la page... -->
</body>
````

La fonction include prend en paramètre le chemin vers un fichier php, donc, il va chercher le fichier et à la génération de la page va remplacer la ligne ` <?php include('templates/header.php'); ?>` par le contenu du fichier header.php.

Pour le footer, il suffit simplement de créer un fichier footer.php et de l'appeler sur vos pages avec __`<?php include('templates/footer.php'); ?>`__ .



### Organiser vos variables ainsi que vos fonctions PHP

Nous avons vu comment afficher des blocs HTML dans nos pages pour les rendre dynamique et rapidement modifiables à l'ensemble des pages qui appellent les templates. 

Mais vous pouvez également stocker vos instructions PHP (variables, fonctions etc...) dans des fichiers, et les appeler dans vos pages via un include.

Ça permet de ne pas alourdir le code de vos pages avec des blocs d'instructions php.



## Utilisation des requêtes utilisateurs grâce aux URL

Maintenant, nous allons aborder le sujet des requêtes.

En php, vous pouvez créer une formulaire afin que l'utilisateur puisse vous envoyer des données pour par la suite les afficher sur une page par exemple.

Pour ça, nous allons utiliser le concept de __paramètre dans une URL__.

Toutes les URL ont cette structure de base :

```url
https://www.monsite.com
```

Maintenant, nous pouvons ajouter des paramètres à une URL avec le caractère __`?`__ à la fin de l'url, par exemple pour définir le nom de l'utilisateur dans l'url : 

```url
https://www.monsite.com?nom=pierre
```

C'est la même url, qui va bien rendre la page d'accueil, mais va envoyer au serveur le paramètre __nom__ qui aura comme valeur __pierre__. Les paramètres marchent par paires clé-valeurs, ce qui veut dire que la clé "nom" a pour valeur "pierre".

Pour récupérer ce paramètre et pouvoir l'afficher sur la page de manière dynamique, nous pouvons utiliser  une variable __superglobale__, c'est une variable qui est toujours disponible quelque soit le contexte.

Ici nous allons utiliser la variable superglobale __`$_GET`__, qui nous permet de récupérer des paramètres passés à l'URL, nous devons également lui donner la clé a trouver dans l'URL.

Donc dans notre exemple nous avons simplement à appeler le bon paramètre dans l'URL avec la variable $_GET : 

```php
// URL https://www.monsite.com?nom=pierre
echo $_GET['nom']; //Renvoi pierre
```

Vous pouvez passer plusieurs paramètres dans une URL en séparant les paramètres avec __`&`__ : 

```
https://www.monsite.com?nom=pierre&age=24
```

Ici, nous avons définit un premier paramètre nom, et ensuite un deuxième paramètre age.

Pour récupérer et afficher ces deux paramètre sur la page, nous pouvons écrire :

```php
// URL https://www.monsite.com?nom=pierre&age=24
echo $_GET['nom']; //Renvoi pierre
echo $_GET['age']; // Renvoi 24
```



## Création de formulaire pour effectuer des requêtes

Maintenant que nous savons comment passer un paramètre à une URL, nous pouvons laisser l'utilisateur créer ses propres paramètres en fonction des informations qu'il va rentrer sur le site.

Pour ça, nous allons devoir utiliser un form pour que l'utilisateur envoi les informations, pour ensuite aller sur une URL avec les paramètres qu'il a rentré.

Sur la page d'accueil (index.php), intégrez un formulaire pour que l'utilisateur rentre ses informations, à la soumissions du formulaire, vous allez rediriger vers une autre page qui va afficher les informations.

D'abord, créons le formulaire sur la page d'accueil :

```php+HTML
<form class="contact" action="contact.php" method="GET">
  <div>
    <label for="nom">Votre nom</label>
    <input type="text" name="nom" placeholder="Nom">
  </div>
  <div>
    <label for="age">Votre age</label>
    <input type="text" name="age" placeholder="Age">
  </div>
  <button type="submit">Envoyer</button>
</form>
```

Dans la définition du formulaire, nous avons intégré plusieurs informations :

- __`action="contact.php"`__ qui dit simplement en PHP qu'à la soumissions du formulaire, il sera converti en url avec les paramètres, cette url nous donnera -> `https://www.monsite.com/contact.php?nom=pierre&age=24` les données seront bien sur celles que l'utilisateur à rentré.
- __`method="GET"`__ c'est pour dire au formulaire que nous allons récupérer les informations que l'utilisateurs va rentrer dans les inputs.
- __`name="nom"`__ sur les inputs du formulaire pour définir les clés dans l'URL des paramètres.

Comme nous venons de le voir, la soumissions du formulaire va retourner vers la page contact.php et intégrer les paramètres dans l'url, ce qui veut dire que nous allons devoir créer un fichier contact.php pour que le lien que renverra le formulaire soit bon.

Nous allons créer un fichier contact.php et lui intégrer :

```php+HTML
<!-- code html de la page (head, header etc...) -->

<main>
  <section>
    <article>
      <h1>Bonjour <?php echo $_GET["nom"]; ?></h1>
      <p>Tu t'appelles <?php echo $_GET['nom'];?> et tu as <?php echo $_GET['age'];?> ans.</p>
    </article>
  </section>
</main>

```

Maintenant, notre page contact.php attend 2 paramètres dans l'URL, que nous affichons ensuite dans la page.

Maintenant, si vous allez sur la page d'accueil et que vous remplissez et validez le formulaire, il va vous rediriger vers la page contact.php et vous afficher les informations que vous avez rempli dans le formulaire.



## Gérer les erreurs utilisateurs 

Si vous utilisez la méthode de récupération via URL, il va falloir gérer les erreurs utilisateurs (si l'utilisateur change les paramètres dans l'URL ou même supprime des paramètres) de plus, dans notre exemple, si vous allez directement sur l'url : 

```
https://www.monsite.com/contact.php
```

Vous allez voir que vous avez des erreurs car dans cette url vous n'avez pas de paramètres.

Donc si vous récupérez des informations via des paramètres d'URL, vous devez absolument gérer les conditions !

Dans un premier temps, vous devez vérifier que les paramètres sont bien présents dans l'URL, et ensuite qu'ils ne sont pas vide.

Pour vérifier si une variable existe et est définit, vous devez utiliser la fonction __`isset()`__, ici nous voulons créer une condition qui va vérifier si la variable n'est pas définit donc nous utiliserons la syntax __`!isset()`__ :

```php
if (!isset($_GET["nom"])) {
  echo 'la variable "nom" n\'est pas définit';
} else {
  echo $_GET["nom"];
}
```

Donc maintenant, pour vérifier également que le paramètre message existe nous devons rajouter une condition dans le if avec __`||`__ :

```php
if (!isset($_GET["nom"]) || !isset($_GET['message'])) {
  echo 'la variable "nom" ou la variable "message" n\'est pas définit';
} else {
  echo $_GET["nom"];
}
```

Enfin, nous allons devoir ajouter la vérification de savoir si le paramètre n'est pas vide, pour ça nous allons utiliser la fonction __`empty()`__ :

```php
if(!isset($_GET["nom"]) || empty($_GET["nom"])) {
  echo "la variable 'nom' n'est pas définit ou elle est vide";
}
```

Maintenant nous allons créer 2 groupes de condition, un pour vérifier que le paramètre nom existe et qu'il n'est pas vide, et un autre pour vérifier que message existe et qu'il n'est pas vide. Pour faire ça nous allons regrouper les groupes de condition dans des parenthèses :

```php
if(
  (!isset($_GET["nom"]) && empty($_GET["nom"])) || (!isset($_GET["message"]) || empty($_GET["message"]))
) {
  echo 'Il y a une erreur';
}
```



## Limite d'utilisation de la méthode GET

L'utilisation de la méthode GET possède des limites, en effet dans une URL, vous ne devez pas dépasser 256 caractères, donc vous êtes limité sur le nombre d'informations ainsi que la taille des informations qui sont transmises.

C'est pourquoi vous pouvez également utiliser la méthode __POST__, cette méthode est similaire à celle du GET, mais cette fois, elle n'envoi pas de paramètres dans l'URL, vous pouvez récupérer les informations envoyé par l'utilisateur avec la variable superglobale __`$_POST`_.

Pour mettre en place une méthode post, vous devez changer la `method` dans la définition du formulaire html :

```html
<form class="contact" action="contact.php" method="POST">
  <div>
    <label for="nom">Votre nom</label>
    <input type="text" name="nom" placeholder="Nom">
  </div>
  <div>
    <label for="message">Votre message</label>
    <input type="text" name="message" placeholder="Message">
  </div>
  <button type="submit">Envoyer</button>
</form>
```

Maintenant, le formulaire va envoyer les données au serveur, mais cette fois, nous ne le verrons pas dans l'URL.

Pour récupérer les informations envoyées nous allons utiliser la variable $_POST : 

```php+HTML
<article>
  <?php if ((!isset($_POST['nom']) || empty($_POST['nom'])) || (!isset($_POST['message']) || empty($_POST['message']))) : ?>

  <h1>Erreur dans le formulaire</h1>

  <?php else : ?>

  <h1>Message bien reçu !</h1>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Rappel de vos informations</h5>
      <p class="card-text"><b>Nom</b> : <?php echo $_POST['nom']; ?></p>
      <p class="card-text"><b>Message</b> : <?php echo $_POST['message']; ?></p>
    </div>
  </div>

  <?php endif; ?>
</article>
```

La bonne pratique consiste donc à utiliser la méthode POST pour récupérer des informations, notamment pour éviter d'avoir une limite dans les données envoyées.



## Gérer les failles XSS

Envoyer des données que ce soit via la méthode GET ou POST peut être dangereux, en effet, ça laisse la porte ouverte à une faille de sécurité XSS (cross-site scripting).

En effet, si des utilisateurs malveillants écrivent un script dans le champ message du formulaire, ce script va être exécuter au chargement de la page de redirection.

Par exemple un utilisateur entre __`<script>alert('Alerte VIRUS')</script>`__ dans le champ message et qu'il envoi le formulaire, la page de redirection vous renverra une alerte avec le script "Alerte VIRUS", ce qui veut dire que le script a été exécuté.

Ça veut dire que n'importe quel utilisateur peut injecter un script malveillant qui va être exécuter sur votre serveur.

Il faut donc modifier l'affichage de la variable message pour ré-encoder la chaine de caractère en supprimant les balises HTML grâce à la fonction __`strip_tags`__ :

```php+HTML
<?php if ((!isset($_POST['nom']) || empty($_POST['nom'])) || (!isset($_POST['message']) || empty($_POST['message']))) : ?>

<h1>Erreur dans le formulaire</h1>

<?php else : ?>

<h1>Message bien reçu !</h1>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Rappel de vos informations</h5>
    <p class="card-text"><b>Nom</b> : <?php echo $_POST['nom']; ?></p>
    <p class="card-text"><b>Message</b> : <?php echo strip_tags($_POST['message']); ?></p>
  </div>
</div>

<?php endif; ?>
```

Cette fonction va supprimer les balises html de la chaîne de caractère, donc le script ne va plus être exécuté.

Soyez bien vigilant quand vous laissé la possibilité à l'utilisateur d'envoyer des données, donc bien penser à ré-encoder la chaine de caractère pour éviter les failles XSS.



## Autoriser l'envoi de fichier

Dans certains cas, vous allez vouloir laisser l'utilisateur envoyer des images sur votre serveur, par exemple l'utilisateur va envoyer une capture d'écran.

Jusqu'ici, nous avons vu les variables superglobales __`$_GET`__ et __`$_POST`__, maintenant, nous allons voir une autre variable superglobale : __`$_FILES`__ 

Cette nouvelle variable superglobale permet de faire transiter des fichiers.

Pour envoyer un fichier, ça se passe en 2 temps :

- Le visiteur arrive sur votre formulaire et le remplit (en indiquant le fichier à envoyer). Une simple page HTML suffit pour créer le formulaire.
- PHP réceptionne les données du formulaire et, s'il y a des fichiers dedans, il les « enregistre » dans un des dossiers du serveur.

> Attention : l'envoi du fichier peut être un peu long si celui-ci est gros. Il faudra dire au visiteur de ne pas s'impatienter pendant l'envoi.

Vous allez devoir adapter votre formulaire de contact pour autoriser l'envoi et la soumission.

### Préparer le formulaire

Dès l'instant où votre formulaire propose aux visiteurs d'envoyer un fichier, il faut ajouter l'attribut `enctype="multipart/form-data"` à la balise  `<form>` .

```php+HTML
<form action="contact.php" method="POST" enctype="multipart/form-data">
    <!-- champs de formulaire -->
</form>
```

Grâce à `enctype` , le navigateur du visiteur sait qu'il s'apprête à envoyer des fichiers.

Maintenant que c'est fait, nous pouvons ajouter à l'intérieur du formulaire une balise permettant d'envoyer un fichier.

C'est une balise très simple de type  `<input type="file" />` .

Il faut donner un nom à ce champ de formulaire (grâce à l'attribut `name` ) pour que PHP puisse reconnaître le champ par la suite.

```php+HTML
<form action="contact.php" method="POST" enctype="multipart/form-data">
  <div class="contact">
    <div>
      <label for="nom">Votre nom</label>
      <input type="text" name="nom" placeholder="Nom">
    </div>
    <div>
      <label for="message">Votre message</label>
      <input type="text" name="message" placeholder="Message">
    </div>
    <div>
      <label for="image">Votre image</label>
      <input type="file" name="image" placeholder="Insérer votre image">
    </div>
  </div>
  <button type="submit">Envoyer</button>
</form>
```

Maintenant, il va falloir gérer l'envoi du formulaire avec le fichier contact.php car pour le moment, à la soumission du formulaire, l'image est stocké dans un dossier temporaire sur le serveur, il faut donc traiter l'enregistrement sur le serveur dans un dossier précis.

Nous allons donc devoir d'abord vérifier si le fichier est bien un fichier et ensuite déplacer le fichier du dossier temporaire vers le dossier final grâce à la fonction __`move_uploaded_file`__.

### Vérifier le fichier

Pour chaque fichier envoyé, une variable `$_FILES['nom_du_champ']` est créée.

Dans notre cas, la variable s'appellera `$_FILES['image']` 

Cette variable est un tableau qui contient plusieurs informations sur le fichier :

| Variable                       | Signification                                                |
| ------------------------------ | ------------------------------------------------------------ |
| `$_FILES['image']['name']`     | Contient le nom du fichier envoyé par le visiteur.           |
| `$_FILES['image']['type']`     | Indique le type du fichier envoyé. Si c'est une image gif par exemple, le type sera `image/gif` |
| `$_FILES['image']['size']`     | Indique la taille du fichier envoyé. **Attention** : cette taille est en octets. Il faut environ 1 000 octets pour faire 1 Ko, et 1 000 000 d'octets pour faire 1 Mo. La taille de l'envoi est limitée par PHP. Par défaut, impossible d'uploader des fichiers de plus de 8 Mo. |
| `$_FILES['image']['tmp_name']` | Juste après l'envoi, le fichier est placé dans un répertoire temporaire sur le serveur en attendant que votre script PHP décide si oui ou non il accepte de le stocker pour de bon. Cette variable contient l'emplacement temporaire du fichier (c'est PHP qui gère ça). |
| `$_FILES['image']['error']`    | Contient un code d'erreur permettant de savoir si l'envoi s'est bien effectué ou s'il y a eu un problème et si oui, lequel. La variable vaut 0 s'il n'y a pas eu d'erreur. |

Nous allons donc faire les vérifications suivantes pour décider si l'on accepte le fichier ou non.

1. Vérifier tout d'abord si le visiteur a bien envoyé un fichier, en testant la variable `$_FILES['image']` avec `isset()` et s'il n'y a pas eu d'erreur d'envoi, grâce à `$_FILES['image']['error']` .
2. Vérifier si la taille du fichier ne dépasse pas 1 Mo par exemple (environ 1 000 000 d'octets), grâce à `$_FILES['image']['size']` .
3. Vérifier si l'extension du fichier est autorisée (il faut interdire à tout prix que les gens puissent envoyer des fichiers PHP, sinon ils pourraient exécuter des scripts sur votre serveur). Dans notre cas, nous autoriserons seulement les images (fichiers .png, .jpg, .jpeg et .gif).
   Nous analyserons pour cela la variable `$_FILES['image']['name']` .

Nous allons donc faire une série de tests dans notre page `contact.php` .

```php
if (isset($_FILES["image"]) && $_FILES["image"]['error'] == 0) {
 		// Le fichier existe et il n'y a pas d'erreurs
}
```

Ensuite, nous allons vouloir __vérifier la taille du fichier envoyé__ :

On veut interdire que le fichier dépasse 1 Mo, soit environ 1 000 000 d'octets (j'arrondis pour simplifier). On doit donc tester `$_FILES['screenshot']['size']` :

```php
if (isset($_FILES["image"]) && $_FILES["image"]['error'] == 0) {
  // Le fichier existe et il n'y a pas d'erreurs
  if($_FILES['image']['size'] <= 1000000) {
    // La taille du fichier est inférieur à 1 000 000 d'octets
  }
}
```

Maintenant, nous allons __vérifiez l'extension du fichier__ :

On peut récupérer l'extension du fichier dans une variable grâce à ce code :

```php
$fileInfo = pathinfo($_FILES['screenshot']['name']);
$extension = $fileInfo['extension'];
```

La fonction `pathinfo` renvoie un tableau (array) contenant entre autres l'extension du fichier dans  `$fileInfo['extension']` .

On stocke ça dans une variable  `$extension` .

Une fois l'extension récupérée, on peut la comparer à un tableau d'extensions autorisées, et vérifier si l'extension récupérée fait bien partie des extensions autorisées à l'aide de la fonction `in_array()` .

Donc le code final pour la vérification du fichier est :

```php
if (isset($_FILES["image"]) && $_FILES["image"]['error'] == 0) {
  
  if ($_FILES['image']['size'] <= 1000000) {
    
    $fileInfo = pathinfo($_FILES['image']['name']);
    $extension = $fileInfo['extension'];
    $extensionAllowed = ['jpg', 'jpeg', 'gif', 'png'];

    if (in_array($extension, $extensionAllowed)) {
      echo $_FILES['image']['name'];
    }
  }
}
```

Maintenant, nous savons que le fichier est bon, il faut donc maintenant déplacer l'image du dossier temporaire sur le serveur dans notre dossier définitif :

Nous allons utiliser la fonction __`move_uploaded_file`__.

Cette fonction prend deux paramètres :

1. Le nom temporaire du fichier (on l'a avec `$_FILES['image']['tmp_name']` ).
2. Le chemin qui est le nom sous lequel sera stocké le fichier de façon définitive. On peut utiliser le nom d'origine du fichier `$_FILES['image']['name']` ou générer un nom au hasard.

Nous allons placer le fichier dans un sous-dossier « Uploads ». On gardera le même nom de fichier que celui d'origine.

```php
if (isset($_FILES["image"]) && $_FILES["image"]['error'] == 0) {
  if ($_FILES['image']['size'] <= 1000000) {
    $fileInfo = pathinfo($_FILES['image']['name']);
    $extension = $fileInfo['extension'];
    $extensionAllowed = ['jpg', 'jpeg', 'gif', 'png'];

    if (in_array($extension, $extensionAllowed)) {
      move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $_FILES['image']['name']);
      echo "L'envoi a bien été effectué !";
    }
  }
}
```

Attention, avec ce code, il faut que le dossier uploads soit déjà créé sur le serveur.

Enfin, vous devrez également régler le problème d'espace dans le nom du fichier de l'utilisateur, en effet, s'il y a un espace dans le nom du fichier, l'envoi sur le serveur ne sera pas possible.

Il faut donc remplacer les espaces par un - dans le nom du fichier grâce à __`str_replace`__ :

```php
if (isset($_FILES["image"]) && $_FILES["image"]['error'] == 0) {
  if ($_FILES['image']['size'] <= 1000000) {
    $fileInfo = pathinfo($_FILES['image']['name']);
    $extension = $fileInfo['extension'];
    $extensionAllowed = ['jpg', 'jpeg', 'gif', 'png'];

    if (in_array($extension, $extensionAllowed)) {
      move_uploaded_file(str_replace(" ", "-", $_FILES['image']['tmp_name']), 'uploads/' . str_replace(" ", "-", $_FILES['image']['name']));
      echo "L'envoi a bien été effectué !";
    }
  }
}
```

Maintenant, votre script est fonctionnel, il vérifie que c'est bien un fichier, qu'il n'est pas trop lourd, et qu'il n'y a pas d'espace dans le nom du fichier.



## Créer un système de connexion

Maintenant, nous allons aborder la sécurisation de votre site, laisser l'utilisateur accéder au site seulement s'il est connecter et identifier.

Nous verrons par la suite comment traiter les utilisateurs avec une base de donnée.

Nous voulons dans un premier temps que les utilisateurs puissent se connecter, il faut donc créer un formulaire de contact simple qui permettra de renseigner son email et son mot de passe.

Avant de coder tout ça, il faut d'abord prendre du recul sur ce que nous voulons faire : 

On doit soumettre un e-mail et un mot de passe dans un formulaire de connexion.

Si le formulaire est valide, nous affichons un message de succès, et sinon un message d'erreur.

### Schématiser le scénario

Avant de vous lancer dans l'écriture du code, il faut penser à d'abord schématiser le comportement que vous voulez sur votre application.

Dans notre cas, l'utilisateur doit entrer le mot de passe, le plus simple est de créer un formulaire. Celui-ci sera directement intégré dans la page d'accueil du site telle que nous l'avons déjà développé.

rois situations peuvent survenir :

1. Vous n'êtes **pas connecté** : auquel cas, le formulaire de contact s'affiche, et le contenu de la page ne s'affiche pas.
2. Vous avez soumis le formulaire avec le **bon mot de passe** pour l'utilisateur : le message de succès s'affiche, le formulaire de connexion ne s'affiche pas et le contenu s'affiche.
3. Vous avez soumis le formulaire avec le **mauvais mot de passe** pour l'utilisateur : le message d'erreur s'affiche, le formulaire de connexion s'affiche et le contenu de la page ne s'affiche pas.

Nous allons donc créer une nouvelle page et adapter la page d'accueil :

- **login.php** : contient un simple formulaire comme vous savez les faire ;
- **index.php** : qui doit maintenant inclure une formulaire de connexion et une condition sur l'affichage des recettes

### Le formulaire de connexion

Dans un premier temps, vous allez créer un nouveau fichier login.php dans le dossier templates.

C'est dans ce fichier que nous allons développer le formulaire de connexion ainsi que gérer le comportement en fonction des situation :

D'abord, nous allons gérer la validation des informations (vérifier que l'utilisateur rentre les bonnes informations).

```php+HTML
<?php
// Validation du formulaire
if(isset($_POST["email"]) && isset($_POST['password'])) {
  foreach($users as $user) {
    if($user['email'] === $_POST['email'] && $user['password'] === $_POST['password']) {
      $loggedUser = [
        'email' => $user['email'],
      ];
    } else {
      $errorMessage = sprintf(
        "Les informations envoyées ne permettent pas de vous identifier : (%s/%s)",
        $_POST['email'],
        $_POST['password']
      );
    }
  }
}
?>
```

Ensuite, nous allons gérer l'affichage du formulaire seulement si l'utilisateur n'est pas connecté :

```php+HTML
<!-- VALIDATION DU FORMULAIRE ...-->

<?php if(!isset($loggedUser)) :?>
	<div class="form-login-area">
    <h1>Connectez-vous</h1>
    <p>Pour avoir accès au site</p>
    <form class="form-login" action="index.php" method="POST">
      <!-- Si erreur, on affiche le message d'erreur -->
      <?php if (isset($errorMessage)) : ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $errorMessage; ?>
      </div>
      <?php endif; ?>
      <div class="form-login-input">
        <div class="input-group">
          <label for="email">Email :</label>
          <input type="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
        </div>
        <div class="input-group">
          <label for="password">Mot de passe :</label>
          <input type="password" name="password" placeholder="Mot de passe">
        </div>
      </div>
      <button class="btn-form" type="submit">Envoyer</button>
    </form>
	</div>
<?php else : ?>
    <div class="alert alert-success" role="alert">
        Bonjour <span style="font-weight: 900"><?php echo $loggedUser['email']; ?></span> et bienvenue sur le site !
    </div>
<?php endif; ?>
```

Avec ce code, nous avons créé le formulaire de connexion qui va s'afficher seulement si l'utilisateur n'est pas connecté, ensuite nous avons également gérer le cas où l'utilisateur rentre des informations erronées, le formulaire s'affiche avec un message d'erreur.

### L'intégration sur la page et la gestion de l'affichage

Nous avons maintenant un formulaire de connexion fonctionnel, il faut maintenant l'intégrer sur notre index.php et gérer l'affichage : si l'utilisateur est connecté, on affiche la page, sinon, on affiche seulement le formulaire de connexion.

Vous allez donc appeler le bloc fonctionnel que vous venez de créer (login.php) sur le fichier index.php et ajouter un affichage conditionnel sur le contenu de la page :

```php+HTML
<!-- Head du fichier index.php -->

<?php include('templates/header.php'); ?>

  <section>
    <?php include('templates/login.php'); ?>
  </section>
```

Maintenant, votre formulaire va s'afficher sur la page d'accueil du site, mais affiche aussi le contenu, il nous reste à gérer l'affichage du contenu de la page seulement si l'utilisateur est connecté, nous allons simplement utiliser une condition if :

```php+HTML
<main>
  <section>
    <?php if (isset($loggedUser)) : ?>
    <article>
      <h1>Mon super site en PHP</h1>
      <p>
        Bienvenue sur mon super site en PHP<br>
        Il est écrit en PHP et doit appeler le header ainsi que le footer avec la fonction include de PHP.
      </p>
      <h2>Dis moi comment tu t'appelles ?</h2>
      <form action="contact.php" method="POST" enctype="multipart/form-data">
        <div class="contact">
          <div>
            <label for="nom">Votre nom</label>
            <input type="text" name="nom" placeholder="Nom">
          </div>
          <div>
            <label for="message">Votre message</label>
            <input type="text" name="message" placeholder="Message">
          </div>
          <div>
            <label for="image">Votre image</label>
            <input type="file" name="image" placeholder="Insérer votre image">
          </div>
        </div>
        <button class="btn-form" type="submit">Envoyer</button>
      </form>
    </article>
    <?php endif; ?>
  </section>
</main>
```

Nous avons créé la condition : si $loogedUser est définit, cette variable est générée par notre formulaire de connexion seulement si l'utilisateur rentre les bonnes informations, ce qui veut dire que maintenant, votre page est bien "sécurisé".

### Ajouter les utilisateurs valide

Le dernier problème que nous avons, c'est que pour le moment nous n'avons pas définit les utilisateurs autorisés à entrer sur le site, pour le moment, nous n'avons pas de base de donnée connecté, alors nous allons créer un tableau sur la page index.php qui contient les utilisateurs valide :

```php+HTML
<?php

$users = [
    [
        'email' => 'test@test.com',
        'password' => '1234',
    ],
];

?>
```

Nous utilisons la variables $users car c'est celle-ci que nous vérifions dans le fichier login.php (notre code va chercher dans ce tableau les utilisateurs valide).

## Sauvegarder les informations de sessions

Nous venons de créer un accès sécurisé à notre site, malheureusement pour le moment, dès qu'on recharge la page ou qu'on change de page, les informations de connexion sont "oubliées".

C'est parce que pour le moment nous ne sauvegardons pas ces informations, nous allons devoir utiliser les __informations de sessions__ pour les garder pendant toute la navigation de l'utilisateur.

Pour mieux comprendre les sessions, vous devez connaître ces __3 étapes__ :

#### Étape 1 : création d'une session unique

1. Un visiteur arrive sur votre site.
2. On demande à créer une session pour lui.
3. PHP génère alors un numéro unique.

Ce numéro est souvent très grand. Exemple : a02bbffc6198e6e0cc2715047bc3766f.

Ce numéro sert d'identifiant ; c'est ce qu'on appelle un « ID de session » ou  `PHPSESSID` .

PHP transmet automatiquement cet ID de page en page, en utilisant généralement un cookie.

#### Étape 2 : création de variables pour la session

Une fois la session générée, on peut créer une infinité de variables de session pour nos besoins.

Par exemple, on peut créer :

- une variable qui contient le nom du visiteur : `$_SESSION['nom']` 
- une autre qui contient son prénom : `$_SESSION['prenom']` 
- etc.

Le serveur conserve ces variables même lorsque la page PHP a fini d'être générée. Autrement dit : quelle que soit la page de votre site, vous pourrez récupérer le nom et le prénom du visiteur via la superglobale `$_SESSION` !

#### Étape 3 : suppression de la session

Lorsque le visiteur se déconnecte de votre site, la session est fermée et PHP « oublie » alors toutes les variables de session que vous avez créées.

Il est en fait difficile de savoir précisément quand un visiteur quitte votre site. En effet, lorsqu'il ferme son navigateur ou va sur un autre site, le vôtre n'en est pas informé.

Soit le visiteur clique sur un bouton « Déconnexion » (que vous aurez créé) avant de s'en aller, soit on attend quelques minutes d'inactivité pour le déconnecter automatiquement : on parle alors de "timeout". Le plus souvent, le visiteur est déconnecté par un timeout.

Pour activer ou détruire une session, deux fonctions sont à connaître :

1.  `session_start()` : démarre le système de sessions. Si le visiteur vient d'arriver sur le site, alors un numéro de session est généré pour lui. 
2.  `session_destroy()` : ferme la session du visiteur. Cette fonction est automatiquement appelée lorsque le visiteur ne charge plus de page de votre site pendant plusieurs minutes (c'est le timeout), mais vous pouvez aussi créer une page « Déconnexion » si le visiteur souhaite se déconnecter manuellement.

> Il faut appeler `session_start()` sur chacune de vos pages AVANT d'écrire le moindre code HTML ou PHP (avant même la balise  `<!DOCTYPE>` ). 
>
> Si vous oubliez de lancer `session_start()` , vous ne pourrez pas accéder à la variable [superglobale](https://www.php.net/manual/fr/reserved.variables.session.php)  `$_SESSION` .

### Mettre en place la session

Maintenant que nous avons vu comment mettre en place la session sur un site, nous allons le mettre en pratique avec notre site.

Dans un premier temps, nous allons débuter la session, pour ça, vous devez insérer la balise __`session_start()`__ au début de la page index.php

```php+HTML
<?php session_start(); // Créé la variable superglobale $_SESSION ?>
<!DOCTYPE html>
<!-- [....] -->
```

Maintenant, quand vous chargez la page d'accueil, vous débuter une nouvelle session, vous pouvez maintenant créer plusieurs informations que nous allons stocker dans la superglobale __$_SESSION__.

Ensuite, vous devez modifier votre formulaire de connexion pour enregistrer les informations de connexion avec la variable superglobale __$_SESSION__ 

```php
if (isset($_POST['email']) && isset($_POST['password'])) {
    foreach ($users as $user) {
        if ($user['email'] === $_POST['email'] && $user['password'] === $_POST['password']) {
            $_SESSION['LOGGED_USER'] = $user['email'];
        } else {
            $errorMessage = sprintf(
                "Les informations envoyées ne permettent pas de vous identifier : (%s/%s)",
                $_POST['email'],
                $_POST['password']
            );
        }
    }
}
```

Ici nous avons créé une informations dans $_SESSION['LOGGED_USER'], et nous avons stocké l'email de l'utilisateur (mais seulement si le formulaire est valide).

Ce qui veut dire qu'une fois que vous allez remplir le formulaire, s'il est valide, l'email de l'utilisateur va être stocké dans ses informations de session.

Nous devons maintenant modifier l'affichage dynamique du formulaire (jusqu'à présent, nous utilisions la variable $loggedUser, mais nous l'avons remplacé par $_SESSION['LOGGED_USER']).

```php+HTML
<?php if (!isset($_SESSION['LOGGED_USER'])) : ?>
  <div class="form-login-area">
    <h1>Connectez-vous</h1>
    <p>Pour avoir accès au site</p>
    <!-- [...] Fin du formulaaire -->
```

Et il faut modifier aussi :

```php+HTML
<?php else : ?>
    <div class="alert alert-success" role="alert">
        Bonjour <?php echo $_SESSION['LOGGED_USER']; ?> et bienvenue sur le site !
    </div>
<?php endif; ?>
```

La dernière chose à faire, c'est de modifier la condition de l'affichage du contenu de la page index.php (nous utilisions la variable $loggedUser pour afficher le contenu, nous devons la remplacer par $_SESSION['LOGGED_USER'])

```php+HTML
<main>
  <section>
    <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
    <article>
      <h1>Mon super site en PHP</h1>
      <!-- [...] Fin du contenu -->
```

### La déconnexion

Maintenant que votre session est active et que les informations de connexion utilisateur sont bien enregistré sur la session, nous allons vouloir gérer le cas de la déconnexion.

Comme nous l'avons vu plus haut, il y a 2 type de déconnexion : le timeout (après une période d'inactivité), ou la déconnexion manuelle avec __`session_destroy()`__.

Imaginons que l'utilisateur souhaite se déconnecter, il va donc falloir ajouter un bouton de déconnexion dans le header qui va quitter la session.

Modifiez le header pour ajouter un lien vers une nouvelle page __logout.php__ :

```php+HTML
<header>
  <nav class="navbar">
    <div class="container navbar-content">
      <h3>
        <a href='index.php'>Accueil</a>
      </h3>
      <ul class="navbar-list">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="logout.php">Déconnexion</a></li>
      </ul>
    </div>
  </nav>
</header>
```

Maintenant vous allez créer une page logout qui contiendra les informations de déconnexion :

```php+HTML
<?php

header("refresh:4;url=index.php"); // Redirige vers la page index.php après 4 secondes

session_start(); // ouvre la session de l'utilisateur si elle existe

if (isset($_SESSION['LOGGED_USER'])) {
    session_destroy(); // Ferme la session
}
?>

<div class="container">
    <h1>Vous avez bien été déconnecté</h1>
</div>
```

Et voilà, maintenant, quand vous allez cliquer sur le bouton déconnexion, vous allez avoir une page sui vous indique la déconnexion qui va être redirigé automatiquement après 4 secondes vers la page d'accueil en ayant fermé la session de l'utilisateur.

## L'utilisation de cookies pour sauvegarder des informations

Travailler avec des cookies revient à peu près à la même chose qu'avec des sessions, à quelques petites différences près que nous allons voir.

Voici ce que nous allons faire pour découvrir les cookies :

1. On va voir ce qu'est exactement un cookie.
2. Ensuite, nous verrons comment **écrire un cookie** : c'est facile à faire, si on respecte quelques règles.
3. Enfin, nous verrons comment **récupérer le contenu d'un cookie** : ce sera le plus simple.

### Comprenez le fonctionnement d'un cookie

Un cookie, c'est un petit fichier que l'on enregistre sur l'ordinateur du visiteur.

Ce fichier contient du texte et permet de « retenir » des informations sur le visiteur.

Par exemple, vous inscrivez dans un cookie le pseudo du visiteur. Comme ça, la prochaine fois qu'il viendra sur votre site, vous pourrez lire son pseudo en allant regarder ce que son cookie contient.

Parfois, les cookies ont une mauvaise image.

On fait souvent l'erreur de penser que les cookies sont « dangereux ».

Non, ce ne sont pas des virus, juste de petits fichiers texte qui permettent de retenir des informations.

Au pire, un site marchand peut retenir que vous aimez les appareils photos numériques et vous afficher uniquement des pubs pour des appareils photos, mais c'est tout ; ces petites bêtes sont inoffensives pour votre ordinateur.

Chaque cookie stocke généralement une information à la fois.

Si vous voulez stocker le pseudonyme du visiteur et sa date de naissance, il est donc recommandé de créer deux cookies.

Où sont stockés les cookies sur mon disque dur ?

Cela dépend de votre navigateur web. Généralement, on ne touche pas directement à ces fichiers, mais on peut afficher à l'intérieur du navigateur la liste des cookies qui sont stockés.

On peut choisir de les supprimer à tout moment sur tous les navigateurs.

Les cookies sont classés par site web. Chaque site web peut écrire, comme vous le voyez, plusieurs cookies. Les cookies sont donc des informations temporaires que l'on stocke sur l'ordinateur des visiteurs. La taille est limitée à quelques kilo-octets : vous ne pouvez pas stocker beaucoup d'informations à la fois, mais c'est en général suffisant.

### Écrivez un cookie

Par exemple, le cookie utilisateur aurait chez nous la valeur : `LOGGED_USER`.

Pour écrire un cookie, on utilise la fonction PHP [setcookie](https://www.php.net/manual/fr/function.setcookie.php) (qui signifie « Placer un cookie », en anglais).

On lui donne en général trois paramètres, dans l'ordre suivant :

1. Le **nom** du cookie (exemple : `LOGGED_USER` ).
2. La **valeur** du cookie (exemple :  `utilisateur@exemple.com` ).
3. La **date d'expiration** du cookie, sous forme de "timestamp" (exemple :  `1090521508` ).

Si vous voulez supprimer le cookie dans un an, il vous faudra donc écrire : `time() + 365*24*3600` 

#### Sécurisez un cookie avec les propriétés `httpOnly` et `secure`

Configurons les options `httpOnly` et `secure` sur le cookie.

Sans rentrer dans les détails, cela rendra votre cookie inaccessible en JavaScript sur tous les navigateurs qui supportent cette option (c'est le cas de tous les navigateurs récents). Cette option permet de réduire drastiquement les risques de faille XSS sur votre site, au cas où vous auriez oublié d'utiliser `htmlspecialchars` à un moment.

Voici comment créer un cookie de façon **sécurisée** :

```php
setcookie(
  'LOGGED_USER',
  'utilisateur@email.com',
  [
    'expires' => time() + 365 * 24 * 3600,
    'secure' => true,
    'httponly' => true,
  ]
);
```

n écrivant les cookies de cette façon, vous diminuez le risque qu'un jour l'un de vos visiteurs puisse se faire voler le contenu d'un cookie à cause d'une faille XSS.

Ne placez donc **JAMAIS** le moindre code HTML avant d'utiliser `setcookie` !

La plupart des gens qui ont des problèmes avec `setcookie` ont fait cette erreur.

### Affichez et récupérez un cookie

Avant de commencer à travailler sur une page, PHP lit les cookies du client pour récupérer toutes les informations qu'ils contiennent. Ces informations sont placées dans la [superglobale](https://www.php.net/manual/fr/reserved.variables.cookies) `$_COOKIE` sous forme d'un tableau (array), comme d'habitude.

De ce fait, si je veux ressortir l'e-mail du visiteur que j'avais inscrit dans un cookie, il suffit d'écrire :  `$_COOKIE['LOGGED_USER']` 

Ce qui nous donne un code PHP tout bête pour afficher de nouveau le pseudo du visiteur :

```php+HTML
Bonjour <?php echo $_COOKIE['LOGGED_USER']; ?> !
```

Comme vous le voyez encore une fois, le gros avantage, c'est que les superglobales sont accessibles partout.

À noter que si le cookie n'existe pas, la variable superglobale n'existe pas. Il faut donc faire un  `isset` pour vérifier si le cookie existe ou non.

Les cookies viennent du visiteur. Comme toute information qui vient du visiteur, **elle n'est pas sûre**. N'importe quel visiteur peut créer des cookies et envoyer ainsi de fausses informations à votre site.

### Modifiez un cookie existant

Vous vous demandez peut-être comment modifier un cookie déjà existant ? Il faut refaire appel à  `setcookie` en **gardant le même nom de cookie**, ce qui « écrasera » l'ancien.



## La base de donnée SQL

Nous venons de voir ensemble le fonctionnement du langage PHP, pour le moment nous avons écrit nos variables en php et elles sont gardées en mémoire seulement pendant la génération de la page.

C'est pourquoi PHP s'utilise énormément avec une __base de données__ qui va stocker toutes les informations de manière "définitive".

> La **base de données** (BDD) est un système qui enregistre des informations de manière ordonnées.

Nous allons utiliser le **S**ystème de **G**estion de **B**ase de **D**onnées (**SGBD**) avec MySQL, mais sachez que l'essentiel de ce que vous allez apprendre fonctionnera de la même manière avec un autre SGBD. Cette partie est construite afin que vous ayez le moins de choses possible à apprendre de nouveau si vous choisissez de changer de SGBD.

### Donnez les ordres au SGBD en langage SQL

Vous allez devoir communiquer avec le SGBD pour lui donner l'ordre de récupérer ou d'enregistrer des données. Pour lui "parler", on utilise le langage SQL.

La bonne nouvelle, c'est que le langage SQL est un standard, c'est-à-dire que quel que soit le SGBD que vous utilisez, vous vous servirez du langage SQL. La mauvaise, c'est qu'il y a en fait quelques petites variantes d'un SGBD à l'autre, mais cela concerne généralement les commandes les plus avancées.

Comme vous vous en doutez, il va falloir apprendre le langage SQL pour travailler avec les bases de données. Ce langage n'a rien à voir avec le PHP, mais nous allons impérativement en avoir besoin.

Voici un exemple de commande en langage SQL, pour vous donner une idée :

```sql
SELECT id, auteur, message, datemsg FROM datas ORDER BY datemsg DESC
```

Le principal objectif de cette partie du cours sera d'apprendre les instructions nécessaires à écrire en PHP pour effectuer des requêtes en base de données, et les bases du langage SQL.

### Comprenez comment PHP fait la jonction entre vous et MySQL

Pour compliquer un petit les choses, on ne va pas pouvoir parler à MySQL directement, seul PHP peut le faire.

C'est donc PHP qui va faire l'intermédiaire entre vous et MySQL. On devra demander à PHP : "Va dire à MySQL de faire ceci".

Voici le schéma de la jonction entre PHP et MySQL :

![](https://user.oc-static.com/upload/2021/10/05/16334392729092_p4c1-1.png)

Voici ce qui peut se passer lorsque le serveur a reçu une demande d'un client qui veut poster un message :

1. Le serveur utilise toujours PHP, il lui fait donc passer le message.
2. PHP effectue les actions demandées et se rend compte qu'il a besoin de MySQL. En effet, le code PHP contient à un endroit "Va demander à MySQL d'enregistrer ce message". Il fait donc passer le travail à MySQL.
3. MySQL fait le travail que PHP lui a soumis et lui répond "OK, c'est bon !".
4. PHP renvoie au serveur que MySQL a bien fait ce qui lui était demandé.

Maintenant que vous comprenez le fonctionnement, il va falloir découvrir comment est organisée une base de données. Bien en comprendre l'organisation est en effet absolument indispensable.

### Structurez votre base de données

Avec les bases de données, il faut utiliser un vocabulaire **précis**. Heureusement, vous ne devriez pas avoir trop de mal à vous en souvenir, vu qu'on va se servir d'une image : celle d'une armoire. Écoutez-moi attentivement et n'hésitez pas à lire lentement, plusieurs fois si c'est nécessaire.

Je vous demande d'imaginer ce qui suit.

- L'armoire est appelée "**la base**" dans le langage SQL. C'est le gros meuble dans lequel les secrétaires ont l'habitude de classer les informations.
- Dans une armoire, il y a plusieurs tiroirs. Un tiroir, en SQL, c'est ce qu'on appelle "**une table**". Chaque tiroir contient des données différentes. Par exemple, on peut imaginer un tiroir qui contient les pseudonymes et informations sur vos visiteurs, un autre qui contient les messages postés sur votre forum, etc.
- Mais que contient une table ? C'est là que sont enregistrées les données, sous la forme d'un tableau. Dans ce tableau, les colonnes sont appelées **des** "**champs**", et les lignes sont appelées **des** "**entrées**".

Une table est donc représentée sous la forme d'un tableau.

| **Number** | **Full name**   | **Email**                   | **Age** | **Password**   |
| ---------- | --------------- | --------------------------- | ------- | -------------- |
| 1          | Mathieu Nebra   | mathieu.nebra@exemple.com   | 34      | P4ssW0rd       |
| 2          | Laurène Castor  | laurene.castor@exemple.com  | 28      | jm_les_cookies |
| 3          | Mickaël Andrieu | mickael.andrieu@exemple.com | 34      | s3cr3t         |
| 4          | Vous            | vous@exemple.com            | 29      | 123456         |
| …          | …               | …                           | …       |                |

Pour finir, voici un schéma d'une base de donnée :

![](https://user.oc-static.com/upload/2021/10/07/16335991080356_p4c1-2.png)

### PhpMyAdmin

Pour comprendre un peu mieux les bases de données MySQL ainsi que leur structures, vous pouvez vous rendre sur l'URL http://localhost:8000/ sur votre navigateur.

Vous verrez apparaître un formulaire de connexion pour vous connecter à PhpMyAdmin, c'est un gestionnaire de base de données avec interface graphique, en d'autres termes, vous allez pouvoir modifier et retrouver toutes les informations sur votre base de données MySQL.

> Si vous n'avez pas la bonne page, assurez-vous que votre container Docker PHP soit bien activé.



### Les types de champs MySQL

Alors que PHP ne propose que quelques types de données que l'on connaît bien maintenant ( `int` , `string` , `bool` …), MySQL propose une quantité très importante de types de données.

Mais dans la pratique, vous n'aurez besoin de jongler qu'entre les quatre types de données suivants :

1. `INT` : nombre entier ;
2. `VARCHAR` : texte court (entre 1 et 255 caractères) ;
3. `TEXT` : long texte (on peut y stocker un roman sans problème) ;
4. `DATE` : date (jour, mois, année).

Cela couvrira 99 % de vos besoins, et avec l'expérience vous apprendrez à optimiser vos bases de données, et l'[intérêt des autres types de données](https://openclassrooms.com/fr/courses/1959476-administrez-vos-bases-de-donnees-avec-mysql/1960456-distinguez-les-differents-types-de-donnees) de MySQL.

### Créer sa base de données sur PhpMyAdmin

Maintenant, nous allons créer notre première base de données avec PhpMyAdmin.

Tout d'abord, vous devez être connecté à PhpMyAdmin, pour vous connecter rentrer dans le champs username : root et validez le formulaire.

Vous êtes maintenant connecté au PhpMyAdmin qui gère votre base de donnée MySQSL.

Sur le menu de gauche, cliquez sur "__Nouvelle base de données__"

![image-20220108122601042](/Users/pierre/Library/Application Support/typora-user-images/image-20220108122601042.png)

Entrez le nom de votre base de donnée et cliquez sur créer :

![image-20220108122716100](/Users/pierre/Library/Application Support/typora-user-images/image-20220108122716100.png)

Maintenant, vous devez voir un nouveau champ dans le menu de gauche du nom de la base de données que vous venez de créer :

![image-20220108122801117](/Users/pierre/Library/Application Support/typora-user-images/image-20220108122801117.png)

Votre base de données et maintenant prête, nous allons maintenant comment créer sa première table.

### Création d'une table dans une base de données

Si vous cliquez sur votre base de donnée dans le menu déroulant, vous devriez voir au centre une page de création de table (voir photo ci-dessus).

Vous devez maintenant lui donner un nom : __utilisateurs__ et cliquer sur exécuter.

Vous devriez tomber sur cette page :

![image-20220108123000274](/Users/pierre/Library/Application Support/typora-user-images/image-20220108123000274.png)

C'est ici que vous allez renseigner les champs de votre table.

#### Les clés primaires

Toute table doit posséder un champ qui joue le rôle de *clé primaire*. La clé primaire permet d'identifier de manière unique une entrée dans la table. En général, on utilise le champ `id` comme clé primaire, comme on vient de le faire.

Prenez le réflexe de créer à chaque fois ce champ « id » en lui donnant l'index `PRIMARY` , ce qui aura pour effet d'en faire une clé primaire.

Vous en profiterez en général pour cocher la case `AUTO_INCREMENT` (A.I) pour que ce champ gère lui-même les nouvelles valeurs automatiquement (1, 2, 3, 4…).

### Création des autres champs

Une fois le champs Id mis en place en tant que clé primaire et auto-incrémenté, il vous reste maintenant à définir les autres champs, là où vont être stocké les informations sur les utilisateurs.

__Pour le nom__ : 

- Nom -> "nom"
- Type -> "VARCHAR" : c'est une chaîne de caractère ne pouvant dépasser 255 caractères.
- Taille/Valeur -> 128 : Nous n'acceptons pas les noms de plus de 128 caractères.

__Pour l'email__ :

- Nom -> "email"
- Type -> "VARCHAR"
- Taille/Valeur -> 250

__Pour le Password__ :

- Nom -> "password"
- Type -> "VARCHAR"
- Taille/Valeur -> 250

Ce qui doit vous donner :

![image-20220108123543880](/Users/pierre/Library/Application Support/typora-user-images/image-20220108123543880.png)

Une fois les informations renseigner, cliquez sur Enregistrer pour créer les champs.

## Connecter votre base de données à votre site

Pour pouvoir travailler avec la base de données en PHP, il faut d'abord s'y connecter.

Il va donc falloir que PHP s'authentifie : on dit qu'il établit une connexion avec MySQL.

Une fois que la connexion sera établie, vous pourrez faire toutes les opérations que vous voudrez sur votre base de données !

Pour se connecter à une base de données MySQL, vous allez devoir utiliser une extension PHP appelée [PDO](https://www.php.net/manual/fr/book.pdo.php) ("PHP Data Objects"). Cette extension est fournie avec PHP (en français, "les fonctions PDO sont à votre disposition"), mais parfois il vous faudra activer l'extension.

Pour se connecter à votre base de donnée, PDO va avoir besoin de quelques informations : 

- **Le nom de l'hôte** : c'est l'adresse IP de l'ordinateur où MySQL est installé. Le plus souvent, MySQL est installé sur le même ordinateur que PHP : dans ce cas, mettez la valeur `localhost` . 
- **La base** : c'est le nom de la base de données à laquelle vous voulez vous connecter. Dans notre cas, la base s'appelle `data_site` . Vous l'avez créée avec phpMyAdmin dans le chapitre précédent.
- **L'identifiant et le mot de passe** : ils permettent de vous identifier. Renseignez-vous auprès de votre hébergeur pour les connaître.

Voici donc l'instruction PDO pour vous connecter à votre base `data_site`, tout d'abord, vous allez créer un nouveau fichier dans le dossier templates : __requete.php__, ce fichier permettra la connexion avec votre base de données :

```php
// Souvent on identifie cet objet par la variable $conn ou $db
$mysqlConnection = new PDO(
    'mysql:host=dataBase;dbname=data_site;charset=utf8',
    'root'
);
```

La ligne de code qu'on vient de voir crée une connexion à la base de données.

En fait, on crée la connexion en indiquant dans l'ordre dans les paramètres :

- le nom d'hôte : `dataBase` (c'est le nom de notre image Docker qui gère notre MySQL) ;
- la base de données : `data_site` ;
- l'identifiant (login) : `root` ;

Pour que la connexion soit effective sur vos pages, vous devez ajouter un include en haut de chaque page avec : 

```php+HTML
<?php include('templates/requetes.php'); ?>
```

Cela va permettre qu'au chargement de toutes les pages, nous établirons la connexion avec la base de données.

### Testez la présence d'erreurs

Si vous avez renseigné les bonnes informations (nom de l'hôte, de la base, login et mot de passe), rien ne devrait s'afficher à l'écran.

Toutefois, s'il y a une erreur (vous vous êtes trompé de mot de passe ou de nom de base de données, par exemple), PHP risque d'afficher toute la ligne qui pose l'erreur, ce qui inclut le mot de passe !

Vous ne voudrez pas que vos visiteurs puissent voir le mot de passe si une erreur survient lorsque votre site est en ligne. Il est préférable de **traiter** l'erreur.

En cas d'erreur, PDO renvoie ce qu'on appelle une **exception**, qui permet de « capturer » l'erreur.

Voici comment je vous propose de faire :

```php
try {
    $db = new PDO(
        'mysql:host=dataBase;dbname=data_site;charset=utf8',
        'root'
    );
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
```

Voilà encore un code un peu nouveau pour nous : sans trop rentrer dans le détail, il faut savoir que PHP essaie d'exécuter les instructions à l'intérieur du bloc `try` :

- S'il y a une erreur, il rentre dans le bloc `catch` et fait ce qu'on lui demande (ici, on arrête l'exécution de la page en affichant un message décrivant l'erreur).
- Si au contraire tout se passe bien, PHP poursuit l'exécution du code et ne lit pas ce qu'il y a dans le bloc `catch` . Votre page PHP ne devrait donc rien afficher pour le moment.

Donc avec ce code, si la connexion avec la base de données n'est pas bonne, vous allez recevoir le message d'erreur, sinon, la page s'affiche correctement.

## Faire votre première requête

 Maintenant que la connexion avec votre base de donnée est faite, nous allons pouvoir effectuer notre première requête pour extraire des informations de notre base de données.

Dans un premier temps, ajouter une entrée dans la table utilisateurs avec PhpMyAdmin et ajoutez un utilisateur.

L'objectif ici consiste à récupérer la liste des utilisateurs qui étaient au départ dans une variable sous forme de tableau associatif, et qui sont maintenant stockées dans votre base de données. 

Arrive alors le grand moment que vous attendiez tous : on va parler à MySQL. Pour cela, on va faire ce qu'on appelle une requête, en demandant à MySQL de nous dire ce que contient la table  `utilisateurs`. 

Comme je vous l'ai dit, le SQL est un langage. C'est lui qui nous permet de communiquer avec MySQL.

Voici la première requête SQL que nous allons utiliser :

```sql
SELECT * FROM utilisateurs
```

Cette requête SQL permet de récupérer toutes les informations dans la table utilisateurs.

Analysons chaque terme de cette requête.

- **SELECT** : en langage SQL, le premier mot indique quel type d'opération doit effectuer MySQL. Dans ce chapitre, nous ne verrons que `SELECT` . Ce mot-clé demande à MySQL d'afficher ce que contient une table.

- ***** : après le `SELECT` , on doit indiquer quels champs MySQL doit récupérer dans la table. Si on n'est intéressé que par les champs « nom » et « possesseur », il faudra taper :
  `SELECT nom, possesseur FROM recipes`

  Si vous voulez prendre tous les champs, tapez `*` . Cette petite étoile peut se traduire par « tout » : « Prendre tout ce qu'il y a… ».

- **FROM** : c'est un mot de liaison qui se traduit par « dans ». `FROM` fait la liaison entre le nom des champs et le nom de la table.

- **utilisateurs** : c'est le nom de la table dans laquelle il faut aller piocher.

Effectuons maintenant la requête à l'aide de l'objet PDO :

```php
$userStatement = $db->prepare('SELECT * FROM utilisateurs');
```

Le problème que nous avons ici, c'est que `$userRequete` n'est pas exploitable, il renvoi un objet PDOStatement qui ne peux pas être affiché tel quel. 

Cet objet va contenir la requête SQL que nous devons exécuter, et par la suite, les informations récupérées en base de données.

Pour récupérer les données, demandez à cet objet d'exécuter la requête SQL et de récupérer toutes les données dans un format "exploitable" pour vous, c'est-à-dire sous forme d'un tableau PHP.

```php
$userStatement->execute();
$users = $ruserStatement->fetchAll();
```

Avec la méthode fetch, nous stipulons en php d'aller chercher quelque chose, donc la méthode fetchAll() signifie de tout récupérer.

Grâce à cette méthode nous pouvons récupérer toutes les données sous forme de tableau associatif.

Voici l'exemple complet du code pour effectuer la requete :

```php
$sqlQuery = 'SELECT * FROM utilisateurs';
$usersStatement = $db->prepare($sqlQuery);
$usersStatement->execute();

$users = $usersStatement->fetchAll();
```

Notez que vous pouvez également stocker la requête SQL dans une variable et l'utiliser dans la fonction prepare() ce qui vous permet de pouvoir modifier par la suite plus facilement la requête en changeant seulement la variable qui stocke la requête SQL.

Maintenant, pour afficher la liste des utilisateurs, vous avez simplement à faire comme nous l'avions fait précédemment quand les users étaient stockés dans un tableau associatif PHP :

```php+HTML
<?php foreach ($users as $user_info) : ?>
	<p><?php echo $user_info["nom"]; ?></p>
<?php endforeach; ?>
```

Voilà, vous venez de créer une connexion à votre base de donnée en PHP, créer votre première requete PHP et afficher le résultat de la requête sur votre site.

## Filtrez vos requêtes

Une bonne pratique en PHP est de bien filtrer vos requêtes, en effet, pour le moment nous n'avons qu'une toute petite base de données avec très peu d'entrée, donc pas de problème de performance pour le moment.

Mais si vous avez une grosse base de donnée avec beaucoup de champs et d'entrée, si vous faites une requêtes pour récupérer toutes les informations, votre page va mettre beaucoup de temps à se charger.

Il est donc important de filtrer vos requêtes pour éviter d'avoir un temps de chargement trop long.

### Sélectionnez les champs dans une requête

Par exemple, si vous souhaitez récupérer seulement le nom des utilisateurs, vous n'allez pas faire récupérer toute la table utilisateur.

Nous avons vu lors de notre première requête qu'après le `SELECT` nous avions mis une __`*`__ pour sélectionner tous les champs.

Et bien cette fois, nous allons récupérer seulement le champ nom :

```sql
SELECT nom FROM utilisateurs
```

Donc dans votre fichier requetes.php vous allez modifier :

```php
$sqlQuery = 'SELECT nom FROM utilisateurs';
```

Si maintenant dans le fichier index.php vous écrivez :

```php+HTML
<?php foreach ($users as $user_info) : ?>
	<p><?php print_r($user_info); ?></p>
<?php endforeach; ?>
```

Vous aurez comme résultat : 

```
Array ( [nom] => Pierre Bertrand [0] => Pierre Bertrand )
```

Ce qui veut dire que votre requête ne récupère que le champ "nom" dans la table de votre base de données.

Vous pouvez aussi sélectionner plusieurs champs dans une requête en séparant le nom des champs avec une __`,`__ :

```php
$sqlQuery = 'SELECT nom, email FROM utilisateurs';
```

Cette requête ne récupérera que le champ nom et le champ email.

### Filtrez les informations

Maintenant, nous allons ajouter un champ dans la table utilisateurs qui sera __`actif`__ et qui sera un booléen.

Faite l'ajout du champ avec PhpMyAdmin vous mettrez en type __enum__ et dans le champ Taille/Valeur : __'true', 'false'__ (parce qu'en SQL et avec PhpMyAdmin, le booléen n'est pas reconnut en tant que tel).

Une fois que c'est fait, vous allez créer au moins 3 utilisateurs, 2 auront le champ actif à true, et le dernier à false.

Maintenant, nous allons faire une requête pour récupérer seulement les utilisateurs qui ont le champ actif à true. 

Vous allez voir qu'en modifiant vos requêtes SQL, il est possible de filtrer et trier très facilement vos données. Vous allez ici découvrir les mots-clés suivants du langage SQL :

- `WHERE` ;
- `ORDER BY` ;
- `LIMIT` .

Grâce au mot-clé `WHERE` , vous allez pouvoir trier vos données.

Puisque l'on souhaite récupérer uniquement les recettes avec le champ **actif** à  `TRUE` , alors la requête au début sera la même qu'avant, mais vous rajouterez à la fin `WHERE actif = TRUE` .

Cela vous donne la requête :

```php
$sqlQuery = 'SELECT * FROM utilisateurs WHERE actif = true';
```

> Pour utiliser les filtres vous devez le faire par ordre : Il faut utiliser les mots-clés dans l'ordre que j'ai donné : __`WHERE`__ puis __`ORDER BY`__ puis __`LIMIT`__ , sinon MySQL ne comprendra pas votre requête.



### Construire des requêtes dynamique

Nous avons vu jusqu'ici comment effectuer des requêtes simple qui effectuaient toujours la même opération.

Mais vous pouvez allez plus loins : utiliser des variables dans vos requêtes pour les rendre plus dynamique.

Par exemple, vous voulez récupérer les informations de l'utilisateur connecté, vous ne savez pas à l'avance quel utilisateur est connecté, mais vous savez dans quelle table chercher.

Vous allez donc préparer une requête qui va chercher dans la table utilisateur, où le nom = le nom de l'utilisateur ET que actif = true.

#### Identifiez vos variables à l'aide des marqueurs

Les marqueurs sont des identifiants reconnus par PDO pour être remplacés lors de la **préparation** de la requête par les variables PHP :

```php
$sqlQuery = 'SELECT * FROM utilisateurs WHERE nom = :name AND actif = :is_enabled';
$usersStatement = $db->prepare($sqlQuery);
$usersStatement->execute([
    'name' => 'Pierre Bertrand',
    'is_enabled' => 'true'
]);
```

Vous voyez que dans $sqlQuery, je place des marqueurs __`:name`__ ainsi que __`is_enabled`__, ensuite dans la fonction __execute()__ j'intègre un tableau de paramètre qui vont être mes variables.

Pour le moment, nous avons écrit dans un string les informations à intégrer dans la requête SQL, mais vous pouvez très bien remplacer le string par une variable.

On ne concatène **JAMAIS** une requête SQL pour passer des variables, au risque de créer des injections SQL ! 

C'est pour ça que nous utilisons des marqueurs dans la requête SQL que nous remplacer au même d'exécution de la requête.

Par exemple, si vous êtes connecté au site, cela veut dire que vous avez la variable superglobale __`$_SESSION['LOGGED_USER']`__ qui stock le nom de l'utilisateur, vous pouvez donc l'utiliser pour faire la requete :

```php
$sqlQuery = 'SELECT * FROM utilisateurs WHERE nom = :name AND actif = :is_enabled';
$usersStatement = $db->prepare($sqlQuery);
$usersStatement->execute([
  'name' => $_SESSION["LOGGED_USER"],
  'is_enabled' => 'true'
]);

$userFilter = $usersStatement->fetchAll();
```



## Traquez les erreurs

Lorsqu'une requête SQL « plante », bien souvent PHP vous dira qu'il y a eu une erreur à la ligne du `fetchAll` :

```
Fatal error: Call to a member function fetchAll() on a non-object in index.php on line 13
```

Ce n'est pas la ligne du `fetchAll` qui est en cause : c'est souvent vous qui avez mal écrit votre requête SQL quelques lignes plus haut. Pour afficher des détails sur l'erreur, il faut activer les erreurs lors de la connexion à la base de données via PDO.

Il faut adapter la création de l'objet `$db` pour activer la gestion des erreurs :

```php
$db = new PDO(
  'mysql:host=dataBase;dbname=data_site;charset=utf8',
  'root',
  '',
  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
);
```

Désormais, toutes vos requêtes SQL qui comportent des erreurs les afficheront avec un message beaucoup plus clair.

Supposons par exemple que j'écrive mal le nom du champ :

```sql
SELECT titlee FROM utilisateurs
```

L'erreur suivante s'affichera alors :

```
Unknown column 'titlee' in 'field list'
```



## Modifier la base de donnée en PHP

Pour cela, nous allons aborder de nouvelles requêtes SQL fondamentales et les appliquer avec PHP : `INSERT` , `UPDATE` et `DELETE` .

Nous allons permettre d'ajouter des utilisateurs directement sur votre site, c'est à dire que vous allez pouvoir rentrer les informations d'un nouvel utilisateur sur votre site via un formulaire, et quand vous le soumettrez, vous allez ajouter une entrée dans votre base de données.

Pour cela, vous aurez besoin de trois choses :

1. Ajouter un formulaire PHP de création d'utilisateurs.

2. Vérifier les données soumises en PHP.

3. À l'aide de PDO, exécuter l'insertion de la nouvelle recette en base de données.

   

### Ajouter des données avec INSERT INTO

Pour ajouter une entrée, vous aurez besoin de connaître la requête SQL. En voici une par exemple qui ajoute un utilisateur :

```php
$sqlQueryAddUser = 'INSERT INTO utilisateurs(nom, email, password, actif) VALUE (:nom, :email, :password, :actif)';
```

tudions un peu cette requête.

- D'abord, vous devez commencer par les mots-clés `INSERT INTO` qui indiquent que vous voulez insérer une entrée.
- Vous précisez ensuite le nom de la table (ici `utilisateurs` ), puis listez entre parenthèses les noms des champs dans lesquels vous souhaitez placer des informations.
- Enfin – et c'est là qu'il ne faut pas se tromper – vous inscrivez `VALUES` suivi des valeurs à insérer **dans le même ordre que les champs que vous avez indiqués**.

Utilisez cette requête SQL au sein d'un script PHP pour ajouter un utilisateur :

```php
$sqlQueryAddUser = 'INSERT INTO utilisateurs(nom, email, password, actif) VALUE (:nom, :email, :password, :actif)';

$insertUser = $db->prepare($sqlQueryAddUser);

$insertUser->execute([
  'nom' => "Pierre",
  'email' => "pierre@gmail.com",
  'password' => 'test',
  'actif' => 'true',
]);
```

Vous remarquerez que nous n'ajoutons pas de données dans le champ id, c'est parce qu'il est AUTO INCRÉMENTÉ, et que ce champ est rempli automatiquement par MySQL, nous n'avons donc pas besoin de remplir ce champ.

Pour le moment, notre script va envoyer les informations que nous avons écrit dans la fonction execute, mais nous voulons que ces données soient renseignées dans un formulaire sur le site et que nous utilisions les données du formulaire pour créer un nouvel utilisateur.

Pour ça, nous allons commencer par créer un formulaire qui va récupérer les informations sur la page admin. Vous devez donc créer un fichier add-user.php et mettre dans la page le code du formulaire :

```html
<form class="form-user" action="post_create.php" method="POST">
  <div class="form-login-input">
    <div class="input-group">
      <label for="email">Nom :</label>
      <input type="text" name="nom" placeholder="Votre nom">
    </div>
    <div class="input-group">
      <label for="email">Email :</label>
      <input type="text" name="email" placeholder="you@exemple.com">
    </div>
    <div class="input-group">
      <label for="password">Mot de passe :</label>
      <input type="password" name="password" placeholder="Mot de passe">
    </div>
    <div class="input-group">
      <label for="actif">Actif :</label>
      <input type="text" name="actif">
    </div>
  </div>
  <button class="btn-form" type="submit">Envoyer</button>
</form>
```

Comme vous le voyez, nous utilisons la méthode POST pour l'envoie des informations.

Maintenant, nous allons pouvoir envoyer les informations en base de données de manière dynamique grâce aux variables que va créer notre formulaire lors de la soumissions :

```php
if (!empty($_POST['create_nom']) && !empty($_POST['create_email']) && !empty($_POST['create_password']) && !empty($_POST['create_actif'])) {
    $sqlQueryAddUser = 'INSERT INTO utilisateurs(nom, email, password, actif) VALUE (:nom, :email, :password, :actif)';

    $insertUser = $db->prepare($sqlQueryAddUser);

    $insertUser->execute([
        'nom' => $_POST['create_nom'],
        'email' => $_POST['create_email'],
        'password' => $_POST['create_password'],
        'actif' => $_POST['create_actif'],
    ]);
} else {
  $errorMessageCreate = true;
}
```

Nous commençons par vérifier si les informations sont présentes (si le formulaire est rempli), ensuite nous indiquons la création de l'utilisateur en indiquant les variables à utiliser dans la fonction execute.

Enfin nous indiquons un message d'erreur à true dans le cas où le formulaire n'est pas valide (nous utiliserons cette variable pour l'affichage du message de réponse).

Maintenant, quand vous allez remplir le formulaire avec les bonnes informations, les données vont être enregistrées en base de données et vous allez être redirigé vers la page post_create.php qui va nous afficher le message de validation d'envoi de données : 

```php+HTML
<!-- post_create.php [... haut de page] -->

<?php if (isset($errorMessageCreate)) : ?>
  <section>
    <div class="card">
      <div class="card-body">
        <div class="alert alert-danger" role="alert">
          <h5 class="card-title">Erreur dans le formulaire</h5>
        </div>
      </div>
    </div>
  </section>

  <?php else : ?>
  <section>
    <h1>Utilisateur ajouté</h1>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Rappel des informations</h5>
        <p class="card-text"><b>Nom</b> : <?php echo $_POST['create_nom']; ?></p>
        <p class="card-text"><b>Message</b> : <?php echo strip_tags($_POST['create_email']); ?></p>
        <p class="card-text"><b>Message</b> : <?php echo strip_tags($_POST['create_actif']); ?></p>
      </div>
    </div>
  </section>
<?php endif; ?>
```

Vous avez maintenant un formulaire pour ajouter des utilisateurs fonctionnel et qui envoie des informations en base de données.

### Editer des données avec UPDATE

Vous souhaitez maintenant pouvoir modifier les utilisateurs.

Pour cela, vous aurez besoin de deux nouveaux mots-clés :  `UPDATE` et  `SET` .

En imaginant qu'on fournit un formulaire d'édition et que l'on autorise les utilisateurs à éditer les champs `nom`, `email`,  `password`, `actif`, voici la requête SQL correspondante :

```sql
UPDATE utilisateurs SET nom= :nom, email= :email, password= :password, actif= :actif WHERE id= :id
```

- Tout d'abord, le mot-clé `UPDATE` permet de dire qu'on va modifier une entrée.
- Ensuite, le nom de la table ( `utilisateurs` ).
- Le mot-clé `SET` sépare le nom de la table de la liste des champs à modifier.
- Viennent ensuite les champs qu'il faut modifier, séparés par des virgules. Ici, on modifie le champ `nom` , puis on fait de même pour le champ `email` ainsi que les autres. 
- Enfin, le mot-clé `WHERE` est tout simplement indispensable. Il nous permet de dire à MySQL quelle entrée il doit modifier (sinon, toutes les entrées seraient affectées !). On se base très souvent sur le champ `id` pour indiquer **quelle entrée** doit être modifiée.

#### Création du formulaire d'update

Pour modifier une entrée dans la table utilisateurs, nous ne pouvons pas réutiliser le formulaire que nous avons déjà créé pour l'ajout d'un utilisateurs, car nous avons besoin dans un premier temps de récupérer les informations sur cet utilisateur dans notre formulaire, de faire ensuite les modifications, et enfin, envoyer les modification à la bonne entrée.

Pour ça, nous allons récupérer l'id de l'utilisateur que nous enverrons en paramètre d'URL à notre nouveau formulaire d'édition d'utilisateur.

Ensuite, pour ce nouveau formulaire nous allons ajouter un input caché qui va stocker l'id et l'envoyer par la suite à la soumissions du formulaire.

Vous devez donc créer un nouveau fichier __update.php__ avec ce formulaire : 

```php+HTML
<form class="form-user" action="post_update.php" method="POST">
  <div class="form-login-input">
    <!-- AJOUT DU CHAMP CACHÉ POUR RÉCUPÉRATION DE L'ID -->
    <div class="hidden">
      <label for="id">Identifiant de l'utilisateurs</label>
      <input type="hidden" name="id" value="<?php echo $userUpdate['id']; ?>">
    </div>
    <div class="input-group">
      <label for="create_nom">Nom :</label>
      <input type="text" name="create_nom" placeholder="Votre nom" value="<?php echo strip_tags($userUpdate['nom']); ?>">
    </div>
    <div class="input-group">
      <label for="create_email">Email :</label>
      <input type="text" name="create_email" placeholder="you@exemple.com" value="<?php echo strip_tags($userUpdate['email']); ?>">
    </div>
    <div class="input-group">
      <label for="create_password">Mot de passe :</label>
      <input type="password" name="create_password" placeholder="Mot de passe" value="<?php echo strip_tags($userUpdate['password']); ?>">
    </div>
    <div class="input-group">
      <label for="create_actif">Actif :</label>
      <input type="text" name="create_actif" value="<?php echo strip_tags($userUpdate['actif']); ?>">
    </div>
  </div>
  <button class="btn-form" type="submit">Envoyer</button>
</form>
```

Avant toute chose, nous devons vérifier au chargement de cette page si l'id en paramètre de l'URL est un id valide et qu'il existe bien dans notre base de données, vous devez donc écrire le code php suivant en haut de votre fichier update.php :

```php
foreach ($users as $user => $userInfo) {
    if (in_array($_GET['id'], $users[$user])) {
        $searchId = true;
    }
}

if (!isset($searchId)) {
    $errorMessageId = "Il faut un id valide";
} else {
    $sqlQueryGetUser = 'SELECT * FROM utilisateurs WHERE id =:id';
    $getUserStatement = $db->prepare($sqlQueryGetUser);

    $getUserStatement->execute([
        'id' => $_GET['id'],
    ]);

    $userUpdate = $getUserStatement->fetch(PDO::FETCH_ASSOC);
}
```

Ici nous créons d'abord une boucle qui foreach qui va chercher pour chaque utilisateur l'id, si l'id passé en paramètre de l'url est dans le tableau $users, alors on définit la variable $searchId à true.

Ensuite on vérifie que la variable $searchId existe (sinon cela veut dire que l'id passé en paramètre n'existe pas dans la base de données), si elle existe, on effectue la requête SQL pour récupérer les éléments de l'utilisateur.

Ensuite, il nous reste seulement dans la page à gérer la condition d'affichage : si $errorMessageId est définit c'est qu'il y a une erreur, alors on n'affiche pas le formulaire, sinon on affiche le formulaire avec les variables de notre requête :

```php+HTML
<?php if (isset($errorMessageId)) : ?>
  <div class="alert alert-danger" role="alert">
    <?php echo $errorMessageId; ?>
  </div>
  <?php else : ?>
  <h1>Page de modification utilisateur <?php echo $userUpdate['nom']; ?></h1>
  <form class="form-user" action="post_update.php" method="POST">
    <div class="form-login-input">
      <div class="hidden">
        <label for="id">Identifiant de l'utilisateurs</label>
        <input type="hidden" name="id" value="<?php echo $userUpdate['id']; ?>">
      </div>
      <div class="input-group">
        <label for="create_nom">Nom :</label>
        <input type="text" name="create_nom" placeholder="Votre nom" value="<?php echo strip_tags($userUpdate['nom']); ?>">
      </div>
      <div class="input-group">
        <label for="create_email">Email :</label>
        <input type="text" name="create_email" placeholder="you@exemple.com" value="<?php echo strip_tags($userUpdate['email']); ?>">
      </div>
      <div class="input-group">
        <label for="create_password">Mot de passe :</label>
        <input type="password" name="create_password" placeholder="Mot de passe" value="<?php echo strip_tags($userUpdate['password']); ?>">
      </div>
      <div class="input-group">
        <label for="create_actif">Actif :</label>
        <input type="text" name="create_actif" value="<?php echo strip_tags($userUpdate['actif']); ?>">
      </div>
    </div>
    <button class="btn-form" type="submit">Envoyer</button>
  </form>
<?php endif; ?>
```

Vous voyez que dans les inputs du formulaire, nous avons passé un nouvel attribut __value__ qui va nous permettre de remplir les inputs avec les information que nous a renvoyées la requête avec la variable __$userUpdate__ :

```php+HTML
<input type="text" name="create_nom" placeholder="Votre nom" value="<?php echo strip_tags($userUpdate['nom']); ?>">
```

Maintenant, il faut créer une autre page post_update.php qui va nous afficher une page avec le résultat de la soumission du formulaire et qui va envoyer les éléments en base de données s'ils sont valides.

En haut de votre fichier post_update.php vous allez faire la vérification des éléments et ensuite effectuer la requete SQL pour mettre à jour les informations :

```php
if (isset($_POST['id']) && !empty($_POST['create_email']) && !empty($_POST['create_password']) && !empty($_POST['create_actif'])) {

    $id = $_POST['id'];
    $nom = $_POST['create_nom'];
    $email = $_POST['create_email'];
    $password = $_POST['create_password'];
    $actif = $_POST['create_actif'];

    $sqlQueryAddUser = 'UPDATE utilisateurs SET nom= :nom, email= :email, password= :password, actif= :actif WHERE id= :id';

    $insertUser = $db->prepare($sqlQueryAddUser);

    $insertUser->execute([
        'id' => $id,
        'nom' => $nom,
        'email' => $email,
        'password' => $password,
        'actif' => $actif,
    ]);
} else {
    $errorMessageUpdate = 'Il y a une erreur :';
}
```

Ici nous vérifions que les informations sont bonnes, si oui nous envoyons la requête avec les informations, sinon nous ajoutons la variable $errorMessageUpdate.

Il nous reste maintenant à gérer l'affichage condition du résultat de la soumission du formulaire :

```php+HTML
<?php if (isset($errorMessageUpdate)) : ?>
  <section>
    <div class="card">
      <div class="card-body">
        <div class="alert alert-danger" role="alert">
          <h5 class="card-title">Erreur dans le formulaire</h5>
          <p><?php echo ($errorMessageUpdate); ?></p>
        </div>
      </div>
    </div>
  </section>

  <?php else : ?>
  <section>
    <h1>Utilisateur modifié</h1>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Rappel des informations</h5>
        <p class="card-text"><b>Nom</b> : <?php echo $_POST['create_nom']; ?></p>
        <p class="card-text"><b>email</b> : <?php echo strip_tags($_POST['create_email']); ?></p>
        <p class="card-text"><b>actif</b> : <?php echo strip_tags($_POST['create_actif']); ?></p>
      </div>
    </div>
  </section>
<?php endif; ?>
```

Vous avez maintenant un formulaire d'update utilisateur fonctionnel.

### Créer une page qui liste les utilisateurs

Pour l'ajout et la suppression d'utilisateurs que nous verrons pas la suite, nous allons mettre en place une page qui va nous lister les utilisateurs et qui va aussi avoir 2 boutons -> 1 pour la modification et 1 pour la suppression des utilisateurs.

Pour ça vous allez créer un nouveau fichier __liste-user.php__, dans cette page vous allez simplement faire une boucle foreach sur la variable $users pour qu'elle vous affiche tous les utilisateurs :

```php+HTML
<section class="liste-users">
  <?php foreach ($users as $user) : ?>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title"><?php echo $user['nom']; ?></h5>
      <p class="card-text"><b>Email</b> : <?php echo strip_tags($user['email']); ?></p>
      <p class="card-text"><b>Actif</b> : <?php echo strip_tags($user['actif']); ?></p>
    </div>
    <div class="card-btn">
      <a class="alert-success" href="<?php echo $rootURLPath . "/admin/update-user.php?id=" . $user['id']; ?>">Modifier</a>
      <a class="alert-danger" href="#">Supprimer</a>
    </div>
  </div>
  <?php endforeach; ?>
</section>
```

Vous n'opterez que sur le bouton (la balise __`<a>`__), nous avons créé un lien dynamique :

```php+HTML
<a class="alert-success" href="<?php echo $rootURLPath . "/admin/update-user.php?id=" . $user['id']; ?>">Modifier</a>
```

Le paramètre id est dynamique étant donnée que nous utilisons la variable __`$user['id']`__, donc pour chaque utilisateur, si on clique sur le bouton modifier, nous serons rediriger vers la page de modification de l'utilisateur.

### Suppression d'utilisateur

Enfin, voilà une dernière requête qui pourra se révéler utile : `DELETE` .

Rapide et simple à utiliser, elle est quand même un poil dangereuse : après suppression, il n'y a aucun moyen de récupérer les données, alors faites bien attention !

Voici comment on supprime par exemple une recette à partir de son identifiant :

```sql
DELETE FROM utilisateurs WHERE id=:id
```

Il n'y a rien de plus facile :

- `DELETE FROM` : pour dire « supprimer dans » ;
- `utilisateurs` : le nom de la table ;
- `WHERE` : indispensable pour indiquer quelle(s) entrée(s) doi(ven)t être supprimée(s).

Si vous oubliez le `WHERE` , toutes les entrées seront supprimées. Cela équivaut à vider la table.

Maintenant, pour respecter les bonnes pratiques du protocole HTTP, __nous ne devons pas__ supprimer l'utilisateur simplement en cliquant sur le bouton supprimer sur la page liste-user en passant un paramètre à l'URL (méthode GET).

Il faut passer par une méthode POST et pour cela, nous allons créer une page de confirmation de suppression qui aura pour but de passer par une méthode POST, et également faire une double vérification pour la suppression d'élément en base de données.

Donc vous allez créer un fichier delete.php :

```php+HTML
<section>
  <h1>Page de suppression d'un utilisateur</h1>
  <div class="liste-users">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo $userDelete['nom']; ?></h5>
        <p class="card-text"><b>Email</b> : <?php echo strip_tags($userDelete['email']); ?></p>
        <p class="card-text"><b>Actif</b> : <?php echo strip_tags($userDelete['actif']); ?></p>
      </div>
    </div>
  </div>
  <form class="form-user" action="post_delete.php" method="POST">
    <div class="form-login-input">
      <div class="hidden">
        <label for="id">Identifiant de l'utilisateurs</label>
        <input type="hidden" name="id" value="<?php echo $userUpdate['id']; ?>">
      </div>
      <div class="input-group alert alert-danger">
        <p><b>Attention la suppression est définitive</b></p>
      </div>
    </div>
    <button class="btn-form" type="submit">Suppresion de l'utilisateur</button>
  </form>
</section>
```

En haut du fichier __delete-user.php__ vous allez devoir vérifier que l'id qui est passé en paramètre est valide, et récupérer les informations de l'utilisateur en question avec une requete SQL : 

```php
foreach ($users as $user => $userInfo) {
    if (in_array($_GET['id'], $users[$user])) {
        $searchId = true;
    }
}

if (!isset($searchId)) {
    $errorMessageId = "Il faut un id valide";
} else {
    $sqlQueryGetUser = 'SELECT * FROM utilisateurs WHERE id =:id';
    $getUserStatement = $db->prepare($sqlQueryGetUser);

    $getUserStatement->execute([
        'id' => $_GET['id'],
    ]);

    $userDelete = $getUserStatement->fetch(PDO::FETCH_ASSOC);
}
```

Cette fois, si l'id est bon, nous créons la variable $userDelete qui va contenir les informations de l'utilisateur que nous voulons supprimer.

Maintenant, nous allons créer la page de réponse à la suppression de l'utilisateur qui va supprimer en base l'utilisateur et afficher la réponse sur le site.

Pour ça créez un fichier __post_delete.php__ en haut du fichier, vous allez gérer la validation et la suppression de l'utilisateur:

```php
if (isset($_POST['id']) && !empty($_POST['id'])) {

    $id = $_POST['id'];

    $sqlQueryDeleteUser = 'DELETE FROM utilisateurs WHERE id= :id';

    $insertUser = $db->prepare($sqlQueryDeleteUser);

    $insertUser->execute([
        'id' => $id,
    ]);
} else {
    $errorMessageDelete = 'Il y a une erreur';
}
```

Maintenant, vous devez gérer l'affichage de la page dynamiquement (s'il y a une erreur ou non) : 

```php+HTML
<section>
  <?php if (isset($errorMessageDelete)) : ?>

  <div class="alert alert-danger">
    <h5 class="card-title">Erreur dans le formulaire</h5>
    <p><?php echo ($errorMessageDelete); ?></p>
  </div>

  <?php else : ?>

  <div class="alert alert-success">
    <h5 class="card-title">Utilisateur supprimer</h5>
  </div>

  <?php endif; ?>
</section>
```

Et voilà, vous avez maintenant mis en place une suppression des utilisateur fonctionnel, il nous reste plus qu'à modifier le lien vers la suppression dans la page __liste_user.php__ : 

```php+HTML
<section class="liste-users">
  <?php foreach ($users as $user) : ?>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title"><?php echo $user['nom']; ?></h5>
      <p class="card-text"><b>Email</b> : <?php echo strip_tags($user['email']); ?></p>
      <p class="card-text"><b>Actif</b> : <?php echo strip_tags($user['actif']); ?></p>
    </div>
    <div class="card-btn">
      <a class="alert-success" href="<?php echo $rootURLPath . "/admin/update-user.php?id=" . $user['id']; ?>">Modifier</a>
      <a class="alert-danger" href="<?php echo $rootURLPath . "/admin/delete-user.php?id=" . $user['id']; ?>">Supprimer</a>
    </div>
  </div>
  <?php endforeach; ?>
</section>
```

Vous voyez que nous avons changé l'URL de suppression :

```php+HTML
<a class="alert-danger" href="<?php echo $rootURLPath . "/admin/delete-user.php?id=" . $user['id']; ?>">Supprimer</a>
```

## Gérer les jointures SQL

Jusque-là, vous n'avez travaillé que sur une seule table à la fois. Dans la pratique, vous aurez certainement plusieurs tables dans votre base, dont la plupart seront interconnectées.

Cela vous permettra :

- de mieux découper vos informations ;
- d'éviter des répétitions ;
- et de rendre ainsi vos données plus faciles à gérer.

Imaginons que chaque utilisateur peut créer des articles sur le site. Nous n'allons pas créer un champ dans la table utilisateurs, mais nous allons créer une table articles qui listera tous les articles et qui reliera les articles aux utilisateurs qui l'ont écrit.

C'est ce qu'on appelle une jointure en SQL.

### Modélisez une relation

Si on considère qu'un page affiche un article et qu'on veuille également afficher les informations de l'auteur, notre table article aura les propriétés :

- Un identifiant unique,
- Une description,
- Un auteur,
- Une date de publication

Donc de base notre table devrait ressembler à ça : 

| id   | Description         | Auteur | Date     |
| ---- | ------------------- | ------ | -------- |
| 1    | Ceci est un article | Pierre | 12-01-22 |
| 2    | Un autre article    | James  | 10-01-22 |

Mais comme vous le voyez, l'information sur l'auteur fait "doublon" avec les informations de la table utilisateurs (cette information est déjà stocké).

Dans un premier temps, ce qu'il faut faire dans la table article, c'est de modifier la colonne "Auteur" pour intégrer l'ID de l'utilisateur (qui est dans la table utilisateurs), donc ça donne :

| Id   | Description         | user_id | Date     |
| ---- | ------------------- | ------- | -------- |
| 1    | Ceci est un article | 1       | 12-01-22 |
| 2    | Un autre article    | 2       | 10-01-22 |

Ensuite, il va falloir définir notre jonction, pour le moment SQL ne sait pas encore que la colonne user_id fait référence à une autre table.

### Les jointures

Nous avons donc maintenant 2 tables :

- Utilisateurs
- Articles

Les informations sont séparées dans des tables différentes, et c'est bien. Cela évite de dupliquer des informations sur le disque.

Cependant, lorsqu'on récupère la liste des articles, si on souhaite obtenir le nom des auteurs, il faut adapter la requête pour récupérer aussi les informations issues de la table `utilisateurs` .

Pour cela, on doit faire une **jointure**.

Il existe plusieurs types de jointures, qui nous permettent de choisir exactement les données que l'on veut récupérer. Je vous propose d'en découvrir deux, les plus importantes :

1. **Les jointures internes** : elles ne sélectionnent que les données qui ont une correspondance entre les deux tables.
2. **Les jointures externes** : elles sélectionnent toutes les données, même si certaines n'ont pas de correspondance dans l'autre table.

Il est important de bien comprendre la différence entre une jointure interne et une jointure externe.

Pour cela, imaginons que nous ayons un nouvel utilisateur dans la table des utilisateurs, un certain Manuels Vache, qui n'a jamais publié de commentaires.

Manuels Vache est référencé dans la table `utilisateurs` mais il n'apparaît nulle part dans la table `articles` car il n'a jamais écrit d'article.

1. Si vous récupérez les données des deux tables à l'aide d'une **jointure interne**, Manuels **n'apparaîtra pas** dans les résultats de la requête. La jointure interne force les données d'une table à avoir une correspondance dans l'autre.
2. Si vous récupérez les données des deux tables à l'aide d'une **jointure externe**, vous aurez toutes les données de la table des utilisateurs, même s'il n'y a pas de correspondance dans l'autre table des commentaires ; donc Manuels, qui pourtant n'a jamais commenté, apparaîtra.

La jointure externe est donc plus complète car elle est capable de récupérer plus d'informations, tandis que la jointure interne est plus stricte car elle ne récupère que les données qui ont une équivalence dans l'autre table.

Nous allons maintenant voir comment réaliser ces deux types de jointures en pratique.

### Faire un jointure interne

Une jointure interne peut être effectuée à l'aide du mot-clé `INNER JOIN` :

```sql
# Liste des noms et articles associés

SELECT u.nom, a.titre
FROM utilisateurs u
INNER JOIN articles a
ON u.user_id = a.user_id
```

Cette fois, on récupère les données depuis une table principale (ici, `utilisateurs` ) et on fait une jointure interne ( `INNER JOIN` ) avec une autre table ( `articles` ).

La liaison entre les champs est faite dans la clause `ON` un peu plus loin.

Si vous voulez :

- filtrer ( `WHERE` ),
- ordonner ( `ORDER BY` )
- ou limiter les résultats ( `LIMIT` ),

… vous devez le faire à la fin de la requête, après le « `ON u.user_id = a.user_id` ».

Par exemple : 

```sql
SELECT u.nom, a.titre
FROM utilisateurs u
INNER JOIN articles a
ON u.user_id = a.user_id
WHERE u.nom = 'Pierre'
ORDER BY a.date DESC
LIMIT 10
```

Se traduit par : 

Récupère le titre de l'article et le nom de l'auteur dans les tables utilisateurs et articles, la liaison entre les tables se fait sur le champ user_id, prends uniquement les articles de l'auteur Pierre, trie-les par date décroissante et ne prends que les 10 premiers.

Cette requête va donc vous retrouver seulement le titre de l'article (ou des articles) qui son écrit par Pierre.

Si vous souhaitez récupérer plusieurs informations des articles écrit par Pierre, vous pouvez modifier le `SELECT` dans votre requête en ajoutant des champs à récupérer :

```sql
SELECT u.nom, a.titre, a.description
FROM utilisateurs u
INNER JOIN articles a
ON u.user_id = a.user_id
WHERE u.nom = 'Pierre'
```

### Faire une jointure externe

Les jointures externes permettent de récupérer toutes les données, même celles qui n'ont pas de correspondance.

On pourrait ainsi obtenir les utilisateurs n'ayant pas écrit d'articles. 

Il y a deux écritures à connaître :

1. `LEFT JOIN` 
2. `RIGHT JOIN` 

Cela revient pratiquement au même, avec une subtile différence que nous allons voir.

#### Récupérez toute la table de gauche avec `LEFT JOIN`

Reprenons la jointure à base de `INNER JOIN` et remplaçons tout simplement `INNER` par `LEFT` :

```sql
SELECT u.nom, a.titre
FROM users u
LEFT JOIN articles a
ON u.user_id = a.user_id
```

`utilisateurs` est appelée la « table de gauche » et `articles` la « table de droite ».

Le `LEFT JOIN` demande à récupérer tout le contenu de la table de gauche, donc tous les utilisateurs, même si ces derniers n'ont pas d'équivalence dans la table `articles`.

#### Récupérez toute la table de droite avec `RIGHT JOIN`

Le `RIGHT JOIN` demande à récupérer toutes les données de la table dite « de droite », même si celle-ci n'a pas d'équivalent dans l'autre table.

```sql
SELECT u.nom, a.titre
FROM users u
RIGHT JOIN articles a
ON u.user_id = a.user_id
```

## L'architecture MCV

L'architecture MCV est très importante quand vous développez en PHP, c'est aussi à ça qu'on reconnait un bon développeur PHP.

En PHP, il y a certains bug qui surviennent tellement souvent, qu'on a mis en place une série de bonnes pratiques pour les éviter, c'est ce qu'on appelle les design patterns.

Un des plus célèbre Design Pattern est le MCV, vous devez appliquer ce Design Pattern pour vos projet en PHP.

MCV pour __Model__, __Controlleur__ et __Vue__, qui définit que chaque partie à son importance : 

Le pattern MVC permet de bien organiser son code source. Il va vous aider à savoir quels fichiers créer, mais surtout à définir leur rôle. Le but de MVC est justement de séparer la logique du code en trois parties que l'on retrouve dans des fichiers distincts.

- **Modèle** : cette partie gère les *données* de votre site. Son rôle est d'aller récupérer les informations « brutes » dans la base de données, de les organiser et de les assembler pour qu'elles puissent ensuite être traitées par le contrôleur. On y trouve donc entre autres les requêtes SQL.
- **Vue** : cette partie se concentre sur l'*affichage*. Elle ne fait presque aucun calcul et se contente de récupérer des variables pour savoir ce qu'elle doit afficher. On y trouve essentiellement du code HTML mais aussi quelques boucles et conditions PHP très simples, pour afficher par exemple une liste de messages.
- **Contrôleur** : cette partie gère la logique du code qui prend des *décisions*. C'est en quelque sorte l'intermédiaire entre le modèle et la vue : le contrôleur va demander au modèle les données, les analyser, prendre des décisions et renvoyer le texte à afficher à la vue. Le contrôleur contient exclusivement du PHP. C'est notamment lui qui détermine si le visiteur a le droit de voir la page ou non (gestion des droits d'accès).

Voici un schéma qui correspond au pattern MCV :

![L'architecture MVC](https://user.oc-static.com/files/382001_383000/382127.png)

Il est important de bien comprendre comment ces éléments s'agencent et communiquent entre eux. Regardez bien la figure suivante.

![Échange d'informations entre les éléments](https://user.oc-static.com/files/382001_383000/382128.png)

Il faut tout d'abord retenir que le contrôleur est le chef d'orchestre : c'est lui qui reçoit la requête du visiteur et qui contacte d'autres fichiers (le modèle et la vue) pour échanger des informations avec eux.

Le fichier du contrôleur demande les données au modèle sans se soucier de la façon dont celui-ci va les récupérer. Par exemple : « Donne-moi la liste des 30 derniers messages du forum numéro 5 ». Le modèle traduit cette demande en une requête SQL, récupère les informations et les renvoie au contrôleur.

Une fois les données récupérées, le contrôleur les transmet à la vue qui se chargera d'afficher la liste des messages.

Concrètement, le visiteur demandera la page au contrôleur et c'est la vue qui lui sera retournée, comme schématisé sur la figure suivante. Bien entendu, tout cela est transparent pour lui, il ne voit pas tout ce qui se passe sur le serveur. C'est un schéma plus complexe que ce à quoi vous avez été habitués, bien évidemment : c'est pourtant sur ce type d'architecture que repose un grand nombre de sites professionnels !

![La requête du client arrive au contrôleur et celui-ci lui retourne la vue](https://user.oc-static.com/files/382001_383000/382129.png)

