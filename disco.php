<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Informacion Disco</title>
        <style>
            body{
                margin-left: 5%;
            }
            table{
                margin-top: 1%;
            }
            th{
                background-color: lightgray;
                padding: 3px 3px 1px 1px;
                text-align: center;
                width: 30px;
            }
            td{
                padding: 2%;
                text-align: center;
                width: 30px;
            }
            div{
                border: 1px solid black;
                width: 15%;
                margin-top: 20px;
                padding: 1%;
            }
            h1{
                margin: 0;
            }
        </style>
    </head>
    <body>
       
        <?php
        if($_GET){
            $disco=$_GET['disco'];
            $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'root', '');
            $consulta=$discografia->prepare("SELECT * FROM album WHERE Codigo=?");
            $consulta->bindParam(1,$disco);
            $consulta->execute();
            $resultado=$consulta->fetch();
            echo '<div><h1>Disco</h1>Titulo:<b> '.$resultado['Titulo'].'</b><br> Discografica:'.$resultado['Discografica'].'<br>Formato:'
                .$resultado['Formato'].'<br>Fecha de lanzamiento: '.$resultado['FechaLanzamiento'] .'<br>Fecha de compra: '.$resultado['FechaCompra']. '<br>Precio:'.$resultado['Precio'].'</div>';
            $consulta=$discografia->prepare("SELECT * FROM cancion WHERE Album=?");
            $consulta->bindParam(1,$disco);
            $consulta->execute();
                echo '<table>';
                echo '<tr><th>Titulo</th>';
                echo '<th>Posicion</th>';
                echo '<th>Duracion</th>';
                echo '<th>Genero</th></tr>';
                while($resultado=$consulta->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr><td>'.$resultado['Titulo'].'</td>';
                    echo '<td>'.$resultado['Posicion'].'</td>';
                    echo '<td>'.$resultado['Duracion'].'</td>';
                    echo '<td>'.$resultado['Album'].'</td>';
                }
                echo '</table>';
        }

        ?>
        <a href="borrardisco.php?disco=<?php echo $disco?>">Borrar Disco</a>
    </body>
</html>