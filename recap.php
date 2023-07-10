<?php 

// A la différence d'index.php, nous aurons besoin ici de parcourir le tableau de session, il est donc nécessaire d'appeler la fonction session_start() en début de fichier afin de récupérer, comme dit plus haut, la session correspondante à l'utilisateur.
session_start();

//permet de vider la session :
// session_unset();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Récapitulatif des produits</title>
</head>
<body>
<div>
        <button class="directionRecap">
            <a href="index.php">retour à l'accueil</a></button>
    </div>
    <?php
    //var_dump($_SESSION); // pour afficher les donnéé du tableau
    if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
        echo "<p>Aucun produit en session</p>";
    } 
    else{
        echo "<table>",
            "<thead>",
                "<tr>",
                    "<th>#</th>",
                    "<th>Nom</th>",
                    "<th>Prix</th>",
                    "<th>Quantité</th>",
                    "<th>Total</th>",
                "</tr>",
            "</thead>",
            "<tbody>";
     
        $totalGeneralTemp = 0;

        // Vérifier si l'action de suppression est déclenchée
        if (isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['index'])) {
            $index = $_GET['index'];
            // Vérifier si l'index existe dans le tableau des produits
            if (isset($_SESSION['products'][$index])) {
                // Supprimer le produit correspondant à l'index
                unset($_SESSION['products'][$index]);
                // Rediriger vers la page de récapitulatif après la suppression
                header("Location: recap.php");
                exit; // Terminer l'exécution du script après la redirection
            }
        }

      
        // Vérifier si une action est déclenchée
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            $index = $_GET['index'];

            // Vérifier l'action
            if ($action === 'incrementer') {
                // Incrémenter la quantité du produit correspondant
                $_SESSION['products'][$index]['qtt']++;
                //permet d'éxécuter l'incrémentation
                $totalGeneralTemp += $_SESSION['products'][$index]['price'];
            } elseif ($action === 'decrementer') {
                // Décrémenter la quantité du produit correspondant
                if ($_SESSION['products'][$index]['qtt'] > 1) {
                    $_SESSION['products'][$index]['qtt']--;
                    //permet de faire la décrémentation
                    $totalGeneralTemp -= $_SESSION['products'][$index]['price'];
                }
            } elseif ($action === 'supprimer') {
                //met a jour le total général 
                $totalGeneralTemp -= $_SESSION['products'][$index]['total'];
                // Supprimer le produit correspondant du tableau de session
                unset($_SESSION['products'][$index]);
                $_SESSION['products'] = array_values($_SESSION['products']); // Réorganiser les indices du tableau
            }
        }


        //genere le tableur avec les éléments et le button supprimer
        foreach($_SESSION['products'] as $index => $product){
            echo "<tr>",
                    "<td>".$index."</td>",
                    "<td>".$product['name']."</td>",
                    "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp€"."</td>",
                    "<td>",
                        "<a href='recap.php?action=incrementer&index=".$index."'><i class='fa-solid fa-plus'></i></a>",
                        "&nbsp;".$product['qtt']."&nbsp;",
                        "<a href='recap.php?action=decrementer&index=".$index."'><i class='fa-solid fa-minus'></i></a>",
                    "</td>",
                    "<td>".$product['qtt']."</td>",
                    "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp€"."</td>",
                    "<td><a href=\"recap.php?action=supprimer&index=".$index."\"><i class='fa-solid fa-trash'></i></a></td>",
                "</tr>";
                $totalGeneralTemp += $product['qtt'] * $product['price'];
        }

        $totalGeneral = $totalGeneralTemp;

        // Vérifier si l'action de suppression globale est déclenchée
        if (isset($_GET['action']) && $_GET['action'] === 'supprimer_tout') {
            // Supprimer tous les produits de la session
            unset($_SESSION['products']);
            // Rediriger vers la page de récapitulatif après la suppression
            header("Location: recap.php");
            exit; // Terminer l'exécution du script après la redirection
        }
        echo "<tr>",
                "<td colspan='6'><a class='suppTout' href='recap.php?action=supprimer_tout'>Supprimer tous les produits <i class='fa-solid fa-trash'></i></a></td>",
            "</tr>";
        echo "<tr>",
                "<td colspan=4> Total génréal : </td>" ,
                "<td><trong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
            "</tr>",
        "</tbody>";
      
    } 
    echo "</tbody>",
        "</table>"
        
        
        ?>
</body>
</html>