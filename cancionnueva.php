<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Nuevas Canciones</title>
        <style>
            label{
                margin: 15px;
            }
            input{
                margin-top: 15px;

            }
            select{
                margin-top: 15px;
            }
        </style>
        <?php
        $titulo=$album="";
        $errorTitulo=$errorAlbum="";
        $posicion=$duracion=$genero=null;
        $error=false;
        if($_POST){
            if(empty($_POST["titulo"])){
                $errorTitulo="No has escrito el titulo";
                $error=true;
            }else{
                $titulo = $_POST["titulo"];
                if(!preg_match("/^[a-zA-Z ]*$/",$titulo)){
                    
                    echo $error;    
                    $errorTitulo="No se admiten caracteres especiales";
                    $error=true;
                }
            }
            if(empty($_POST["album"])){
                $errorAlbum=true;
                $error=true;
            }else{
                $album=$_POST['album'];
            }
            if(empty(!$_POST["posicion"])){
                $posicion=$_POST["posicion"];
            }
            if(empty(!$_POST["duracion"])){
                $duracion=$_POST["duracion"];
            }
            if($_POST["genero"]!=""){
                $genero=$_POST["genero"];
            }
            if($error==false){
                try {
                    $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'root', '');
                    $stmt=$discografia->prepare("INSERT INTO cancion (Titulo,Album,Posicion,Duracion,Genero) VALUES(?,?,?,?,?)");
                    $stmt->bindParam(1,$titulo);
                    $stmt->bindParam(2,$album);
                    $stmt->bindParam(3,$posicion);
                    $stmt->bindParam(4,$duracion);
                    $stmt->bindParam(5,$genero);
                    if(!$stmt->execute())
                        throw new Exception('Error insertar',1);

                } catch (PDOException $e) {
                    echo 'Falló la conexión: ' . $e->getMessage();
                } catch (Exception $e) {
                    echo 'Falló en Consulta ' . $e->getMessage();
                }

            }
        }
        ?>
    </head>
    <body>
        <h1>Crear Cancion</h1>
        <form action="#" method="post">
        <label for="titulo">Titulo: </label><input type="text" name="titulo" id="titulo"><br>
            <label for="album">Album: </label>
            <select name="album">
                <?php
                $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'root', '');
                $consulta=$discografia->query("SELECT * FROM album");
                while($resultado=$consulta->fetch(PDO::FETCH_ASSOC)){
                    echo '<option value="'.$resultado['Codigo'].'">'.$resultado['Titulo'].'</option>';

                }
                ?>

            </select><br>
            <label for="posicion">Posicion: </label><input type="number" name="posicion" id="posicion"><br>
            <label for="duracion">Duracion: </label><input type="time" name="duracion" id="duracion" step="1" max="360"><br>
            <label for="genero">Genero: </label>
            <select name="genero">
                <option value=""></option>
                <option value="Acustica">Acustica</option>
                <option value="BSO">BSO</option>
                <option value="Blues">Blues</option>
                <option value="Folk">Folk</option>
                <option value="Jazz">Jazz</option>
                <option value="New age">New age</option>
                <option value="Pop">Pop</option>
                <option value="Rock">Rock</option>
                <option value="Electronica">Electronica</option>
            </select><br><br>
            <button type="submit">Crear Cancion</button>
        </form>
    </body>
</html>