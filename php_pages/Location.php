<?php

require_once "../database/database.php";

class Location {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getWilayas() {
        $sql = "SELECT id,code, name_ar, name_en FROM wilayas ";
        return $this->fetchAll($sql);
    }

    public function getDairasByWilaya($wilaya_id) {
        $sql = "SELECT id, name_ar, name_en FROM dairas WHERE wilaya_id = ? ORDER BY name_ar ASC";
        return $this->fetchAll($sql, [$wilaya_id]);
    }

    public function getCommunesByDaira($daira_id) {
        $sql = "SELECT id, name_ar, name_en FROM communes WHERE daira_id = ? ORDER BY name_ar ASC";
        return $this->fetchAll($sql, [$daira_id]);
    }

    private function fetchAll($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("EROOR " . $e->getMessage());
        }
    }
}

?>
