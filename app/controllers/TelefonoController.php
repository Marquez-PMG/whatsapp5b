<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// En TelefonoController.php
require_once $_SERVER['DOCUMENT_ROOT'] . '/apple5a/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/apple5a/app/models/Telefono.php';

class TelefonoController {
    private $telefono;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->telefono = new Telefono($this->db);
    }

    // Mostrar todos los teléfonos
    public function index() {
        $telefonos = $this->telefono->read();
        require_once '../app/views/telefono/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Formulario recibido";
            if (isset($_POST['numero'])) {
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

    public function edit($id) {
        $this->telefono->id = $id;
        $telefono = $this->telefono->readOne();

        if (!$telefono) {
            die("Error: No se encontró el registro.");
        }

        require_once '../app/views/telefono/edit.php';
    }

    public function eliminar($id) {
        $this->telefono->id = $id;
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
                $this->telefono->numero = $_POST['numero'];
                $this->telefono->id = $_POST['id'];
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
}

// Manejo de la acción en la URL
if (isset($_GET['action'])) {
    $controller = new TelefonoController();

    echo "hola";
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
 //  echo "No se especificó ninguna acción.";
}
?>