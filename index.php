<?

require_once 'config.php';

$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$db_query = mysqli_query($db, "SELECT * FROM `forecast` ORDER BY `date` DESC");

$forecast = [];

if(mysqli_num_rows($db_query) > 0){
    while($row = mysqli_fetch_assoc($db_query)){
        $forecast[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
<table>
<thead>
<th>Время</th>
<th>Погода</th>
<th>Ощущалось</th>
<th>Влажность</th>
<th>Давление</th>
<th>Ветер</th>

</thead>

<tbody>
    <?php foreach($forecast as $f): ?>
        <tr>
        <td><?= $f['date']?></td>
        <td><?= $f['temperature']?></td>
        <td><?= $f['temperature_feels']?></td>
        <td><?= $f['humidity']?></td>
        <td><?= $f['pressure']?></td>
        <td><?= $f['wind']?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
    
</table>
</body>
</html>