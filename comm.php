<?php
    include('connection.php');  
    include('connect2.php');
    $name = $_POST['idprod'];  
    $sql = "select * from produit where idprod = '$name' ";
    $result = mysqli_query($con, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  
      
    if($count != 0){  
        $idprod="select idprod from produit where idprod = '$name'";
        $result = mysqli_query($con, $sql);  
        $prix="select prix from produit where idprod = '$name'";
        $result = mysqli_query($con, $sql);  
        /* here i will use the user mail as an id qui se trouve dans connect2.php */ 
        
     $sql="insert into commande values ('0','$idclient',$idprod','$prix')"   
     $result = mysqli_query($con, $sql);  

    }  
    else{  echo("stock insufisante");
    }
        







?>