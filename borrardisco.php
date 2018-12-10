<?php
/**codigo para borrar disco **/
/**Comentario desde github**/
if($_GET){
    try{
        $disco=$_GET['disco'];
        $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'root', '');
        $consulta=$discografia->prepare("DELETE FROM cancion WHERE Album=?");
        $consulta->bindParam(1,$disco);
        if(!$consulta->execute())
            throw new Exception('Error al eliminar canciones');

        $consulta=$discografia->prepare("DELETE FROM  album WHERE Codigo=?");
        $consulta->bindParam(1,$disco);
        if(!$consulta->execute())
            throw new Exception('Error al eliminar Album');
    }catch (PDOException $e){
        echo 'Falló la conexión: ' . $e->getMessage();
        header('Location: disco.php?disco='.$disco);
    }catch (Exception $e){
        echo 'Falló en Consulta: ' . $e->getMessage();
        header('Location: disco.php?disco='.$disco);
    }
    header('Location: index.php');
}
?>
