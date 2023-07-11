<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Ajouter produit</title>
</head>
<body>
    <div class="menu">
        <button class="directionRecap">
            <a href="recap.php">Voir votre récapitulatif</a></button>
    </div>
    <div class="section">
        <h1>Ajouter un produit</h1>
        <!-- dans forme ACTION indique  la  cible  du  formulaire,  le  fichier  à  atteindre  lorsque  l'utilisateur soumettra le formulaire   -->
        <!-- dans forme METHODE précise  par  quelle  méthode  HTTP  les  données  du  formulaire  seront transmises au serveur -->
        <form action="traitement.php?action=ajouterProduit" method="post">
            <p>
                <label>
                   <span> Nom du produit  </span>
                    <input type="text" name="name"> <!-- l'attribut name, price et qtt permet de lasser le contenu de la saisie dans des clés portant le nom choisi. -->
                </label>
            </p>
            <p>
                <label>
                   <span> Prix du produit  </span>
                    <!-- l'attribut min="0" dans le input permet d'éviter de permettre a l'utilisateur de rentrer une valeur négatif -->
                    <input type="number" step="any" name="price" min="0" >
                </label>
            </p>
            <p>
                <label>
                   <span> Quantité désiré  </span>
                    <input type="number" name="qtt" value="1">
                </label>
            </p>
            <p>
                <label>
                   <span> Description du produit  </span>
                    <textarea rows="4" cols="30"> </textarea>
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>
                </label>
            </p>
            
        </form>

        <?php 
        // l'appel à session_start() en début de fichier est important car ici j'utilise des sessions dans les pages suivantes (traitement.php et recap.php). Sans cet appel, on peux pas accéder aux données de session ou enregistrer de nouvelles données dans la session.
        //En gros, session_start() initialise la gestion des sessions pour  l'application web et permet d'utiliser le tableau $_SESSION pour stocker et récupérer des données spécifiques à chaque utilisateur.
        session_start();

            // isset($_SESSION['products']) vérifie si le panier (la variable $_SESSION['products']) existe. Si le panier existe, cela signifie qu'on ajouté des jouets.
            // count($_SESSION['products']) compte combien de jouets on dans le panier. Cela nous donne le nombre total de jouets.
            // ? et : sont comme des instructions spéciales. Ils disent "Si le panier existe, fais cela. Sinon, fais cela." on peut tres bien le remplacer par un if et else.
            // 0 est le nombre zéro. C'est ce que nous affichons si on n'as pas encore ajouté de jouets.
            $numberOfProducts = isset($_SESSION['products']) ? count($_SESSION['products']) : 0;

            echo "Nombre de produits en session : " . $numberOfProducts;



            // Vérifi si le message est présent dans la session 
            if (isset($_SESSION['message'])) {
                echo "<p>" . $_SESSION['message'] . "</p>";
                unset($_SESSION['message']); // Supprime le message de la session pour qu'il ne soit affiché qu'une fois
            }
            ?>
        </div>
</body>
</html>