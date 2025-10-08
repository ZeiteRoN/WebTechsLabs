<?php
$people = [
    ["fio" => "Іваненко Петро Олександрович", "age" => 22, "education" => "вища", "exp" => 1],
    ["fio" => "Бойко Олена Сергіївна", "age" => 45, "education" => "середня", "exp" => 20],
    ["fio" => "Ковальчук Андрій Віталійович", "age" => 34, "education" => "вища", "exp" => 5],
    ["fio" => "Мельник Ольга Петрівна", "age" => 17, "education" => "шкільна", "exp" => 0],
    ["fio" => "Шевченко Марія Іванівна", "age" => 29, "education" => "післядипломна", "exp" => 2],
    ["fio" => "Гончар Віталій Миколайович", "age" => 56, "education" => "вища", "exp" => 30],
    ["fio" => "Петренко Сергій Олегович", "age" => 40, "education" => "середня", "exp" => 12],
    ["fio" => "Лисенко Катерина Юріївна", "age" => 31, "education" => "вища", "exp" => 0.5],
];

function colorByAge($age) {
    if ($age < 18) return "blue";
    if ($age <= 30) return "green";
    if ($age <= 45) return "black";
    if ($age <= 60) return "orange";
    return "gray";
}

function higherEdu($education) {
    $edu = mb_strtolower($education, 'UTF-8');
    return (mb_stripos($edu, 'вищ') !== false);
}

function lastName($fio) {
    $parts = explode(" ", trim($fio));
    return $parts[0] ?? $fio;
}

usort($people, function($a, $b){
    return strcmp(mb_strtolower(lastName($a['fio']), 'UTF-8'), mb_strtolower(lastName($b['fio']), 'UTF-8'));
});
?>
<html>
<head><meta charset="utf-8"><title>Варіант 4</title></head>
<body>
<table border="1" cellpadding="5" cellspacing="0">
    <tr><th>ПІБ</th><th>Вік</th><th>Освіта</th><th>Стаж</th></tr>
    <?php foreach ($people as $p): ?>
        <tr<?php if ($p['exp'] < 3) echo ' bgcolor="#ccffcc"'; ?>>
            <td><?= htmlspecialchars($p['fio']) ?></td>
            <td style="color:<?= colorByAge($p['age']) ?>"><?= $p['age'] ?></td>
            <td><?= higherEdu($p['education']) ? '<b>'.htmlspecialchars($p['education']).'</b>' : htmlspecialchars($p['education']) ?></td>
            <td><?= $p['exp'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
