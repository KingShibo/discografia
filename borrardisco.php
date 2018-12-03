<?php
    if($_GET){
        $disco=$_GET['disco'];
        $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'root', '');
        $consulta=$discografia->prepare("SELECT * FROM cancion WHERE Album=?");
            $consulta->bindParam(1,$disco);
    }
?>