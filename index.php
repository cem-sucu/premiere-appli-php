<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ajouter produit</title>
</head>
<body>
<?php
        // l'appel à session_start() en début de fichier est important car ici j'utilise des sessions dans les pages suivantes (traitement.php et recap.php). Sans cet appel, on peux pas accéder aux données de session ou enregistrer de nouvelles données dans la session.
        //En gros, session_start() initialise la gestion des sessions pour  l'application web et permet d'utiliser le tableau $_SESSION pour stocker et récupérer des données spécifiques à chaque utilisateur.
        session_start();

            // isset($_SESSION['products']) vérifie si le panier (la variable $_SESSION['products']) existe. Si le panier existe, cela signifie qu'on ajouté des jouets.
            // count($_SESSION['products']) compte combien de jouets on dans le panier. Cela nous donne le nombre total de jouets.
            // ? et : sont comme des instructions spéciales. Ils disent "Si le panier existe, fais cela. Sinon, fais cela." on peut tres bien le remplacer par un if et else.
            // 0 est le nombre zéro. C'est ce que nous affichons si on n'as pas encore ajouté de jouets.
            $numberOfProducts = isset($_SESSION['products']) ? count($_SESSION['products']) : 0;

            // echo "Nombre de produits en session : " . $numberOfProducts;
            // echo $numberOfProducts;



            // Vérifi si le message est présent dans la session 
            if (isset($_SESSION['message'])) {
                echo "<p>". $_SESSION['message'] . "</p>";
                unset($_SESSION['message']);// Supprime le message de la session pour qu'il ne soit affiché qu'une fois
                header("refresh:2; url=index.php" ); // rafraichis la page au bout de 2seconde redire vers index.php 
            }


            var_dump($_POST);
            var_dump($_FILES);

            //verifie si file existe
            if(isset($_FILES['file'])){
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $size = $_FILES['file']['size'];
                $error = $_FILES['file']['error'];
        
                move_uploaded_file($tmpName, './upload/'.$name);}



            ?>
    <div class="menu">
        <button class="directionRecap">
            <a href="recap.php">Voir votre récapitulatif </a></button>
            <p class="panier"><i class="fa-solid fa-cart-shopping"></i><span class="panier-valeur"><?php echo $numberOfProducts; ?></span></p>

    </div>
    <div class="sectionHome">
        <h1>Ajouter un produit</h1>


        <!-- dans la balise forme ACTION indique  la  cible  du  formulaire,  le  fichier  à  atteindre  lorsque  l'utilisateur soumettra le formulaire   -->
        <!-- dans la balise forme METHODE précise  par  quelle  méthode  HTTP  les  données  du  formulaire  seront transmises au serveur.-->
        <!-- enctype="multipart/form-data" est utilisé dans un formulaire HTML lorsque vous souhaitez permettre aux utilisateurs de télécharger des fichiers via le formulaire, sans ca les fichier seront mal transmis au serveur -->
        
        <!-- section formulaire -->
        <form action="traitement.php?action=ajouterProduit" method="POST" enctype="multipart/form-data">
            <p>
                <label>
                   <span class="designationInput"> Nom du produit  </span>
                    <input type="text" name="name"> <!-- l'attribut name, price et qtt permet de lasser le contenu de la saisie dans des clés portant le nom choisi. -->
                </label>
            </p>
            <p>
                <label>
                   <span class="designationInput"> Prix du produit  </span>
                    <!-- l'attribut min="0" dans le input permet d'éviter de permettre a l'utilisateur de rentrer une valeur négatif -->
                    <input type="number" step="any" name="price" min="0" >
                    <span>€</span>
                </label>
            </p>
            <p>
                <label>
                   <span class="designationInput"> Quantité désiré  </span>
                    <input type="number" name="qtt" value="1">
                </label>
            </p>
            <p>
                <label>
                   <span class="designationInput"> Description du produit  </span>
                    <textarea rows="4" name="description" cols="30" wrap="hard" maxlength="60"> </textarea>
                </label>
            </p>


            <!-- section upload image -->
                <label for="file">
                    <span class="designationInput">Fichier</span>
                    <input type="file" name="file" id="file">
                </label>


            <!-- button submit -->
            <p>
                <input class="validationButton" type="submit" name="submit" value="Ajouter le produit">
            </p>
                </label>
            </p>
            
        </form>

         
        </div>
</body>
</html>