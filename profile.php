<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пестерев.Н.А</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h1>Добро пожаловать!</h1>
                <p class="lead">Это сайт нкииты</p>
            </div>

            <div class="col-md-6">
                <h3>Обо мне</h3>
                <p>студент</p>
            </div>

            <div class="col-md-6 text-center">
                <h3>картинка один</h3>
                <img src="images/images.jpg" alt="картинка один" class="img-fluid rounded shadow">
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 text-center">
                <h3>картинка два</h3>
                <img src="images/aarbuz.jpg" alt="картинка два" class="img-fluid rounded border">
            </div>
        </div>

        <div class="text-center mt-4">
            <button onclick="toggleImagesAndText()" class="btn btn-primary">Показать/Спрятать картинки и сменить цвет</button>
        </div>

        <div class="row mt-5">
            <div class="col-12">
            <h1>Привет, <?php echo $_COOKIE['username']; ?></h1>
            </div>
            <div class="col-12">
                <form method="POST" action="profile.php" enctype="multipart/form-data" name="upload">
                    <input class="form-control mb-2" type="text" name="title" placeholder="Заголовок поста">
                    <textarea class="form-control mb-2" name="text" rows="5" placeholder="Текст поста"></textarea>
                    <input class="form-control mb-2" type="file" name="file" />
                    <button type="submit" class="btn btn-success" name="submit">сохранить пост</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kFH3K8GLmzh9nUGzDJ6U/qDfiAq8cOBV/YwXZjsYzvQAAFYsXzDAzhLJivmj0XhB" crossorigin="anonymous"></script>
    <script src="java/script.js"></script>
</body>
</html>

<?php
require_once('./db.php');
$link = mysqli_connect('db', 'root', 'root', 'baza');
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $main_text = $_POST['text'];

    if (!$title || !$main_text) die ('введите значения');

    $uploadDir = 'upload/';
    $uploadedFilePath = '';

    if (!empty($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/x-png', 'image/png'];
        $fileType = $_FILES["file"]["type"];
        $fileSize = $_FILES["file"]["size"];

        if (in_array($fileType, $allowedTypes)) { // 1MB limit
            $uploadedFilePath = $uploadDir . basename($_FILES["file"]["name"]);

            if (!move_uploaded_file($_FILES["file"]["tmp_name"], $uploadedFilePath)) {
                die("Ошибка при перемещении загруженного файла.");
            }
        } else {
            die("Неподдерживаемый формат файла");
        }
    }

    if ($uploadedFilePath) {
        $sql = "INSERT INTO posts (title, main_text, image_path) VALUES ('$title', '$main_text', '$uploadedFilePath')";
    } else {
        $sql = "INSERT INTO posts (title, main_text) VALUES ('$title', '$main_text')";
    }

    if (!mysqli_query($link, $sql)) {
        echo "не получилось сохранить в БД";
    } else {
        echo "Пост и файл успешно сохранены";
    }
}

?>
