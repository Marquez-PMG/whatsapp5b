<?php
// Modelo EstadoCivil
class EstadoCivil {
    private $conn;
    private $table_name = "estadocivil";

    public $idestadocivil;
    public $nombre;

    public function __construct($db) {
        $this->conn = $db;
    }


    public function getAll() {
        // Conexión a la base de datos
        $query = $this->conn->query("SELECT * FROM estadocivil");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo estado civil
    public function create() {
        try {
            $query = "INSERT INTO " . $this->table_name . " (nombre) VALUES (:nombre)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en create(): " . $e->getMessage());
            return false;
        }
    }

    public function read() {
        try {
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            error_log("Error en read(): " . $e->getMessage());
            return [];
        }
    }

    // Leer un solo estado civil por ID
    public function readOne() {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE idestadocivil = :idestadocivil LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":idestadocivil", $this->idestadocivil, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en readOne(): " . $e->getMessage());
            return null;
        }
    }

    // Actualizar un estado civil
    public function update() {
        try {
            $query = "UPDATE " . $this->table_name . " SET nombre = :nombre WHERE idestadocivil = :idestadocivil";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
            $stmt->bindParam(":idestadocivil", $this->idestadocivil, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en update(): " . $e->getMessage());
            return false;
        }
    }

    // Eliminar un estado civil
    public function delete() {
        try {
            if (empty($this->idestadocivil)) {
                return false;
            }
            error_log("Intentando eliminar el ID de estado civil: " . $this->idestadocivil);

            // Preparar la consulta
            $query = "DELETE FROM " . $this->table_name . " WHERE idestadocivil = :idestadocivil";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":idestadocivil", $this->idestadocivil, PDO::PARAM_INT);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                error_log("Registro de estado civil con ID " . $this->idestadocivil . " eliminado correctamente.");
                return true;
            } else {
                error_log("Error en delete(): La consulta de estado civil no se ejecutó correctamente.");
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error en delete(): " . $e->getMessage());
            return false;
        }
    }
}
?>
