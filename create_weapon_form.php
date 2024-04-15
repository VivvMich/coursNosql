<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Le Bizaratator</title>
</head>
<body>

<h1 class="text-center">AdopteUnObjetMaudit.com</h1>

<h3 class="text-center">Creation d'un objet maudit</h3>

<?php include "message.php" ?>

<div class="text-center">
    <a class="text-center" href="show_objects.php">Vers l'index</a>
</div>

<div class="container-fluid ">
    <div class="row justify-content-center my-4">
        <div class="col-6">
            <form action="create_weapon.php" method="post">
                <div class="mb-3">
                    <label for="objet_name" class="form-label">Nom de l'objet</label>
                    <input type="text" class="form-control" name="objet_name" placeholder=" Ex : Une clé de voiture.">
                </div>
                <div class="mb-3">
                    <label for="objet_curse" class="form-label">Description de la malediction</label>
                    <input type="text" class="form-control" name="objet_curse" placeholder="Ex : Quand je porte l'objet, je perds une phalange." >
                </div>
                <div class="text-center my-4 mx-auto">
<!--                    <div class="g-recaptcha" data-sitekey="6Lcb5rgpAAAAAJTN5Zwzy7Py8kaMEyBylW1e28Dc"></div>-->
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-danger">Invocation de l'objet.</button>
                </div>
            </form>
        </div>
    </div>
</div>



</body>
</html>