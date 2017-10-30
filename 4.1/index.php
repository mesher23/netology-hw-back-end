<?php
require_once 'app/db.php';
require_once 'app/CSRF.php';

$_POST['isbn'] = isset($_POST['isbn']) ? filter_input(INPUT_POST, 'isbn', FILTER_SANITIZE_STRING) : '';
$_POST['name'] = isset($_POST['name']) ? filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING) : '';
$_POST['author'] = isset($_POST['author']) ? filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING) : '';
?>

<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/style.css" rel="stylesheet">
    <title>Домашние задание</title>
</head>
<body>
<div class="form">
    <form method="POST" action="index.php">
        <input type="text" name="isbn" placeholder="ISBN" value="<?php echo $_POST['isbn'] ?>">
        <input type="text" name="name" placeholder="Название книги" value="<?php echo $_POST['name'] ?>">
        <input type="text" name="author" placeholder="Автор книги" value="<?php echo $_POST['author'] ?>">
        <input type="hidden" name="csrf" value="<?php echo $csrfToken; ?>">
        <input type="submit" name="inquiry" value="Поиск">
    </form>
    <table>
        <tr>
            <th>Название</th>
            <th>Автор</th>
            <th>Год выпуска</th>
            <th>ISBN</th>
            <th>Жанр</th>
        </tr>
    <?php
    if (hash_equals($_SESSION['csrfTokenPost'], $_POST['csrf'])):
        $sqlInquiryIsbn = "(`isbn` LIKE :isbn) ";
        $sqlInquiryName = "AND (`name` LIKE :name) ";
        $sqlInquiryAuthor = "AND (`author` LIKE :author)";
        $sqlInquiry = "SELECT * FROM `books` WHERE ".$sqlInquiryIsbn.$sqlInquiryName.$sqlInquiryAuthor;
        $booksDataArray = $db ->prepare($sqlInquiry);
        $booksDataArray->execute(["isbn" => $_POST['isbn']."%","name" => $_POST['name']."%","author" => $_POST['author']."%"]);
        foreach ($booksDataArray as $key => $data):
    ?>
            <tr>
                <td><?php echo htmlspecialchars($data["name"], ENT_QUOTES) ?></td>
                <td><?php echo htmlspecialchars($data["author"], ENT_QUOTES) ?></td>
                <td><?php echo htmlspecialchars($data["year"], ENT_QUOTES) ?></td>
                <td><?php echo htmlspecialchars($data["isbn"], ENT_QUOTES) ?></td>
                <td><?php echo htmlspecialchars($data["genre"], ENT_QUOTES) ?></td>
            </tr>
    <?php
        endforeach;
    else:
        $booksDataArray = $db->query("SELECT * FROM books");
        foreach ($booksDataArray as $key => $data):
    ?>
            <tr>
                <td><?php echo htmlspecialchars($data["name"], ENT_QUOTES) ?></td>
                <td><?php echo htmlspecialchars($data["author"], ENT_QUOTES) ?></td>
                <td><?php echo htmlspecialchars($data["year"], ENT_QUOTES) ?></td>
                <td><?php echo htmlspecialchars($data["isbn"], ENT_QUOTES) ?></td>
                <td><?php echo htmlspecialchars($data["genre"], ENT_QUOTES) ?></td>
            </tr>
    <?php
        endforeach;
    endif; ?>
    </table>
</div>
</body>
</html>