<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// En TelefonoController.php
require_once $_SERVER['DOCUMENT_ROOT'] . '/whatsapp5b/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/whatsapp5b/app/models/Telefono.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/whatsapp5b/app/models/Persona.php';
class TelefonoController {
    private $telefono;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->telefono = new Telefono($this->db);
        $this->persona = new Persona($this->db);
    }

    // Mostrar todos los teléfonos
    public function index() {
        $telefonos = $this->telefono->read1();
        require_once '../app/views/telefono/index.php';
    }


    public function createForm() {


        $personas = $this->persona->read();
        require_once '../app/views/telefono/create.php';
    }





    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Formulario recibido";
            if (isset($_POST['numero'])) {
                $this->telefono->idpersona = $_POST['idpersona'];
                $this->telefono->numero = $_POST['numero'];
                if ($this->telefono->create()) {
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

    public function edit($idtelefono) {
        $this->telefono->idtelefono = $idtelefono;
        $telefono = $this->telefono->readOne();
        $personas = $this->persona->read();

        if (!$telefono) {
            die("Error: No se encontró el registro.");
        }

        require_once '../app/views/telefono/edit.php';
    }

    public function eliminar($id) {
        $this->telefono->idtelefono = $idtelefono;
        $telefono = $this->telefono->readOne();

        if (!$telefono) {
            die("Error: No se encontró el registro.");
        }

        require_once '../app/views/telefono/delete.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Formulario recibido";
            if (isset($_POST['numero'])) {
                $this->telefono->idpersona = $_POST['idpersona'];
                $this->telefono->numero = $_POST['numero'];
                $this->telefono->idtelefono = $_POST['idtelefono'];
                if ($this->telefono->update()) {
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
                $this->telefono->id = $_POST['id'];
                if ($this->telefono->delete()) {
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
        $telefonos = $this->telefono->getAll();
        header('Content-Type: application/json');
        echo json_encode($telefonos);
        exit;
    }









}

// Manejo de la acción en la URL
if (isset($_GET['action'])) {
    $controller = new TelefonoController();

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
