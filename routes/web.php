<?php
session_start();

// Incluir los controladores necesarios
require_once '../app/controllers/PersonaController.php';
require_once '../app/controllers/SexoController.php';
require_once '../app/controllers/DireccionController.php';
require_once '../app/controllers/TelefonoController.php';
require_once '../app/controllers/EstadocivilController.php';

$requestUri = $_SERVER["REQUEST_URI"];
$basePath = '/apple6b/public/';
// Remover el prefijo basePath
$route = str_replace($basePath, '', $requestUri);
$route = strtok($route, '?'); // Quitar parámetros GET
 
// Mostrar el menú si no se ha solicitado ninguna acción específica
if (empty($route) || $route === '/') {
    echo "<h1>Menú de Tablas</h1>";
    echo "<ul>";
    echo "<li><a href='" . $basePath . "persona/index'>Personas</a></li>";
    echo "<li><a href='" . $basePath . "sexo/index'>Sexos</a></li>";
    echo "<li><a href='" . $basePath . "direccion/index'>Direcciones</a></li>";
    echo "<li><a href='" . $basePath . "telefono/index'>Teléfonos</a></li>";
    echo "<li><a href='" . $basePath . "estadocivil/index'>Estados Civiles</a></li>";
    echo "</ul>";
} else {
    // Enrutar a los controladores según la ruta
    switch ($route) {
        case 'persona':
        case 'persona/index':
            $controller = new PersonaController();
            $controller->index();
            break;
        case 'persona/create':
            $controller = new PersonaController();
            $controller->createForm();
            break;




        case 'sexo':
        case 'sexo/index':
            $controller = new SexoController();
            $controller->index();
            break;
        case 'sexo/edit':
            if (isset($_GET['idsexo'])) {
                $controller = new SexoController();
                $controller->edit($_GET['idsexo']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;
        case 'sexo/eliminar':
            if (isset($_GET['idsexo'])) {
                $controller = new SexoController();
                $controller->eliminar($_GET['idsexo']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;
        case 'sexo/delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new SexoController();
                $controller->delete();
            }
            break;
        case 'sexo/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new SexoController();
                $controller->update();
            }
            break;
        case 'direccion':
        case 'direccion/index':
            $controller = new DireccionController();
            $controller->index();
            break;
        case 'telefono':
        case 'telefono/index':
            $controller = new TelefonoController();
            $controller->index();
            break;
        case 'estadocivil':
        case 'estadocivil/index':
            $controller = new EstadoCivilController();
            $controller->index();
            break;
        case 'estadocivil/edit':
                if (isset($_GET['idestadocivil'])) {
                    
                    $controller = new EstadocivilController();
                    $controller->edit($_GET['idestadocivil']);
                } else {
                    echo "Error: Falta el ID para editar.";
                }
                break;
                case 'estadocivil/update':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $controller = new EstadocivilController();
                        $controller->update();
                    }
                    break;
        default:
            echo "Error 404: Página no encontrada.";
            break;
    }
}
?>
