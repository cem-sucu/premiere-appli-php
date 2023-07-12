<?php 
//permet de vider la session :
// session_unset();

session_start();
// Il  faut  donc  limiter  l'accès  à  traitement.php  par  les  seules  requêtes  HTTP provenant de la soumission de notre formulaire.

// il faut itialiser la variable $product avant le bloc if pour éviter une erreur si les conditions ne sont pas remplies et non kuste après ou ailleurs
$product = null;

switch ($_GET["action"]) {

    case "ajouterProduit":
        if (isset($_POST['submit'])) {

            // FILTER_SANITIZE_STRING(champ "name") : ce filtre supprime une chaîne de caractères de toute présence de caractères spéciaux et de toute balise HTML potentielle ou les encode. Pas d'injection de code HTML possible !
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // FILTER_VALIDATE_FLOAT(champ "price") : validera le prix que s'il est un nombre à virgule (pas de texte ou autre...), le drapeau FILTER_FLAG_ALLOW_FRACTION est ajouté pour permettre l'utilisation du caractère "," ou "." pour la décimale.
            $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            // FILTER_VALIDATE_INT(champ "qtt") : ne validera la quantité que si celle-ci est un nombre entier différent de zéro (qui est considéré comme nul).
            // filter_input() renvoie en cas de succès la valeur assainie correspondant au champ traité, false si le filtre échoue ou null si le champ sollicité par le nettoyage n'existait pas dans la requête POST. Ainsi, pas de risque que l'utilisateur transmette des champs supplémentaires!
            $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

            if ($name && $price && $qtt) {
                $product = [
                    "name" => $name,
                    "price" => $price,
                    "qtt" => $qtt,
                    "total" => $price * $qtt,
                ];
                $_SESSION['products'][] = $product;

                // Afficher un message d'erreur si on ajoute bien le produit ou si l'on s'est trompé
                // En vert, le produit a été ajouté 
                $_SESSION['message'] = "<p style='color:green'>Le produit a été ajouté avec succès !</p>";
            } else {
                // Sinon, en rouge, une erreur est survenue lors de l'ajout
                $_SESSION['message'] = "<p style='color:red'>Une erreur est survenue lors de l'ajout du produit.</p>";
            }
        }
        
        header("Location: index.php");
        break;

    case "incrementer":
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            if (isset($_SESSION['products'][$index]) && $_SESSION['products'][$index]['qtt'] >= 1) {
                $_SESSION['products'][$index]['qtt']++;
                $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['qtt'] * $_SESSION['products'][$index]['price'];
            }
        }
        header("Location: recap.php");
        break;

    case "decrementer":
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            if (isset($_SESSION['products'][$index]) && $_SESSION['products'][$index]['qtt'] > 1) {
                $_SESSION['products'][$index]['qtt']--;
                $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['qtt'] * $_SESSION['products'][$index]['price'];
            }
        }
        header("Location: recap.php");
        break;

    case "supprimer":
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            if (isset($_SESSION['products'][$index])) {
                unset($_SESSION['products'][$index]);
                $_SESSION['products'] = array_values($_SESSION['products']);
            }
        }
        header("Location: recap.php");
        break;

    case "supprimer_tout":
        unset($_SESSION['products']);
        header("Location: recap.php");
        break;

    default:
        header("Location: index.php");
        break;
}
?>



