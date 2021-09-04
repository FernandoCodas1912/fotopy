<?php
header('Content-Type: application/json');

$pdo = new PDO("mysql:dbname=calendarioweb;host=127.0.0.1", "root", "12345678");


$accion=(isset($_GET['accion']))?$_GET['accion']:'leer';

switch ($accion) {
    case 'agregar':
        // Intruccion de agregado
        
        $senteciaSQL = $pdo->prepare("INSERT INTO eventos (title,descripcion,color,textColor,start,end) VALUES(:title,:descripcion,:color,:textColor,:start,:end)");

        $respuesta = $senteciaSQL->execute(array(
            "title" => $_POST['title'],
            "descripcion" => $_POST['descripcion'],
            "color" => $_POST['color'],
            "textColor" => $_POST['textColor'],
            "start" => $_POST['start'],
            "end" => $_POST['end']
        ));

        echo json_encode($respuesta);

        break;
    
    case 'eliminar':
        // Instruccion de eliminar
        $respuesta = false;

        if(isset($_POST['id'])){
            $senteciaSQL = $pdo->prepare("DELETE FROM eventos WHERE ID=:ID");
            $respuesta = $senteciaSQL->execute(array("ID"=>$_POST['id']));            
        }

        echo json_encode($respuesta);


        break;

    case 'modificar':
        // Instruccion de modificar
        $senteciaSQL = $pdo->prepare("UPDATE eventos SET
        title=:title,
        descripcion=:descripcion,
        color=:color,
        textColor=:textColor,
        start=:start,
        end=:end
        WHERE ID=:ID 
        ");

        $respuesta=$senteciaSQL->execute(array(
            "ID"=>$_POST['id'],
            "title"=>$_POST['title'],
            "descripcion"=>$_POST['descripcion'],
            "color"=>$_POST['color'],
            "textColor"=>$_POST['textColor'],
            "start"=>$_POST['start'],
            "end"=>$_POST['end']
        ));

        echo json_encode($respuesta);

        break;
    
    default:
        // Seleccionar los eventos del calendario
        $senteciaSQL = $pdo->prepare("SELECT * FROM eventos");
        $senteciaSQL->execute();


        $resultado = $senteciaSQL->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;
}






?>