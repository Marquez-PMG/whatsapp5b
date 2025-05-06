<?php
// Modelo Persona
class Persona {
    private $conn;
    private $table_name = "persona";

    // Propiedades de la tabla persona
    public $idpersona;
    public $nombres;
    public $apellidos;
    public $fechanacimiento;
    public $idsexo;
    public $idestadocivil;

    // Constructor para la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear una nueva persona
    public function create() {
        try {
            $query = "INSERT INTO " . $this->table_name . " (nombres, apellidos, fechanacimiento, idsexo, idestadocivil)
                      VALUES (:nombres, :apellidos, :fechanacimiento, :idsexo, :idestadocivil)";

            $stmt = $this->conn->prepare($query);

            // Bind de los valores
            $stmt->bindParam(":nombres", $this->nombres, PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $this->apellidos, PDO::PARAM_STR);
            $stmt->bindParam(":fechanacimiento", $this->fechanacimiento, PDO::PARAM_STR);
            $stmt->bindParam(":idsexo", $this->idsexo, PDO::PARAM_INT);
            $stmt->bindParam(":idestadocivil", $this->idestadocivil, PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Error en create() para persona: " . $e->getMessage());
            return false;
        }
    }

    // Leer todas las personas
    public function read() {
        try {
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Error en read() para persona: " . $e->getMessage());
            return [];
        }
    }

    // Leer una sola persona por ID
    public function readOne() {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE idpersona = :idpersona LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":idpersona", $this->idpersona, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Error en readOne() para persona: " . $e->getMessage());
            return null;
        }
    }

    // Actualizar una persona
    public function update() {
        try {
            $query = "UPDATE " . $this->table_name . " SET
                        nombres = :nombres,
                        apellidos = :apellidos,
                        fechanacimiento = :fechanacimiento,
                        idsexo = :idsexo,
                        idestadocivil = :idestadocivil
                      WHERE idpersona = :idpersona";

            $stmt = $this->conn->prepare($query);

            // Bind de los valores
            $stmt->bindParam(":nombres", $this->nombres, PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $this->apellidos, PDO::PARAM_STR);
            $stmt->bindParam(":fechanacimiento", $this->fechanacimiento, PDO::PARAM_STR);
            $stmt->bindParam(":idsexo", $this->idsexo, PDO::PARAM_INT);
            $stmt->bindParam(":idestadocivil", $this->idestadocivil, PDO::PARAM_INT);
            $stmt->bindParam(":idpersona", $this->idpersona, PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Error en update() para persona: " . $e->getMessage());
            return false;
        }
    }

    // Eliminar una persona
    public function delete() {
        try {
            if (empty($this->idpersona)) {
                return false;
            }
            error_log("Intentando eliminar la persona con ID: " . $this->idpersona);

            $query = "DELETE FROM " . $this->table_name . " WHERE idpersona = :idpersona";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":idpersona", $this->idpersona, PDO::PARAM_INT);

            if ($stmt->execute()) {
                error_log("Persona con ID " . $this->idpersona . " eliminada correctamente.");
                return true;
            } else {
                error_log("Error en delete() para persona: La consulta no se ejecutó correctamente.");
                return false;
            }

        } catch (PDOException $e) {
            error_log("Error en delete() para persona: " . $e->getMessage());
            return false;
        }
    }
}
?>