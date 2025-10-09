<?php
function validateFio($fio) {
    return preg_match("/^[a-zA-ZА-Яа-яЇїІіЄєҐґ\s]+$/u", $fio);
}

$errors = [];

if (!isset($_POST['fio']) || empty(trim($_POST['fio']))) {
    $errors[] = "Поле ПІБ не може бути порожнім.";
} elseif (!validateFio($_POST['fio'])) {
    $errors[] = "ПІБ повинен містити лише літери та пробіли.";
}

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $file_name = $_FILES['photo']['name'];
    $file_tmp = $_FILES['photo']['tmp_name'];

    if (!is_dir("uploads")) {
        mkdir("uploads");
    }

    move_uploaded_file($file_tmp, "uploads/" . $file_name);
    $photo_path = "uploads/" . $file_name;
} else {
    $errors[] = "Помилка під час завантаження фотографії.";
}

$age = $_POST['age'] ?? '';
$education = $_POST['education'] ?? '';
$exp = $_POST['exp'] ?? '';
$about = $_POST['about'] ?? '';

if (!empty($errors)) {
    echo "<h3>Знайдено помилки:</h3><ul>";
    foreach ($errors as $e) {
        echo "<li>$e</li>";
    }
    echo "</ul><a href='index.html'>Повернутись назад</a>";
    exit();
}

?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Результат</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
<h2>Введена інформація</h2>
<table>
    <tr><th>ПІБ</th><td><?= htmlspecialchars($_POST['fio']) ?></td></tr>
    <tr><th>Фото</th><td><img src="<?= $photo_path ?>" alt="Фото" width="150"></td></tr>
    <tr><th>Вік</th><td><?= htmlspecialchars($age) ?></td></tr>
    <tr><th>Освіта</th><td><?= htmlspecialchars($education) ?></td></tr>
    <tr><th>Стаж роботи</th><td><?= htmlspecialchars($exp) ?></td></tr>
    <tr><th>Про себе</th><td><?= nl2br(htmlspecialchars($about)) ?></td></tr>
</table>
<br>
<a href="index.html">Повернутись до форми</a>
</body>
</html>
