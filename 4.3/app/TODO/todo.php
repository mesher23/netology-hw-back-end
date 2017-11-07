<?php
/**
 * Основоной файл с приложением
 */
require_once 'query.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Личный кабинет</title>
</head>
<body>
<div>
    <h1>Добро пожаловать <?php echo $_SESSION['logUser']['name'] ?></h1>
    <form method="POST">
        <input type="submit" name="logout" value="Выйти">
    </form>
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
                       value="<?php echo $valueTask['description'] ?>">
                <input type="submit" name="save" value="<?php echo $valueTask['button'] ?>">
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
        <div style="clear: both"><br></div>
        <div>
            <table>
                <tr>
                    <th>Описание задачи</th>
                    <th>Дата добавления</th>
                    <th>Статус</th>
                    <th></th>
                    <th>Ответственный</th>
                    <th>Автор</th>
                    <th>Закрепить задачу за пользователем</th>
                </tr>
                <?php foreach ($dataTODO as $key => $data): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($data['description'], ENT_QUOTES); ?></td>
                        <td><?php echo $data['date_added']; ?></td>
                        <?php if ($data['is_done'] == true): ?>
                            <td><span style='color: green;'>Выполнено</span></td>
                        <?php else: ?>
                            <td><span style='color: orange;'>В процессе</span></td>
                        <?php endif; ?>
                        <td>
                            <a href='?id=<?php echo $data['id']; ?>&action=edit'>Изменить</a>
                            <a href='?id=<?php echo $data['id']; ?>&action=done'>Выполнить</a>
                            <a href='?id=<?php echo $data['id']; ?>&action=delete'>Удалить</a>
                        </td>
                        <td><?php echo htmlspecialchars($data['name'], ENT_QUOTES); ?></td>
                        <td>
                            <?php
                            $sqlAuthor = "SELECT name FROM user WHERE id = " . $data['user_id'];
                            $author = $objDataBase->query($sqlAuthor);
                            echo htmlspecialchars($author[0]['name'], ENT_QUOTES);
                            ?>
                        </td>
                        <td>
                            <form method="POST">
                                <select name='assigned_user_id'>
                                    <?php foreach ($dataUserArr as $keyUser => $dataUser): ?>
                                        <option value="<?php echo $dataUser['id'] . '&' . $data['id']; ?>">
                                            <?php echo htmlspecialchars($dataUser['name'], ENT_QUOTES); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <input type='submit' name='assign' value='Переложить ответственность'/>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <br><br>
        <h3>Переложенные на Вас задачи:</h3>
        <div>
            <div style="float: left; margin-left: 20px;">
                <form method="POST">
                    <label for="sort_2">Сортировать по:</label>
                    <select name="sort_by_2">
                        <option value="date_added">Дате добавления</option>
                        <option value="is_done">Статусу</option>
                        <option value="description">Описанию</option>
                    </select>
                    <input type="submit" name="sort_2" value="Отсортировать">
                </form>
            </div>
            <div style="clear: both"><br></div>
            <table>
                <tr>
                    <th>Описание задачи</th>
                    <th>Дата добавления</th>
                    <th>Статус</th>
                    <th></th>
                    <th>Ответственный</th>
                    <th>Автор</th>
                </tr>
                <?php foreach ($dataTODO_2 as $key => $data): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($data['description'], ENT_QUOTES); ?></td>
                        <td><?php echo $data['date_added']; ?></td>
                        <?php if ($data['is_done'] == true): ?>
                            <td><span style='color: green;'>Выполнено</span></td>
                        <?php else: ?>
                            <td><span style='color: orange;'>В процессе</span></td>
                        <?php endif; ?>
                        <td>
                            <a href='?id=<?php echo $data['id']; ?>&action=done'>Выполнить</a>
                        </td>
                        <td><?php echo htmlspecialchars($data['name'], ENT_QUOTES); ?></td>
                        <td>
                            <?php
                            $sqlAuthor = "SELECT name FROM user WHERE id = " . $data['user_id'];
                            $author = $objDataBase->query($sqlAuthor);
                            echo htmlspecialchars($author[0]['name'], ENT_QUOTES);
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
