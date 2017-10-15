<?php
    $fail_json = 'users.json';
    $open_file_login = file_get_contents($fail_json);
    $login_array = json_decode($open_file_login, true);