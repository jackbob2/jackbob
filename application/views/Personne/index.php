<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>::Jackbob test personne::</title>
</head>
<?php
if(is_array($listePersonnes) && count($listePersonnes) > 0){
?>
<h2>Liste des personnes</h2>
<table border="1" cellpadding="2" cellspacing="0">
    <tbody>
        <tr style='background-color:#EEAAFF;text-align:center;font-weight: bold;'>
            <td>Nom</td>
            <td>Prénoms</td>
            <td>Age</td>
            <td>Adresse</td>
        </tr>
    </tbody>
    <?php
    $i = 0 ;
    foreach($listePersonnes as $personne){
    ?>
    <tr <?php if($i%2 == 0){ echo "style='background-color:#CCCCCC;'" ; } ?>>
        <td><?php echo $personne -> getNom() ; ?></td>
        <td><?php echo $personne -> getPrenom() ; ?></td>
        <td><?php echo $personne -> getAge() ; ?></td>
        <td><?php echo $personne -> getAdresse() ; ?></td>
    </tr>
    <?php
    $i++ ;
    }
    ?>
</table>
<?php
}else{
    echo "Pas de personne trouvés" ;
}
?>
</html>