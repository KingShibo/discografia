<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Discos</title>
        <style>
            table{
                margin: 30px auto auto;
                border: 1px solid black;
                border-collapse: collapse;
            }
            td{
                text-align: center;
                padding: 2px;
                border: 1px solid black;
            }
            div{
                text-align: center;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <td>Titulo</td>
                <td>Discografica</td>
                <td>Formato</td>
                <td>Fecha de Lanzamiento</td>
                <td>Fecha de Compra</td>
                <td>Precio</td>
            </tr>
            <?php
            $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'root', '');
            $consulta=$discografia->query("SELECT * FROM album");
            while($resultado=$consulta->fetch(PDO::FETCH_ASSOC)){
                echo '<tr><td><a href="disco.php?disco='.$resultado['Codigo'].'">'
                    .$resultado['Titulo'].'</td>';
                echo '<td>'.$resultado['Discografica'].'</td>';
                echo '<td>'.$resultado['Formato'].'</td>';
                echo '<td>'.$resultado['FechaLanzamiento'].'</td>';
                echo '<td>'.$resultado['FechaCompra'].'</td>';
                echo '<td>'.$resultado['Precio'].'</td></tr>';
            }
            ?>

        </table>
        <div>
            <a href="cancionnueva.php">Crear Una Cancion</a>
        </div>
    </body>
</html>