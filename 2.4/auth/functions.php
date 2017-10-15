<?php
    session_start();

    function redirect($location) 
    {
    $host  = $_SERVER['HTTP_HOST'];
    header("Location: http://$host/$location");
    die;
    }

    function logout() 
    {
    session_destroy();
    $host  = $_SERVER['HTTP_HOST'];
    header("Location: http://$host/u/meshcheryakov/back/2.4/index.php");
    die;
    }

    function refresh($location)
    {
        $host  = $_SERVER['HTTP_HOST'];
        header("Refresh:2;http://$host/$location");
    }

    function form_number() 
    {
        echo '<form action="test.php" method="GET">';
        echo '<lable for="number">Введите номер теста:</lable>';
        echo '<input id="number" name="form" type="number" placeholder="">';
        echo '<input type="submit" value="Открыть"></form>';
    }

    function delete_test($var)
    {
        $directory = './json';
        $list_file = scandir($directory, 1);
        $amount_of_elements = count($list_file);
        foreach ( $list_file as $id_data => $data )
        {
            if ( $id_data === $var - 1 )
            {
                $array_form_json = './json/'.$data;
                unlink($array_form_json);
                break;
            }
        }
    }