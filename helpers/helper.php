<?php
namespace enozom\helpers\index;

class Route{
    protected $url;
    protected $method;
    protected $dataField;

 
    function __construct($url,$method,$dataField=[])
    {
        $this->url=$url;
        $this->method=$method;
        $this->dataField=$dataField;
    }
    function getData()
    {
        //get Data with post request
        if($this->method==="POST")
        {
            $ch=curl_init();
            curl_setopt($ch,CURLOPT_URL,$this->url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$this->dataField);
            $output=curl_exec($ch);
            curl_close($ch);
        return $output;
        }
        //get data from Get request
        elseif($this->method==='GET'){
            $this->url=sprintf("%s?%s",$this->url,http_build_query($this->dataField));
            $ch=curl_init();
            curl_setopt($ch,CURLOPT_URL,$this->url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            $output=curl_exec($ch);
            
            return json_decode($output)->data;
        }

        else{
            return 'undefined method';
        }
    }

    

}


############## database#########

class DataBase
{
    protected $conn;
    
    function __construct($db_name)
    {
        $this->conn=mysqli_connect("localhost","root","",$db_name);
    }

    //insert data to main table
    function insertToMain($country,$city)
    {
        $check_query="select * from maintabel where country='$country' and city='$city'";
        if(mysqli_query($this->conn,$check_query))
        {
        $sql_query="insert into  maintabel(country,city) values('$country','$city')";
        if(mysqli_query($this->conn,$sql_query))
        {
            return 1;
        }
        else{
            return false;
        }
    }
    else
    {
        return false;
    }  
    }

    //insert to population tabel
    function insertToPopulation($country,$city,$year,$value,$sex,$reliability)
    {
        $maintabel_query="select id from maintabel where country='$country' and city='$city' limit 1";
        $result=mysqli_query($this->conn,$maintabel_query);
      
         if($result->num_rows > 0)
        {
     while($row=$result->fetch_assoc())
     {
        $id=$row['id'];
        $sql_query="insert into  population(year,value,sex,reliabilty,maintabel_id) values('$year','$value','$sex','$reliability',$id)";
        mysqli_query($this->conn,$sql_query);
             
     }
     }  
    }

    //select countries 
    function selectFromTabel($tabel,$start)
    {
        
        $sql_query="select * from $tabel limit $start,50";
        
        $result=mysqli_query($this->conn,$sql_query);
      

       return $result;

    } 


}