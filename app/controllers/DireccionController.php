PHP

<?php
// En DireccionController.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/apple5a/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/apple5a/app/models/Direccion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/apple5a/app/models/Persona.php'; // Si necesitas listar personas en el formulario

class DireccionController {
    private $direccion;
    private $persona; // Para obtener la lista de personas (si es necesario en la vista)
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->direccion = new Direccion($this->db);
        $this->persona = new Persona($this->db); // Inicializa el modelo Persona
    }

    // Mostrar todas las direcciones
    public function index() {
        $direcciones = $this->direccion->read();
        require_once '../app/views/direccion/index.php';
    }

    // Mostrar el formulario de creación de dirección
    public function createForm() {
        $personas = $this->persona->read(); // Obtener la lista de personas para el select
        require_once '../app/views/direccion/create.php';
    }

    // Procesar la creación de una nueva dirección
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                isset($_POST['idpersona']) &&
                isset($_POST['nombre'])
            ) {
                $this->direccion->idpersona = $_POST['idpersona'];
                $this->direccion->nombre = $_POST['nombre'];

                if ($this->direccion->create()) {
                    header('Location: index.php?msg=created');
                    exit;
                } else {
                    $error = "Error al crear la dirección.";
                    $personas = $this->persona->read();
                    require_once '../app/views/direccion/create.php'; // Pasar error y lista de personas
                    exit;
                }
            } else {
                $error = "Faltan datos en el formulario.";
                $personas = $this->persona->read();
                require_once '../app/views/direccion/create.php'; // Pasar error y lista de personas
                exit;
            }
        } else {
            header('Location: index.php'); // Redirigir si no es POST
            exit;
        }
    }

    // Mostrar el formulario de edición de dirección
    public function editForm($iddireccion) {
        $this->direccion->iddireccion = $iddireccion;
        $direccion = $this->direccion->readOne();
        $personas = $this->persona->read(); // Obtener la lista de personas para el select

        if (!$direccion) {
            die("Error: No se encontró la dirección.");
        }

        require_once '../app/views/direccion/edit.php';
    }

    // Procesar la actualización de una dirección
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                isset($_POST['iddireccion']) &&
                isset($_POST['idpersona']) &&
                isset($_POST['nombre'])
            ) {
                $this->direccion->iddireccion = $_POST['iddireccion'];
                $this->direccion->idpersona = $_POST['idpersona'];
                $this->direccion->nombre = $_POST['nombre'];

                if ($this->direccion->update()) {
                    header('Location: index.php?msg=updated');
                    exit;
                } else {
                    $error = "Error al actualizar la dirección.";
                    $this->editForm($_POST['iddireccion']); // Volver al formulario con error
                    exit;
                }
            } else {
                $error = "Faltan datos en el formulario de actualización.";
                $this->editForm($_POST['iddireccion']); // Volver al formulario con error
                exit;
            }
        } else {
            header('Location: index.php'); // Redirigir si no es POST
            exit;
        }
    }

    // Mostrar la confirmación de eliminación de dirección
    public function deleteForm($iddireccion) {
        $this->direccion->iddireccion = $iddireccion;
        $direccion = $this->direccion->readOne();

        if (!$direccion) {
            die("Error: No se encontró la dirección.");
        }

        require_once '../app/views/direccion/delete.php';
    }

    // Procesar la eliminación de una dirección
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['iddireccion'])) {
                $this->direccion->iddireccion = $_POST['iddireccion'];
                if ($this->direccion->delete()) {
                    header('Location: index.php?msg=deleted');
                    exit;
                } else {
                    header('Location: index.php?msg=error_delete');
                    exit;
                }
            } else {
                header('Location: index.php?msg=no_id_delete');
                exit;
            }
        } else {
            header('Location: index.php'); // Redirigir si no es POST
            exit;
        }
    }
}

// Manejo de la acción en la URL
if (isset($_GET['action'])) {
    $controller = new DireccionController();
    $action = $_GET['action'];

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } elseif (isset($_POST['iddireccion'])) {
        $id = $_POST['iddireccion'];
    } else {
        $id = null;
    }

    switch ($action) {
        case 'index':
            $controller->index();
            break;
        case 'createForm':
            $controller->createForm();
            break;
        case 'create':
            $controller->create();
            break;
        case 'editForm':
            if ($id !== null) {
                $controller->editForm($id);
            } else {
                echo "Error: ID de dirección no especificado para editar.";
            }
            break;
        case 'update':
            $controller->update();
            break;
        case 'deleteForm':
            if ($id !== null) {
                $controller->deleteForm($id);
            } else {
                echo "Error: ID de dirección no especificado para eliminar.";
            }
            break;
        case 'delete':
            $controller->delete();
            break;
        default:
            echo "Acción no válida.";
            break;
    }
} else {
  // $controller = new DireccionController();
   // $controller->index(); // Acción por defecto
}
?>
