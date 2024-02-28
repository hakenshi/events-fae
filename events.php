<?php

include("App.php");

$app = new App;

$events = $app->showEventInfo();

$placeholder_image = "images/fae.png";

$placeholder_image_white = "images/fae-branca.png";

?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>


<body>
    <header class="img-header">

        <?php if(!$events): ?>
            <button type="button" class="miniature-button">
                <img class="miniature-image" src="<?php echo $placeholder_image_white ?>" style="opacity: 1;">
            </button>
            <?php else:?>
       <?php foreach ($events as $index => $event) : ?>
            <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="<?php echo $index; ?>" class="miniature-button <?php echo ($index === 0) ? 'active' : ''; ?>">
                <img class="miniature-image" src="<?php echo $event['fotos']; ?>" <?php echo ($index === 0) ? 'style="opacity: 1;"' : ''; ?>>
            </button>
        <?php endforeach; ?>
        <?php endif;?>
    </header>
    <main class="container">
        <div class="p-5 carousel slide" id="imageCarousel" data-bs-ride="carousel" data-bs-ride="true">
            <div class="carousel-inner">
                <?php if(!$events) :?>
                    <div class="carouse-item active">
                        <img src="<?php echo $placeholder_image ?>" alt="" class="main-image">
                    </div>
                <?php else:?>
                <?php foreach ($events as $index => $event) : ?>
                    <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>" data-bs-interval="<?php echo $event['tempo_duracao'] * 1000 ?>">
                        <img class="main-image" src="<?php echo $event['fotos']; ?>">
                    </div>
                <?php endforeach; ?>
                <?php endif;?>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="jquery-3.7.1.min.js"></script>
    <script src="images.js"></script>
</body>

</html>