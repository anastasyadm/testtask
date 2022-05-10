<?php 
$link = mysqli_connect("localhost", "root", "", "staff");
mysqli_set_charset($link, "utf8");
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Тестовое задание - Кондратьева</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
    <header class="main-header">
        <h1 class="visually-hidden">Отдел кадров</h1>
    </header>
    <div class="main-content">
        <main class="content">
            <ul class="choose" value=''>
                <li>
                    <input type="radio" id="menu1" name="menu" value="1">
                    <label for="menu1" class="">
                        <p>Испытательный срок</p>
                    </label>

                    <div class="check1"></div>
                </li>

                <li>
                    <input type="radio" id="menu2" name="menu" value="2">
                    <label for="menu2" class="">
                        <p class="">Уволенные</p>
                    </label>

                    <div class="check1">
                        <div class="inside"></div>
                    </div>
                </li>
                <li>
                    <input type="radio" id="menu3" name="menu" value="3">
                    <label for="menu3" class="">
                        <p class="">Начальники</p>
                    </label>

                    <div class="check1">
                        <div class="inside"></div>
                    </div>
                </li>
            </ul>
            <div class="block-text" id="block-1" style="display:none">
                <table>
                    <tr>
                        <td style="border:1px solid grey;">ФИО Сотрудников</td>
                        <td style="border:1px solid grey;">Дата устройства на работу</td>
                    </tr>
                    <script>
                        jQuery(document).ready(function() {
                            $('input[name="menu"]').click(function() {
                                var target = $('#block-' + $(this).val());
                                $('.block-text').not(target).hide();
                                target.show();


                            });
                        });

                    </script>
                    <?php 
                
                    $sql = 'SELECT first_name, last_name, created_at FROM user WHERE PERIOD_DIFF(date_format(curdate(),"%Y%m"),date_format(created_at,"%Y%m")) < 3 ORDER BY last_name' ;
               
                    $result = mysqli_query($link, $sql);
                    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    foreach ($rows as $row) {
                        echo "
                        <tr>
                        <td style='border:1px solid grey;'> 
                            $row[first_name]  $row[last_name]
                        </td>
                        <td style='border:1px solid grey;'>
                            $row[created_at]
                        </td>
                        </tr>
                        ";
                    }
                ?>
                </table>
            </div>
            <div class="block-text" id="block-2" style="display:none">
                <table>
                    <tr>
                        <td style="border:1px solid grey;">ФИО Сотрудников</td>
                        <td style="border:1px solid grey;">Причина</td>
                    </tr>


                    <?php 
                    $sql = 'SELECT user.first_name, user.last_name, dismission_reason.description FROM user INNER JOIN user_dismission ON user.id = user_dismission.user_id INNER JOIN dismission_reason on user_dismission.reason_id = dismission_reason.id WHERE user_dismission.is_active = 0';
                    $result = mysqli_query($link, $sql);
                    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    foreach ($rows as $row) {
                        echo "
                        <tr>
                        <td style='border:1px solid grey;'> 
                            $row[first_name]  $row[last_name]
                        </td>
                        
                        <td style='border:1px solid grey;'>
                            $row[description]
                        
                        </td>
                        </tr>
                        ";
                    }
                ?>
                </table>
            </div>
            <div class="block-text" id="block-3" style="display:none">
                <table>
                    <tr>
                        <td style="border:1px solid grey;">Отдел</td>
                        <td style="border:1px solid grey;">Начальник</td>
                        <td style="border:1px solid grey;">ФИО Сотрудников</td>


                    </tr>

                    <?php 
                    $sql = 'select * from (SELECT department.name as dn, position.name, user.first_name, user.last_name, department.id as di FROM department INNER JOIN position on department.leader_id=position.id INNER JOIN user on department.leader_id=user.id) as t1 left join (SELECT user_id, department_id as di2, first_name as fn, last_name as ln FROM ( SELECT user_id, department_id, ROW_NUMBER() OVER ( PARTITION BY department_id ORDER BY p.created_at DESC) row_num , first_name, last_name FROM user_position p INNER JOIN user u ON p.user_id = u.id ) t WHERE row_num = 1) as t2 ON t1.di=t2.di2' ;
                    $result = mysqli_query($link, $sql);
                    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    foreach ($rows as $row) {
                        echo "
                        <tr>
                        <td style='border:1px solid grey;'> 
                            $row[dn]
                        </td>
                        <td style='border:1px solid grey;'> 
                            $row[first_name]  $row[last_name]
                        </td>
                        
                        <td style='border:1px solid grey;'>
                            $row[fn]  $row[ln]
                        </td>
                        </tr>
                        ";
                    }
                ?>

                </table>
            </div>


        </main>
    </div>
    <footer class="main-footer" style="margin-top:10%">Все права защищены</footer>
</body>

</html>
