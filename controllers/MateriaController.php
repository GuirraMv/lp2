<?php
class MateriaController{

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
        $Materia = new Materia(null, $photo, $title, $descricao, $texto);
        $id = $Materia->create();
        //Saída
        $result['message'] = "Materia Cadastrado com sucesso!";
        $result['Materia']['id'] = $id;
        $result['Materia']['photo'] = $photo;
        $result['Materia']['title'] = $title;
        $result['Materia']['descricao'] = $descricao;
        $result['Materia']['texto'] = $texto;
        $response->out($result);
    }

    function delete(){
        $response = new Output();
        $response->allowedMethod('POST');

        // $auth = new Auth();
        // $user_session = $auth->allowedRole('admin');

        $id = $_POST['id'];
        $Materia = new Materia($id, null, null, null, null);
        $Materia->delete();
        $result['message'] = "Materia deletado com sucesso!";
        $result['Materia']['id'] = $id;
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
        $Materia = new Materia($id, $photo, $title, $descricao, $texto);
        $Materia->update();
        $result['message'] = "Materia atualizado com sucesso!";
        $result['Materia']['id'] = $id;
        $result['Materia']['photo'] = $photo;
        $result['Materia']['title'] = $title;
        $result['Materia']['descricao'] = $descricao;
        $result['Materia']['texto'] = $texto;
        $response->out($result);
    }

    function selectAll(){
        $response = new Output();
        $response->allowedMethod('GET');
        $Materia = new Materia(null, null, null, null, null);
        $result = $Materia->selectAll();
        $response->out($result);
    }

    function selectById(){
        $response = new Output();
        $response->allowedMethod('GET');
        $id = $_GET['id'];
        $Materia = new Materia($id, null, null, null, null);
        $result = $Materia->selectById();
        $response->out($result);
    }

}
?>