<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Buscador Canciones</title>
        <style>
            table{
                margin-top: 1%;
                margin-left: 1%;
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
        </style>
    </head>
    <body>
        <h1>Buscar Cancion</h1>
        <form action="#" method="post">
            Texto a buscar:<input type="text" name="buscar" id="buscar"><br>
            Buscar en: <input type="radio" name="forma" value="cancion" checked>
            Titulo de Cancion <input type="radio" name="forma" value="album" >
            Nombre de álbum <input type="radio" name="forma" value="ambos">Ambos campos<br>
            Género Musical:
            <select name="genero">
            <?php
            $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'root', '');
            $consulta=$discografia->query("SHOW COLUMNS FROM cancion Like 'Genero'");
            $resultado=$consulta->fetch();
            $generos=$resultado['Type'];
            $genero= explode(',',$generos);
            $genero=str_replace("enum(","",$genero);
            $genero= str_replace(")","",$genero);
            $genero= str_replace("'","",$genero);
            foreach($genero as $value){
                echo '<option value="'.$value.'">'.$value.'</option>';
            }
            ?>
            </select><br>
            <button type="submit">Buscar Cancion</button>
        </form>
        
        <?php
            if($_POST){
                $textoTitulo='';
                $textoAlbum='';
                $genero=$_POST['genero'];
                if($_POST['forma']=='cancion'){
                    $textoTitulo=$_POST['buscar'];
                }else if($_POST['forma']=='album'){
                    $textoAlbum=$_POST['buscar'];
                }else{
                    $textoTitulo=$_POST['buscar'];
                    $textoAlbum=$_POST['buscar'];
                }
                $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'root', '');
                $consulta=$discografia->prepare("SELECT DISTINCT C.Titulo,A.Titulo as Album,C.Posicion,C.Duracion,C.Genero FROM cancion C,album A WHERE C.Genero=? AND A.Codigo=C.Album AND C.Titulo=? || A.Titulo=?");
                $consulta->bindParam(1,$genero);
                $consulta->bindParam(2,$textoTitulo);
                $consulta->bindParam(3,$textoAlbum);
                $consulta->execute();
                echo '<table>';
                echo '<tr><th>Titulo</th>';
                echo '<th>Album</th>';
                echo '<th>Posicion</th>';
                echo '<th>Duracion</th>';
                echo '<th>Genero</th></tr>';
                while($resultado=$consulta->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr><td>'.$resultado['Titulo'].'</td>';
                    echo '<td>'.$resultado['Album'].'</td>';
                    echo '<td>'.$resultado['Posicion'].'</td>';
                    echo '<td>'.$resultado['Duracion'].'</td>';
                    echo '<td>'.$resultado['Album'].'</td>';
                }
                echo '</table>';
            }
        ?>
        
    </body>
</html>