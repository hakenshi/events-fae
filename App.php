<?php

include("Database.php");


class App
{
    public function uploadImage($directory, $imageFileName)
    {
        $filePath = $directory . basename($imageFileName['name']);

        // if (file_exists($filePath)) {
        //     return array('status' => 409, 'filePath' => null);
        if (!move_uploaded_file($imageFileName['tmp_name'], $filePath)) {
            return array('status' => 500, 'filePath' => null);
        }

        return array('status' => 200, 'filePath' => $filePath);
    }


    public function uploadEventInfo($eventTitle, $eventDescription, $eventDateTime, $eventDuration, $eventPhoto)
    {
        $database = new Database;
        $pdo = $database->connect();

        $uploadResult = $this->uploadImage('images/', $eventPhoto);

        if ($uploadResult['status'] !== 200) {
            $response['code'] = $uploadResult['status'];
            if ($uploadResult['status'] === 409) {
                $response['mensagem'] = 'Erro ao salvar imagem, arquivo já existente';
            } elseif ($uploadResult['status'] === 500) {
                $response['mensagem'] = 'Falha ao mover arquivo';
            }
            return json_encode($response);
        }

        $uploadFilePath = $uploadResult['filePath'];


        try {
            $sql = "INSERT INTO imagens (nome_evento, descricao_evento, data_evento, fotos, tempo_duracao) VALUES(:nomeEvento, :descricaoEvento, :dataEvento, :fotoEvento, :tempoDuracao)";

            $statement = $pdo->prepare($sql);
            $statement->bindParam(":nomeEvento", $eventTitle);
            $statement->bindParam(":descricaoEvento", $eventDescription);
            $statement->bindParam(":dataEvento", $eventDateTime);
            $statement->bindParam(":fotoEvento", $uploadFilePath);
            $statement->bindParam(":tempoDuracao", $eventDuration);

            $statement->execute();

            $response['code'] = 200;
            $response['mensagem'] = 'Imagem salva com sucesso';

            return json_encode($response);
        } catch (\PDOException $e) {
            $response['code'] = 500;
            $response['mensagem'] = 'Erro ao salvar imagem ' . $e->getMessage();
            return json_encode($response);
        }
    }


    public function showEventInfo($sql)
    {
        $database = new Database;

        $pdo = $database->connect();

        $statement = $pdo->prepare($sql);
        $statement->execute();
        try {
            if ($statement->rowCount() > 0) return $statement->fetchAll(PDO::FETCH_ASSOC);

            return false;
        } catch (PDOException $e) {
            return "erro ao listar dados" . $e->getMessage();
        }
    }


    public function deleteEvent($id){
        $database = new Database;
        $pdo = $database->connect();

        $id = intval($id);

        try {

            $result = $this->showEventInfo($sql = "SELECT fotos FROM imagens where id = $id");


            if(file_exists($result[0]['fotos'])) unlink($result[0]['fotos']);


            $sql = "DELETE FROM imagens WHERE id = :id";

            $statement = $pdo->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);

            $statement->execute();

            $response['code'] = 200;
            $response['mensagem'] = 'Imagem apagada com sucesso';

            return json_encode($response);
        } catch (\PDOException $e) {
            $response['code'] = 500;
            $response['mensagem'] = 'Erro ao apagar imagem ' . $e->getMessage();
            return json_encode($response);
        }

    }

    public function updateEventInfo($id, $eventTitle, $eventDescription, $eventDateTime, $eventDuration, $eventPhoto){

        
        $database = new Database;
        $pdo = $database->connect();

        $id = intval($id);
        // echo "<pre>";
        // print_r($id, $eventTitle, $eventDescription, $eventDateTime, $eventDuration, $eventPhoto);
        // echo "</pre>";
        // exit;


        if($eventPhoto !== null){

        $uploadResult = $this->uploadImage('images/', $eventPhoto);

        // if ($uploadResult['status'] !== 200) {
        //     $response['code'] = $uploadResult['status'];
        //     // if ($uploadResult['status'] === 409) {
        //     //     $response['mensagem'] = 'Erro ao salvar imagem, arquivo já existente';
        //     // } elseif ($uploadResult['status'] === 500) {
        //     //     $response['mensagem'] = 'Falha ao mover arquivo';
        //     // }
        //     return json_encode($response);
        // }

        $uploadFilePath = $uploadResult['filePath'];

        $hasPhoto = true;

        }

        try {

            

            $sql = "UPDATE imagens SET nome_evento = '$eventTitle', descricao_evento = '$eventDescription', data_evento = '$eventDateTime', tempo_duracao = '$eventDuration'";
            
            if($hasPhoto){
                $sql .= ", fotos = '$uploadFilePath'";
            }

            $sql .= " WHERE id = $id";
            $statement = $pdo->prepare($sql);

            // $statement->bindParam(":nomeEvento", $eventTitle);
            // $statement->bindParam(":descricaoEvento", $eventDescription);
            // $statement->bindParam(":dataEvento", $eventDateTime);
            // $statement->bindParam(":fotoEvento", $uploadFilePath);
            // $statement->bindParam(":tempoDuracao", $eventDuration);
            // $statement->bindParam(":id", $id);

            $statement->execute();

            

            $response['code'] = 200;
            $response['mensagem'] = 'Imagem editada com sucesso';

            return json_encode($response);


        } catch (\PDOException $e) {
            $response['code'] = 500;
            $response['mensagem'] = 'Erro ao editar imagem ' . $e->getMessage();
            return json_encode($response);
        }
    }


}

$app = new App;

// $eventTitle = $_POST['eventTitle'];
// $eventDescription = $_POST['eventDescription'];
// $eventDateTime = $_POST['eventDateTime'];
// $eventDuration = $_POST['eventDuration'];
// $fileName = $_FILES['eventPhoto'];

// if (isset($_POST['eventTitle'], $_POST['eventDescription'], $_POST['eventDateTime'], $_POST['eventDuration'], $_FILES['eventPhoto'])) {
//     echo $app->uploadEventInfo($eventTitle, $eventDescription, $eventDateTime, $eventDuration, $fileName);
// } elseif (isset($_POST['id'])) {
//     $id = $_POST['id'];
//     echo $app->updateEventInfo($id, $eventTitle, $eventDescription, $eventDateTime, $eventDuration, $fileName);
// }

if(isset($_POST['id'])){
$id = $_POST['id'];
$app->deleteEvent($id);
}

// echo "<pre>";
// print_r($_FILES);
// print_r($_POST);
// echo "</pre>";
// exit;
