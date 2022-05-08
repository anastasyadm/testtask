<?php 
    $link = mysqli_connect("localhost", "root", "", "staff");
    if ($link == false){
        print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
    }
    else {
        print("Соединение установлено успешно");
        mysqli_set_charset($link, "utf8");
    }
    $sql = 'SELECT id, first_name, last_name FROM user';
    $result = mysqli_query($link, $sql);

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach ($rows as $row) {
        print("first name: " . $row['first_name'] . "; last name: " . $row['last_name'] ."; id: . " . $row['id'] . "<br>");
    }
    
?>
