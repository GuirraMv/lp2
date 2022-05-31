<?php 
class Product{
    public $id;
    public $photo;
    public $title;
    public $descricao;
    function __construct($id, $photo, $title, $descricao) {
        $this->id = $id;
        $this->photo = $photo;
        $this->title = $title;
        $this->descricao = $descricao;
    }
    function create(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("INSERT INTO products (photo, title, descricao)
            VALUES (:photo, :title, :descricao);");
            $stmt->bindParam(':photo', $this->photo);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->execute();
            $id = $db->conn->lastInsertId();
            return $id;
        }catch(PDOException $e) {
            $result['message'] = "Error Select All Cards: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }
    function delete(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("DELETE FROM cards WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            return $stmt->rowCount();
        }catch(PDOException $e) {
            $result['message'] = "Error Delete Card: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }
    function update(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("UPDATE cards SET photo = :photo, title = :title, descricao = :descricao WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':photo', $this->photo);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->execute();
            return true;
        }catch(PDOException $e) {
            $result['message'] = "Error Update Card: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }
    function selectAll(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("SELECT * FROM cards;");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e) {
            $result['message'] = "Error Select All Cards: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }

    function selectById(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("SELECT * FROM cards WHERE id = :id;");
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