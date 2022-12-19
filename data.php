<?php
require "helpers/helper.php";

use enozom\helpers\index\Route;
use enozom\helpers\index\DataBase;
//$data=file_get_contents('https://countriesnow.space/api/v0.1/countries/population/cities');

$route=new Route('https://countriesnow.space/api/v0.1/countries/population/cities','GET');
$model=new DataBase('enozom');

 $data=$route->getData();
 


 foreach($data as $key=>$item)
{
$result=$model->insertToMain($item->country,$item->city);
foreach($item->populationCounts as $population)
{
    $model->insertToPopulation($item->country,$item->city,$population->year,$population->value,$population->sex,$population->reliabilty);   
 

}

}
