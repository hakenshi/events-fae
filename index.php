<?php

include("App.php");

$app = new App;


$events = $app->showEventInfo($sql = "SELECT * FROM imagens");

?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <nav class="nav bg-unifae justify-content-center p-3">
        <a class="nav-link text-light" href="resgister_event.php" aria-current="page"> Cadastar Evento</a>
        <a class="nav-link text-light" href="events.php" aria-current="page"> Exibir Eventos</a>
    </nav>


    <main>
        <div class="container">
            <div class="row">
                <div class="col p-5">


                    <?php if (!$events) { ?>
                        <div class="events-card">
                                <a href="resgister_event.php" class="btn"> <p class="h1">Sem eventos disponíveis!</p>
                                <small>clique aqui para cadastrar um novo evento</small>
                            </a>
                        </div>
                    <?php } else { ?>


                        <table class="table table-responsive">
                            <thead class="table-dark">
                                <tr>
                                    <th class="mx-2" scope="col">Evento</th>
                                    <th class="mx-2">Descrição</th>
                                    <th class="mx-2" scope="col">Data</th>
                                    <th class="mx-2" scope="col">Foto</th>
                                    <th class="mx-2" colspan="2" scope="col"></th>
                                    <th class="mx-2" colspan="2" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php foreach ($events as $index => $event) : ?>
                                    <tr>
                                        <td class="p-3 nomeEvento"><?php echo $event['nome_evento'] ?></td>

                                        <td class="p-3 descricaoEvento"><?php echo $event['descricao_evento'] ?></td>

                                        <td class="p-3 dataEvento"><?php echo $event['data_evento'] ?></td>

                                        <td class="p-3"><img class="img-fluid fotos" src="<?php echo $event['fotos'] ?>" alt="" style="width: 10%;"></td>
                                        <td class="p-3"><a href="edit_event.php?id=<?php echo $event['id'] ?>" class="btn btn-success" type="button">Editar</a>
                                        </td>
                                        <td><input class="id" type="hidden" name="id" value="<?php echo $event['id'] ?>"></td>
                                        <td class="p-3 "><button onclick="removeEvent(this)" class="btn btn-danger" type="button">Apagar</button></td>
                                    </tr>
                            <?php endforeach;
                            } ?>

                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="jquery-3.7.1.min.js"></script>
    <script src="ajax.js"></script>
    <script src="images.js"></script>

</body>

</html>