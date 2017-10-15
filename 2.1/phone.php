<?php
$data_json = file_get_contents ('data.json');
$array_data = json_decode ($data_json, true);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div>
    <table border="1" bordercolor="rgba(222, 222, 222, 0.78)">
        <caption>Телефонный справочник</caption>
        <tr>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Адрес</th>
            <th>Номер телефона</th>
        </tr>
        <?php foreach ($array_data as $key => $value): ?>
        <section id="content-tab<?php echo $key+1; ?>">
            <tr>
                <td><?php echo $value['firstName']; ?></td>
                <td><?php echo $value['lastName']; ?></td>
                <td><?php echo $value['address']; ?></td>
                <td><?php echo $value['phoneNumber']; ?></td>
            </tr>
        </section>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>