<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>countries</title>
</head>
<body>
<table border="1px">
	<tr>
		<th>country</th>
		<th>city</th>
		
	</tr>

    <!-- php script to get data -->
	<?php 
    require "helpers/helper.php";
    use enozom\helpers\index\DataBase;

    
    
    $model=new DataBase('enozom');

    //used for pagination
if(isset($_GET['pagenext']))
{


    $pagenext=$_GET['pagenext'];
    $pageprev=$pagenext;
    $start=$pagenext*50;
    
   

}
elseif(isset($_GET['pageprev']))
{


    $pageprev=$_GET['pageprev'];
    if($pageprev <0)
    {
    $pagenext=1;
    $start=0*50;
    }
    
   

}
else{
    $pagenext=0;
    $pageprev=0;
   
    $start=0;
    
}
//end of the condition
   
    $result=$model->selectFromTabel('maintabel',$start);

    
    
    
    while ($row=$result->fetch_assoc()): ?>
    <!-- show data from database in tabel-->
	<tr>
		<td><?php echo $row['country']; ?></td>
		<td><?php echo $row['city']; ?></td>
		
	</tr>
	<?php endwhile; ?>
    </tabel>
    <!--script for pagination-->
    <?php
   $pageprev-=1;
   
   echo  "<a style='margin:5px'href=index.php?pageprev=".$pageprev.">Previous"."</a>";
   ?>
 
   <?php
   $pagenext+=1;
   
   echo  "<a style='margin:5px' href=index.php?pagenext=".$pagenext.">next"."</a>";
   ?>
  
   <button> <a href="population.php">page to get country population</a></button>
    
</body>
</html>
