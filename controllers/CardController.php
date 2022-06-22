<?php
class CardController{

    function create(){
        $response = new Output();
        $response->allowedMethod('POST');

        // $auth = new Auth();
        // $user_session = $auth->allowedRole('admin');

        //Entradas
        $photo = $_POST['photo'];
        $title = $_POST['title'];
        $descricao = $_POST['descricao'];
        $texto = $_POST['texto'];
        //Processamento ou Persistencia
        $Card = new Card(null, $photo, $title, $descricao, $texto);
        $id = $Card->create();
        //Saída
        $result['message'] = "Card Cadastrado com sucesso!";
        $result['Card']['id'] = $id;
        $result['Card']['photo'] = $photo;
        $result['Card']['title'] = $title;
        $result['Card']['descricao'] = $descricao;
        $result['Card']['texto'] = $texto;
        $response->out($result);
    }

    function delete(){
        $response = new Output();
        $response->allowedMethod('POST');

        // $auth = new Auth();
        // $user_session = $auth->allowedRole('admin');

        $id = $_POST['id'];
        $Card = new Card($id, null, null, null, null);
        $Card->delete();
        $result['message'] = "Card deletado com sucesso!";
        $result['Card']['id'] = $id;
        $response->out($result);
    }

    function update(){
        $response = new Output();
        $response->allowedMethod('POST');

        // $auth = new Auth();
        // $user_session = $auth->allowedRole('admin');

        $id = $_POST['id'];
        $photo = $_POST['photo'];
        $title = $_POST['title'];
        $descricao = $_POST['descricao'];
        $texto = $_POST['texto'];
        $Card = new Card($id, $photo, $title, $descricao, $texto);
        $Card->update();
        $result['message'] = "Card atualizado com sucesso!";
        $result['Card']['id'] = $id;
        $result['Card']['photo'] = $photo;
        $result['Card']['title'] = $title;
        $result['Card']['descricao'] = $descricao;
        $result['Card']['texto'] = $texto;
        $response->out($result);
    }

    function selectAll(){
        $response = new Output();
        $response->allowedMethod('GET');
        $Card = new Card(null, null, null, null, null);
        $result = $Card->selectAll();
        $response->out($result);
    }

    function selectById(){
        $response = new Output();
        $response->allowedMethod('GET');
        $id = $_GET['id'];
        $Card = new Card($id, null, null, null, null);
        $result = $Card->selectById();
        $response->out($result);
    }

}
?>