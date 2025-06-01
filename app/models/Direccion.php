<?php
// Modelo Direccion
class Direccion {
    private $conn;
    private $table_name = "direccion";

    // Propiedades de la tabla direccion
    public $iddireccion;
    public $idpersona;
    public $nombre;

    // Constructor para la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }


    // Crear un nuevo teléfono
    public function create() {
        try {
            $query = "INSERT INTO " . $this->table_name . " (idpersona, nombre)
                      VALUES (:idpersona, :nombre)";

            $stmt = $this->conn->prepare($query);

            // Bind de los valores
            $stmt->bindParam(":idpersona", $this->idpersona, PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);

            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Error en create() para direccion: " . $e->getMessage());
            return false;
        }
    }


    // Leer todos los teléfonos
    public function read1() {
        try {
            $query = "SELECT * FROM " . "direccion1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Error en read() para direccion: " . $e->getMessage());
            return [];
        }
    }

    public function getAll() {
        // Conexión a la base de datos
        $query = $this->conn->query("SELECT * FROM direccion");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }



    // Leer todos los teléfonos
    public function read() {
        try {
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Error en read() para direccion: " . $e->getMessage());
            return [];
        }
    }

    // Leer un solo teléfono por ID
    public function readOne() {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE iddireccion = :iddireccion LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":iddireccion", $this->iddireccion, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Error en readOne() para direccion: " . $e->getMessage());
            return null;
        }
    }

    // Actualizar un teléfono
    public function update() {
        try {
            $query = "UPDATE " . $this->table_name . " SET
                        idpersona = :idpersona,
                        nombre = :nombre
                      WHERE iddireccion = :iddireccion";

            $stmt = $this->conn->prepare($query);

            // Bind de los valores
            $stmt->bindParam(":idpersona", $this->idpersona, PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
            $stmt->bindParam(":iddireccion", $this->iddireccion, PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Error en update() para direccion: " . $e->getMessage());
            return false;
        }
    }

    // Eliminar un teléfono
    public function delete() {
        try {
            if (empty($this->iddireccion)) {
                return false;
            }
            error_log("Intentando eliminar el teléfono con ID: " . $this->iddireccion);

            $query = "DELETE FROM " . $this->table_name . " WHERE iddireccion = :iddireccion";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":iddireccion", $this->iddireccion, PDO::PARAM_INT);

            if ($stmt->execute()) {
                error_log("Teléfono con ID " . $this->iddireccion . " eliminado correctamente.");
                return true;
            } else {
                error_log("Error en delete() para direccion: La consulta no se ejecutó correctamente.");
                return false;
            }

        } catch (PDOException $e) {
            error_log("Error en delete() para direccion: " . $e->getMessage());
            return false;
        }
    }

    // Leer todos los teléfonos asociados a una persona específica
    public function readByPersona($idpersona) {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE idpersona = :idpersona";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":idpersona", $idpersona, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Error en readByPersona() para direccion: " . $e->getMessage());
            return [];
        }
    }
}
?>
