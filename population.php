
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>population</title>
</head>
<body>
    <form action="population.php" method="GET">

    <input type="text" name="country">
    <button type="submit">Get populations</button>
    </form>
</body>
</html>
<?php
   require "helpers/helper.php";
   use enozom\helpers\index\DataBase;
$model=new DataBase('enozom');

if(isset($_GET['country'])){
    $country=$_GET['country'];
}
else{
    $country='none';
}



$populations=$model->selectPopulation($country);
$total=0;
$total_population=[];




 foreach($populations as $key=>$population)
{
    
    
    
    echo $key."=>".$population.'<br>';
   
   
} 
?>