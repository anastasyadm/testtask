<?php
$dsn = "mysql:host=localhost;dbname=staff;charset=utf8";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

$pdo = new PDO($dsn, 'root', '', $options);

$select1= 'SELECT first_name, last_name, created_at FROM user WHERE PERIOD_DIFF(date_format(curdate(),"%Y%m"),date_format(created_at,"%Y%m")) < 3 ORDER BY last_name';
$select2='SELECT user.first_name, user.last_name, dismission_reason.description FROM user INNER JOIN user_dismission ON user.id = user_dismission.user_id INNER JOIN dismission_reason on user_dismission.reason_id = dismission_reason.id WHERE user_dismission.is_active = 0';
$select3 = 'select * from (SELECT department.name as dn, position.name, user.first_name, user.last_name, department.id as di FROM department INNER JOIN position on department.leader_id=position.id INNER JOIN user on department.leader_id=user.id) as t1 left join (SELECT user_id, department_id as di2, first_name as fn, last_name as ln FROM ( SELECT user_id, department_id, ROW_NUMBER() OVER ( PARTITION BY department_id ORDER BY p.created_at DESC) row_num , first_name, last_name FROM user_position p INNER JOIN user u ON p.user_id = u.id ) t WHERE row_num = 1) as t2 ON t1.di=t2.di2';

 try
 {  
    
    if(isset($_POST["tar"])){
        switch ($_POST["tar"]) {
            case 1:
                $stmt = $pdo->query($select1);
                $results = $stmt->fetch(PDO::FETCH_BOTH);
                while ($results = $stmt->fetch(PDO::FETCH_BOTH)){
                    echo "<tr>";
                    echo "<td>".$results['first_name'] . "</td>";
                    echo "<td>".$results['last_name'] . "</td>";
                    echo "<td>".$results['created_at'] . "</td>";
                    echo "</tr>";
                }
                break;
            case 2:
                $stmt = $pdo->query($select2);
                while ($results = $stmt->fetch(PDO::FETCH_BOTH)){
                    echo "<tr>";
                    echo "<td>".$results['first_name'] . "</td>";
                    echo "<td>".$results['last_name'] . "</td>";
                    echo "<td>".$results['description'] . "</td>";
                    echo "</tr>";
                }


                break;
            case 3:
                $stmt = $pdo->query($select3);
                while ($results = $stmt->fetch(PDO::FETCH_BOTH)){
                    echo "<tr>";
                    echo "<td>".$results['dn'] . "</td>";
                    echo "<td>".$results['name'] . "</td>";
                    echo "<td>".$results['first_name'] . "</td>";
                    echo "<td>".$results['last_name'] . "</td>";
                    echo "<td>".$results['fn'] . "</td>";
                    echo "<td>".$results['ln'] . "</td>";
                    echo "</tr>";
                }

                break;
        }
    }
 }
 
 catch(PDOException $exception)
 {  
      echo $error->getMessage();  
 }  


?>
