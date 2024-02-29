<?php

include("App.php");

$app = new App;


$id = $_GET['id'];
$id = intval($id);

$events = $app->showEventInfo($sql = "SELECT * FROM imagens where id = $id");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Editar Evento</title>
</head>

<body>
<div class="container">
        <div class="row justify-content-center align-items-center flex-column">
            <div class="col-5 pt-5">
                <form id="formEdit" method="post" enctype="multipart/form-data">

                <input id="event-id" type="hidden" name="event-id" value="<?php echo $events[0]['id']; ?>">

                    <div class="rounded">
                        <img src="<?php echo $events[0]['fotos'] ?>" id="img" class="img-fluid rounded border-dark border" style="object-fit: cover; width: 100%; height: 300px;" />
                    </div>
                    <div class="row form-floating p-2">
                        <input value="<?php echo $events[0]['nome_evento'] ?>" id="event-title" name="event-title" class="form-control" type="text" placeholder="Insira o nome do evento" autocomplete="off">
                        <label for="event-title">Nome do evento</label>
                    </div>
                    <div class="row form-floating p-2">
                        <textarea class="form-control" name="event-description" id="event-description" rows="4" cols="10" placeholder="Insira uma descrição para o evento" style="height: 100px; min-height: 100px; max-height: 150px;"><?php echo $events[0]['descricao_evento'] ?></textarea>
                        <label for="event-description">Descrição do evento</label>
                    </div>
                    <div class="row">
                        <div class="col-6 p-2 form-floating">
                            <input value="<?php echo $events[0]['data_evento'] ?>" id="event-datetime" name="event-datetime" class="form-control" type="datetime-local" placeholder="10/04/2019">
                            <label for="event-description">Data do evento</label>
                        </div>
                        <div class="col-6 p-2 form-floating">
                            <input id="event-duration" name="event-duration" class="form-control" type="number" placeholder="Insira uma duração em segundos" min="10" max="60" value="<?php echo $events[0]['tempo_duracao'] ?>">
                            <label for="event-description">Duração do evento</label>
                            <small class="text-center">Insira a duração do evento em segundos</small>
                        </div>
                    </div>
                    <div class="row d-flex flex-row justify-content-between">
                        <div class="col p-2 ">
                            <input class="align-content-end form-control" type="file" name="event-photo" id="event-photo" accept=".png, .jpg">
                            <small>A imagem deve ter proporção de 16:9 ou 16:10 e não deve exceder 2MB</small>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-auto pt-4">
                            <button type="submit" class="btn btn-primary" style="
                                font-size: 20px;
                                padding: 7px 8px;
                                width: 110%;
                                ">
                                Enviar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="jquery-3.7.1.min.js"></script>
    <script src="ajax.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>