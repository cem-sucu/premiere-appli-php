<?php 

session_start();
// Il  faut  donc  limiter  l'accès  à  traitement.php  par  les  seules  requêtes  HTTP provenant de la soumission de notre formulaire.


if(isset($_POST['submit'])){

    // FILTER_SANITIZE_STRING(champ   "name")   :   ce   filtre   supprime   une   chaîne   de caractères  de  toute  présence  de  caractères  spéciaux  et  de  toute  balise  HTML potentielle ou les encode. Pas d'injection de code HTML possible !
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);

    // FILTER_VALIDATE_FLOAT(champ  "price")  :  validera  le  prix  que  s'il  est  un  nombre  à virgule (pas de texte ou autre...), le drapeau FILTER_FLAG_ALLOW_FRACTIONest ajouté pour permettre l'utilisation du caractère "," ou "." pour la décimale.
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    //FILTER_VALIDATE_INT(champ  "qtt")  :  ne  validera  la  quantité  que  si  celle-ci  est  un nombre entierdifférent de zéro (qui est considéré comme nul).
    // filter_input()  renvoie  en  cas  de  succès  la  valeur  assainie  correspondant  au  champ  traité, false si le filtre échoue ou null si le champ sollicité par le nettoyage n'existait pas dans la requête    POST.    Ainsi, pas    de    risque    que    l'utilisateur    transmette    des    champs supplémentaires!
    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
    

    if($name && $price & $qtt){

        $product = [
            "name" => $name,
            "price" => $price,
            "qtt" => $qtt,
            "total" => $price*$qtt,

        ];
        $_SESSION['products'][] = $product;
        // Cette ligne 27 est particulièrement efficace car :On sollicite le tableau de session $_SESSION fourni par PHP.On indique la clé "products" de ce tableau. Si cette clé n'existait pas auparavant (ex: l'utilisateur ajoute son tout premier produit), PHP la créera au sein de $_SESSION.Les deux crochets "[]"2sont un raccourci pour indiquer à cet emplacement que nous ajoutons  une  nouvelle  entrée  au  futur tableau  "products"  associé  à  cette  clé. $_SESSION["products"] doit être lui aussi un tableau afin d'y stocker de nouveaux produits par la suite.
    }

}

header("Location:index.php");


?>