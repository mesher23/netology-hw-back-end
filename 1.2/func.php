<?php
$a = $_POST['q1'];
$x=1;
$y=1;
$z=0;
echo "Число ".$a;

while (true)
{
    if($x>$a)
    {
        echo "; Задуманное число НЕ ВХОДИТ в числовой ряд" ;break;}
    else
    {
        if ($x==$a)
        {
            echo "; Задуманное число ВХОДИТ в числовой ряд " ;break;}
        else
        { $z=$x;
            $x=$x+$y;
            $y=$z;
        }
    }
};
echo " $a. $x. $y. $z. ";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задание №2</title>
</head>
<body>

<form method="post">
    <p>Ваше число: <input type="text" name="q1" value=""> </p>
    <p><input type="submit" /></p>
</form>

<article>
    <p><strong>Чи́сла Фибона́ччи (также Фибона́чи)</strong> — элементы последовательности
        0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144, 233, 377, 610, 987, 1597, 2584, 4181, 6765, 10946, … ,
        в которой первые два числа равны либо 1 и 1, либо 0 и 1, а каждое последующее число равно сумме двух предыдущих чисел. Названы в честь средневекового математика Леонардо Пизанского (известного как Фибоначчи).
        Более формально, последовательность чисел Фибоначчи задаётся линейным рекуррентным соотношением.
        Иногда числа Фибоначчи рассматривают и для отрицательных значений, как двусторонне бесконечную последовательность, удовлетворяющую тому же рекуррентному соотношению. </p>
</article>
</body>
</html>
