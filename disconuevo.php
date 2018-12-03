<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Crear un Disco</title>
        <?php
        $titulo=$discografica=$formato="";
        $errorTitulo=$errorDiscografica="";
        $fechaLan=$fechaCom=$precio=null;
        $error=false;
        if($_POST){
            if(empty($_POST["titulo"])){
                $errorTitulo=true;
                $error=true;
            }else{
                $titulo = $_POST["titulo"];
                if(!preg_match("/^[a-zA-Z ]*$/",$titulo)){
                    $errorTitulo=true;
                    $error=true;
                }
            }
            if(empty($_POST["discografica"])){
                $errorDiscografica=true;
                $error=true;
            }else{
                $discografica = $_POST["discografica"];
                if(!preg_match("/^[a-zA-Z ]*$/",$discografica)) {
                    $errorDiscografia=true;
                    $error=true;
                }
            }
            $formato=$_POST["formato"];
            if(empty(!$_POST["fechaLanza"])){
                $fechaLan=$_POST["fechaLanza"];
            }
            if(empty(!$_POST["fechaCom"])){
                $fechaCom=$_POST["fechaCom"];
            }
            if(empty(!$_POST["precio"])){
                $precio=$_POST["precio"];
            }
            if($error==false){
                try {
                    $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'root', '');
                    $stmt=$discografia->prepare("INSERT INTO album (Titulo,Discografica,Formato,FechaLanzamiento,FechaCompra,Precio) VALUES(?,?,?,?,?,?)");
                    $stmt->bindParam(1,$titulo);
                    $stmt->bindParam(2,$discografica);
                    $stmt->bindParam(3,$formato);
                    $stmt->bindParam(4,$fechaLan);
                    $stmt->bindParam(5,$fechaCom);
                    $stmt->bindParam(6,$precio);
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
        <h1>Añadir Disco</h1>
        <form action="#" method="post">
            <label for="titulo">Titulo: </label><input type="text" name="titulo" id="titulo" value="<?php echo $titulo; ?>"><br>
            <label for="discografia">Discografica: </label><input type="text" name="discografica" id="discografica" value="<?php echo $discografica; ?>"><br>
            <label for="formato">Formato: </label>
            <select name="formato">
                <option value="Vinilo">Vinilo</option>
                <option value="CD" selected>CD</option>
                <option value="DVD">DVD</option>
                <option value="mp3">MP3</option>

            </select><br>
            <label for="fechaLanza">Fecha de Lanzamiento: </label><input type="date" name="fechaLanza" id="fechaLanza"><br>
            <label for="fechaCom">Fecha de Compra: </label><input type="date" name="fechaCom" id="fechaCom"><br>
            <label for="precio">Precio: </label><input type="number" step="0.01" name="precio" id="precio"><br>
            <button type="submit">Crear Disco</button>
        </form>

    </body>
</html>