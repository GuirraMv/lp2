<?php
class CardController{

    function create(){
        $response = new Output();
        $response->allowedMethod('POST');

        $auth = new Auth();
        $user_session = $auth->allowedRole('admin');

        //Entradas
        $photo = $_POST['photo'];
        $title = $_POST['title'];
        $descricao = $_POST['descricao'];

        //Processamento ou Persistencia
        $Card = new Card(null, $photo, $title, $descricao);
        $id = $Card->create();
        //Saída
        $result['message'] = "Card Cadastrado com sucesso!";
        $result['Card']['id'] = $id;
        $result['Card']['photo'] = $photo;
        $result['Card']['title'] = $title;
        $result['Card']['descricao'] = $descricao;
        $response->out($result);
    }

    function delete(){
        $response = new Output();
        $response->allowedMethod('POST');

        $auth = new Auth();
        $user_session = $auth->allowedRole('admin');

        $id = $_POST['id'];
        $user = new User($id, null, null, null);
        $user->delete();
        $result['message'] = "Card deletado com sucesso!";
        $result['Card']['id'] = $id;
        $response->out($result);
    }

    function update(){
        $response = new Output();
        $response->allowedMethod('POST');

        $auth = new Auth();
        $user_session = $auth->allowedRole('admin');

        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $user = new User($id, $name, $email, $pass);
        $user->update();
        $result['message'] = "Card atualizado com sucesso!";
        $result['Card']['id'] = $id;
        $result['Card']['name'] = $name;
        $result['Card']['email'] = $email;
        $response->out($result);
    }

    function selectAll(){
        $response = new Output();
        $response->allowedMethod('GET');
        $user = new User(null, null, null, null);
        $result = $user->selectAll();
        $response->out($result);
    }

    function selectById(){
        $response = new Output();
        $response->allowedMethod('GET');
        $id = $_GET['id'];
        $user = new User($id, null, null, null);
        $result = $user->selectById();
        $response->out($result);
    }

}
?>