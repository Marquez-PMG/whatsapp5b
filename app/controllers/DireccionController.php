<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// En DireccionController.php
require_once $_SERVER['DOCUMENT_ROOT'] . '/whatsapp5b/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/whatsapp5b/app/models/Direccion.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/whatsapp5b/app/models/Persona.php';
class DireccionController {
    private $direccion;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->direccion = new Direccion($this->db);
        $this->persona = new Persona($this->db);
    }

    // Mostrar todos los teléfonos
    public function index() {
        $direccions = $this->direccion->read1();
        require_once '../app/views/direccion/index.php';
    }


    public function createForm() {


        $personas = $this->persona->read();
        require_once '../app/views/direccion/create.php';
    }





    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Formulario recibido";
            if (isset($_POST['nombre'])) {
                $this->direccion->idpersona = $_POST['idpersona'];
                $this->direccion->nombre = $_POST['nombre'];
                if ($this->direccion->create()) {
                    echo "Teléfono creado exitosamente";
                } else {
                    echo "Error al crear el teléfono";
                }
            } else {
                echo "Faltan datos";
            }
        } else {
            echo "Método incorrecto";
        }
        die();
    }

    public function edit($iddireccion) {
        $this->direccion->iddireccion = $iddireccion;
        $direccion = $this->direccion->readOne();
        $personas = $this->persona->read();

        if (!$direccion) {
            die("Error: No se encontró el registro.");
        }

        require_once '../app/views/direccion/edit.php';
    }

    public function eliminar($id) {
        $this->direccion->iddireccion = $iddireccion;
        $direccion = $this->direccion->readOne();

        if (!$direccion) {
            die("Error: No se encontró el registro.");
        }

        require_once '../app/views/direccion/delete.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Formulario recibido";
            if (isset($_POST['nombre'])) {
                $this->direccion->idpersona = $_POST['idpersona'];
                $this->direccion->nombre = $_POST['nombre'];
                $this->direccion->iddireccion = $_POST['iddireccion'];
                if ($this->direccion->update()) {
                    echo "Teléfono actualizado exitosamente";
                } else {
                    echo "Error al actualizar el teléfono";
                }
            } else {
                echo "Faltan datos";
            }
        } else {
            echo "Método incorrecto";
        }
        die();
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id'])) {
                $this->direccion->id = $_POST['id'];
                if ($this->direccion->delete()) {
                    echo "Teléfono borrado exitosamente";
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
            echo "Método incorrecto";
        }
        die();
    }

    public function api() {

        while (ob_get_level()) {
            ob_end_clean();
        }

        $direcciones = $this->direccion->getAll();
        header('Content-Type: application/json');
        echo json_encode($direcciones);
        exit;
    }
}

// Manejo de la acción en la URL
if (isset($_GET['action'])) {
    $controller = new DireccionController();

    echo "hola";
    switch ($_GET['action']) {
        case 'createForm':
            $controller->createForm();
            break;
 
        case 'create':
            $controller->create();
            break;
        case 'update':
            $controller->update();
            break;
        case 'delete':
            $controller->delete();
            break;
        case 'api':
            $controller->api();
            break;
        default:
            echo "Acción no válida.";
            break;
    }
} else {
 //  echo "No se especificó ninguna acción.";
}
?>
