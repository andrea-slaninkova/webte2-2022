<!-- andrea slaninkova 92209 -->
<?php
/*ini_set('display_errors', 1);
error_reporting(E_ALL);*/
?>
<?php
require_once 'restaurant1.php';
require_once 'restaurant2.php';
require_once 'restaurant3.php';

//var_dump($foods);
//var_dump($jedla);
$den = "tyzden";
if(isset($_POST['pondelok'])){
    $den = "Pondelok";
}else if(isset($_POST['utorok'])){
    $den = "Utorok";
}else if(isset($_POST['streda'])){
    $den = "Streda";
}else if(isset($_POST['stvrtok'])){
    $den = "Štvrtok";
}else if(isset($_POST['piatok'])){
    $den = "Piatok";
}else if(isset($_POST['sobota'])){
    $den = "Sobota";
}else if(isset($_POST['nedela'])){
    $den = "Nedeľa";
}else if(isset($_POST['tyzden'])){
    $den = "tyzden";
}

//var_dump($den);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Webte2 Andrea Slaninková</title>
    <meta charset="utf-8">
    <link rel="icon" href="images/list.png" type="image/gif" sizes="16x16">

    <link rel="stylesheet" href="style.css">

    <!-- navbar and table-->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="index.php">Zadanie 4</a></li>

    </ul>

</nav>

<div class="dni" style="margin: auto; width: 50% !important">

    <form action="index.php" method="post">
        <input type="submit" name="pondelok" value="Pondelok">
        <input type="submit" name="utorok" value="Utorok">
        <input type="submit" name="streda" value="Streda">
        <input type="submit" name="stvrtok" value="Štvrtok">
        <input type="submit" name="piatok" value="Piatok">
        <input type="submit" name="sobota" value="Sobota">
        <input type="submit" name="nedela" value="Nedeľa">
        <input type="submit" name="tyzden" value="Týždeň"> </form>
</div>

<div class="content">


    <div class="table-container">

        <table id="tbstyle" class="table">
            <th style="text-align: left" >
            <?php
            foreach ($jedla as $jedlo) {

                if($jedlo['day'] == "Pondelok"){
                    echo '' . $jedlo['date'];
                    echo ' - ';
                }
                if($jedlo['day'] == "Nedeľa"){
                    echo '' . $jedlo['date'];
                }
            }
            ?>

            </th>
            <tbody>

            <div class="restaurant1">

            <?php
            if($den == "tyzden"){
                ?>

                 <tr>
                        <td>Restauracia</td>
                        <td>Pondelok</td>
                        <td>Utorok</td>
                        <td>Streda</td>
                        <td>Štvrtok</td>
                        <td>Piatok</td>
                        <td>Sobota</td>
                        <td>Nedeľa</td>

                 </tr>
                   <tr>
                       <td>Delikanti PriF</td>
                       <?php

                       foreach ($foods as $food) {

                           if($food['menu']){
                               //var_dump(count($food['menu'])); ?>
                               <td>  <?php
                                   for($i = 0;  $i < sizeof($food['menu']); $i++){
                                       if($food['menu'][$i]){
                                           ?>
                                           <?= $food['menu'][$i]; ?> <br>
                                           <?php
                                       }
                                   }
                                   ?> </td>  <?php
                           }
                       }
                       ?> </tr> <?php

            }else{
                ?>
                <tr>
                    <td>Restauracia</td>
                    <td> <?= $den; ?> </td>

                </tr>
                <tr>
                    <td>Delikanti PriF</td>

                <?php

                foreach ($foods as $food) {
                    if($food['day'] == $den){

                        if($food['menu']){
                            //var_dump(count($food['menu'])); ?>
                            <td>  <?php
                                for($i = 0;  $i < sizeof($food['menu']); $i++){
                                    if($food['menu'][$i]){
                                        ?>
                                        <?= $food['menu'][$i]; ?> <br>
                                        <?php
                                    }
                                }
                                ?> </td>  <?php
                        }
                    }
                }
                ?>  </tr>  <?php

            }
            ?>

            </div>

            <div class="restaurant2">
                <?php
            if($den == "tyzden"){  ?>

                <tr>
                    <td>Eat&Meet</td>
                    <?php

                    foreach ($jedla as $jedlo) {

                        if($jedlo['menu']){
                            //var_dump(count($jedlo['menu'])); ?>
                            <td>  <?php
                                for($i = 0;  $i < sizeof($jedlo['menu']); $i++){
                                    if($jedlo['menu'][$i]){
                                        ?>
                                        <?= $jedlo['menu'][$i]; ?> <br>
                                        <?php
                                    }
                                }
                                ?> </td>  <?php
                        }
                    }
                    ?> </tr> <?php
            }else{
                ?>

                <tr>
                    <td>Eat&Meet</td>
                    <?php

                foreach ($jedla as $jedlo) {
                    if($jedlo['day'] == $den){

                        if($jedlo['menu']){
                            //var_dump(count($food['menu'])); ?>
                            <td>  <?php
                                for($i = 0;  $i < sizeof($jedlo['menu']); $i++){
                                    if($jedlo['menu'][$i]){
                                        ?>
                                        <?= $jedlo['menu'][$i]; ?> <br>
                                        <?php
                                    }
                                }
                                ?> </td>  <?php
                        }
                    }
                }
                ?> </tr> <?php

            }

            ?>
             </div>


            <div class="restaurant3">
                <?php
                if($den == "tyzden"){  ?>

                    <tr>
                        <td>Free Food</td>
                        <?php

                        foreach ($jedla3 as $jedlo3) {

                            if($jedlo3['menu']){
                               // var_dump(count($jedlo3['menu'])); ?>
                                <td>  <?php
                                for($i = 0;  $i < sizeof($jedlo3['menu']); $i++){
                                    if($jedlo3['menu'][$i]){
                                ?>
                                    <?= $jedlo3['menu'][$i]; ?> <br>
                                <?php
                                    }
                                }
                               ?> </td>  <?php
                            }
                        }
                        ?> </tr> <?php
                }else{
                    ?>

                    <tr>
                        <td>Free Food</td>
                        <?php

                        foreach ($jedla3 as $jedlo3) {
                            if($den == "Štvrtok"){
                                $den = "štvrtok";
                            }else{
                                $den = strtolower($den);
                            }
                            if($jedlo3['day'] == $den ){

                                if($jedlo3['menu']){
                                    //var_dump(count($food['menu'])); ?>
                                    <td>  <?php
                                        for($i = 0;  $i < sizeof($jedlo3['menu']); $i++){
                                            if($jedlo3['menu'][$i]){
                                                ?>
                                                <?= $jedlo3['menu'][$i]; ?> <br>
                                                <?php
                                            }
                                        }
                                        ?> </td>  <?php
                                }
                            }
                        }
                        ?> </tr> <?php

                }

                ?>
            </div>


            </tbody>
        </table>
    </div>



</div>

</body>
</html>






