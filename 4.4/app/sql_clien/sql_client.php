<?php
/**
 * Основоной файл с приложением
 */
$odjQuery = new classes\query\Query();
$arrayTypeColum = require_once 'dataTypeColum.php';
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
<div class="form">
    <div class="table">
        <p style="color: red;">
            <?php
            if (!empty($errors)):
                echo array_shift($errors);
            endif;
            ?>
        </p>
        <table>
            <tr>
                <th>Таблицы</th>
                <th>Редактировать таблицу</th>
            </tr>
            <?php foreach ($odjQuery->getTables as $keyTable => $dataTable): ?>
                <tr>
                    <td><?php echo htmlspecialchars($dataTable['Tables_in_global'], ENT_QUOTES) ?></td>
                    <td><a href="?table=<?php echo htmlspecialchars($dataTable['Tables_in_global'], ENT_QUOTES) ?>">Редактировать</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <form method="POST">
            <input type="text" name="table" placeholder="Имя таблицы">
            <input type="submit" name="creatTable" value="Создать таблицу">
        </form>
    </div>
    <?php if (!empty($odjQuery->infoTable)): ?>
        <div class="editTable">
            <h3>Табица: <?php echo $_GET['table'] ?></h3>
            <form method="POST">
                <p>
                    Название таблицы:
                    <input name="nameTable" maxlength="64" value="<?php echo $_GET['table'] ?>">
                </p>
                <table cellspacing="0" id="edit-fields" class="nowrap">
                    <thead>
                    <tr class="wrap">
                        <th id="label-name">Название поля</th>
                        <td id="label-type">Тип</td>
                        <td id="label-length">Удалить</td>
                    </tr>
                    </thead>
                    <?php
                    foreach ($odjQuery->infoTable as $keyTable => $dataTable):
                        $arrayField [] = $dataTable['Field'];
                    ?>
                    <tbody>
                    <tr>
                        <th>
                            <input name="nameColumn<?php echo $keyTable ?>" value="<?php echo $dataTable['Field'] ?>">
                            <input type="hidden" name="OldNameColumn<?php echo $keyTable ?>" value="<?php echo $dataTable['Field'] ?>">
                        </th>
                        <td><select name="fieldsType<?php echo $keyTable ?>" class="type">
                                <?php foreach ($arrayTypeColum as $keyType => $dataType): ?>
                                    <optgroup label="<?php echo $keyType ?>">
                                        <?php
                                        $selectedType = explode('(', $dataTable['Type']);
                                        foreach ($dataType as $keyOption => $dataOption):
                                            if ($dataOption === $selectedType[0]):
                                                echo '<option selected>' . $dataOption;
                                            else:
                                                echo '<option>' . $dataOption;
                                            endif;
                                        endforeach;
                                        ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <a href="?table=<?php echo $_GET['table'] ?>&deleteColumn=<?php echo $dataTable['Field'] ?>">Удалить</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <input type="submit" value="Сохранить">
            </form>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
