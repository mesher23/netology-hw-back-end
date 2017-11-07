<?php
require_once 'app/session.php';
require_once 'app/query.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Домашнее задание</title>
</head>
<body>
<div class="form">
    <p style="color: red;">
        <?php
        if (!empty($errors) && !empty($_POST['save'])):
            echo array_shift($errors);
        endif;
        ?>
    </p>
    <div style="float: left">
        <form method="POST">
            <input type="text" name="description" placeholder="Описание задачи"
                   value="<?= $valueTask['description'] ?>">
            <input type="submit" name="save" value="<?= $valueTask['button'] ?>">
        </form>
    </div>
    <div style="float: left; margin-left: 20px;">
        <form method="POST">
            <label for="sort">Сортировать по:</label>
            <select name="sort_by">
                <option value="date_added">Дате добавления</option>
                <option value="is_done">Статусу</option>
                <option value="description">Описанию</option>
            </select>
            <input type="submit" name="sort" value="Отсортировать">
        </form>
    </div>
    <div style="clear: both"></div>
    <div style="width: 720px">
        <table>
            <tr>
                <th>Описание задачи</th>
                <th>Дата добавления</th>
                <th>Статус</th>
                <th></th>
            </tr>
            <?php foreach ($dataTODO as $key => $data): ?>
                <tr>
                    <td><?= htmlspecialchars($data['description'], ENT_QUOTES); ?></td>
                    <td><?= $data['date_added']; ?></td>
                    <?php if ($data['is_done'] == true): ?>
                        <td><span style='color: green;'>Выполнено</span></td>
                    <?php else: ?>
                        <td><span style='color: orange;'>В процессе</span></td>
                    <?php endif; ?>
                    <td>
                        <a href='?id=<?= $data['id']; ?>&action=edit'>Изменить</a>
                        <a href='?id=<?= $data['id']; ?>&action=done'>Выполнить</a>
                        <a href='?id=<?= $data['id']; ?>&action=delete'>Удалить</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
</body>
</html>