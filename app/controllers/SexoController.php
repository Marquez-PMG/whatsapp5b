
<!DOCTYPE html>
<?php
// MEJORAS EN VISUAL CODE
ini_set('display_errors', 1);
error_reporting(E_ALL);
// En SexoController.php
require_once $_SERVER['DOCUMENT_ROOT'] . '/apple5a/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/apple5a/app/models/Sexo.php';



class SexoController {
    private $sexo;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->sexo = new Sexo($this->db);
    }

    // Mostrar todos los sexos
    public function index() {
        $sexos = $this->sexo->read();
        require_once '../app/views/sexo/index.php';
    }



public function create() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "Formulario recibido";  // Verificar si llega el formulario
        if (isset($_POST['nombre'])) {
            $this->sexo->nombre = $_POST['nombre'];
            if ($this->sexo->create()) {
                echo "Sexo creado exitosamente";
                // Redirigir o mostrar un mensaje de éxito
            } else {
                echo "Error al crear el sexo";
            }
        } else {
            echo "Faltan datos";
        }
    } else {
        echo "Método incorrecto";  // Verificar que el formulario no se envíe con GET
    }
    die();  // Detener la ejecución para ver los mensajes
}


public function edit($idsexo) {

// Pasar el ID al modelo antes de llamar a readOne()
        $this->sexo->idsexo = $idsexo;
        $sexo = $this->sexo->readOne();

        if (!$sexo) {
            die("Error: No se encontró el registro.");
        }

    require_once '../app/views/sexo/edit.php';
}



public function eliminar($idsexo) {

// Pasar el ID al modelo antes de llamar a readOne()
        $this->sexo->idsexo = $idsexo;
        $sexo = $this->sexo->readOne();

        if (!$sexo) {
            die("Error: No se encontró el registro.");
        }

    require_once '../app/views/sexo/delete.php';
}







public function update() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "Formulario recibido";  // Verificar si llega el formulario
        if (isset($_POST['nombre'])) {
            $this->sexo->nombre = $_POST['nombre'];
            $this->sexo->idsexo = $_POST['idsexo'];
            if ($this->sexo->update()) {
                echo "Sexo actualizado exitosamente";
                // Redirigir o mostrar un mensaje de éxito
            } else {
                echo "Error al crear el sexo";
            }
        } else {
            echo "Faltan datos";
        }
    } else {
        echo "Método incorrecto";  // Verificar que el formulario no se envíe con GET
    }
    die();  // Detener la ejecución para ver los mensajes
}








    // Eliminar un sexo
    public function delete() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['id'])) {
            $this->sexo->id = $_POST['id'];
        if ($this->sexo->delete()) {
                echo "Sexo borrado exitosamente";
		die();
            header('Location: index.php?msg=deleted');
            exit;
        } else {
            header('Location: index.php?msg=error');
            exit;
        }
} else {
            echo "Faltan datos";
        }
    } else {
        echo "Método incorrecto";  // Verificar que el formulario no se envíe con GET
    }
    die();  // Detener la ejecución para ver los mensajes

}
}

/// Manejo de la acción en la URL
if (isset($_GET['action'])) {
    $controller = new SexoController();

    switch ($_GET['action']) {
        case 'create':
            $controller->create();
            break;
         case 'update':

            $controller->update();
            break;
         case 'delete':

            $controller->delete();
            break;





        default:
            echo "Acción no válida.";
            break;
    }
} else {
//    echo "No se especificó ninguna acción.";
}



?>
