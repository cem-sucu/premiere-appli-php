<?php 

// A la différence d'index.php, nous aurons besoin ici de parcourir le tableau de session, il est donc nécessaire d'appeler la fonction session_start() en début de fichier afin de récupérer, comme dit plus haut, la session correspondante à l'utilisateur.
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des produits</title>
</head>
<body>
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
        $totalGenral = 0;
        foreach($_SESSION['products'] as $index => $product){
            echo "<tr>",
                    "<td>".$index."</td>",
                    "<td>".$product['name']."</td>",
                    "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp€"."</td>",
                    "<td>".$product['qtt']."</td>",
                    "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp€"."</td>",
                "</tr>";
            $totalGenral += $product['total'];
        }
        echo "<tr>",
                "<td colspan=4> Total génréal : </td>" ,
                "<td><trong>".number_format($totalGenral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
            "</tr>",
        "</tbody>";
      
    } 
    echo "</tbody>",
        "</table>"
        
        
        ?>
</body>
</html>