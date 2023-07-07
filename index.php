<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter produit</title>
</head>
<body>
    <h1>Ajouter un produit</h1>
    <!-- dans forme ACTION indique  la  cible  du  formulaire,  le  fichier  à  atteindre  lorsque  l'utilisateur soumettra le formulaire   -->
    <!-- dans forme METHODE précise  par  quelle  méthode  HTTP  les  données  du  formulaire  seront transmises au serveur -->
    <form action="traitement.php" method="post">
        <p>
            <label>
                Nom du produit :
                <input type="text" name="name"> <!-- l'attribut name permet de lasser le contenu de la saisie dans des clés portant le nom choisi. -->
            </label>
        </p>
        <p>
            <label>
                Prix du produit :
                <input type="number" step="any" name="price">
            </label>
        </p>
        <p>
            <label>
                Quantité désiré :
                <input type="number" name="qtt" value="1">
            </label>
        </p>
        <p>
            <input type="submit" name="submit" value="Ajouter le produit">
        </p>
    </form>
</body>
</html>