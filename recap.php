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

    <div class="menu">
        <button class="directionRecap">
            <a href="index.php">retour à l'accueil</a></button>
    </div>
   
    <div class="sectionPanier">
        <?php

        // A la différence d'index.php, nous aurons besoin ici de parcourir le tableau de session, il est donc nécessaire d'appeler la fonction session_start() en début de fichier afin de récupérer, comme dit plus haut, la session correspondante à l'utilisateur.
session_start();

        if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
            echo "<p>Aucun produit en session</p>";
        } else {
            echo "<table>",
                    "<thead>",
                        "<tr>",
                            // "<th>#</th>",
                            "<th>Nom</th>",
                            "<th>Description</th>",
                            "<th>Prix</th>",
                            "<th>Quantité</th>",
                            "<th>Total</th>",
                            "<th>Supprimer</th>",//action
                        "</tr>",
                    "</thead>",
                    "<tbody>";

            $totalGeneralTemp = 0;

            foreach ($_SESSION['products'] as $index => $product) {
                echo "<tr>",
                        // "<td>".$index."</td>",
                        "<td>".$product['name']."</td>",
                        "<td>".$product['description']."</td>",
                        "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€"."</td>",
                        "<td>",
                            "<a href='traitement.php?action=decrementer&index=".$index."'><i class='fa-solid fa-minus'></i></a>",
                            "&nbsp;".$product['qtt']."&nbsp;",
                            "<a href='traitement.php?action=incrementer&index=".$index."'><i class='fa-solid fa-plus'></i></a>",
                        "</td>",
                        "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€"."</td>",
                        "<td><a href='traitement.php?action=supprimer&index=".$index."'><i class='fa-solid fa-trash'></i></a></td>",
                    "</tr>";
                $totalGeneralTemp += $product['total']; 
                
                //ma modal
            echo "<div class='maModal'>".
                    "<img src='./upload/'".$_FILES['file']['name']." alt=''>".
                    "<p>".$product['description']."</p>".
                "</div>";
            }

            $totalGeneral = $totalGeneralTemp;

            echo "<tr>",
                    "<td colspan='6'><a class='suppTout' href='traitement.php?action=supprimer_tout'>Supprimer tous les produits <i class='fa-solid fa-trash'></i></a></td>",
                "</tr>";
            echo "<tr>",
                    "<td colspan='4'>Total général:</td>",
                    "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                "</tr>",
                "</tbody>"; 


            

        echo "</table>";

                
        }
      
        ?>
    </div>

        

</body>
</html>