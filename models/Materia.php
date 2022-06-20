<?php 
class Materia{
    public $id;
    public $photo;
    public $title;
    public $descricao;
    public $texto;
    function __construct($id, $photo, $title, $descricao, $texto) {
        $this->id = $id;
        $this->photo = $photo;
        $this->title = $title;
        $this->descricao = $descricao;
        $this->texto = $texto;
    }
    function create(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("INSERT INTO Materia (photo, title, descricao, texto)
            VALUES (:photo, :title, :descricao, :texto);");
            $stmt->bindParam(':photo', $this->photo);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->bindParam(':texto', $this->texto);
            $stmt->execute();
            $id = $db->conn->lastInsertId();
            return $id;
        }catch(PDOException $e) {
            $result['message'] = "Error Select All Materias: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }
    function delete(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("DELETE FROM materia WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            return $stmt->rowCount();
        }catch(PDOException $e) {
            $result['message'] = "Error Delete Materia: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }
    function update(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("UPDATE materia SET photo = :photo, title = :title, descricao = :descricao, texto = :texto WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':photo', $this->photo);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->bindParam(':texto', $this->texto);
            $stmt->execute();
            return true;
        }catch(PDOException $e) {
            $result['message'] = "Error Update Materia: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }
    function selectAll(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("SELECT * FROM materia;");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e) {
            $result['message'] = "Error Select All Materia: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }

    function selectById(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("SELECT * FROM materia WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e) {
            $result['message'] = "Error Select card By Id: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }
}
?>