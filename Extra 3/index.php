<?php   
include('conexao.php');

$sql_city_count_query = "SELECT COUNT(*) as c FROM cidades";
$sql_city_count_query_exec = $mysqli->query($sql_city_count_query) or die ($mysqli->error);

$sql_city_count = $sql_city_count_query_exec->fetch_assoc();
$city_count = $sql_city_count['c'];

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 20;
$page_interval = 4;
$offset = ($page - 1) * $limit;

$page_number = ceil($city_count / $limit);

$sql_cities_query = "SELECT * FROM cidades ORDER BY nome ASC LIMIT {$limit} OFFSET {$offset}";
$sql_cities_query_exec = $mysqli->query($sql_cities_query) or die($mysqli->error);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagination</title>
</head>
<body>
    <h1>Cities (<?= $city_count; ?>)</h1>
    <table border = "1">
        <tr>
            <th>City Name</th>
            <th>Action</th>
        </tr>
        <?php while($city = $sql_cities_query_exec->fetch_assoc()) { ?>
        <tr>
            <td><?= $city['nome']; ?></td>
            <td>Edit | Delete</td>
        </tr>
        <?php } ?>
    </table>
    <p>
        <?php echo "Page: {$page}<br>"; ?>
        <?php echo "Number of Pages: {$page_number}"; ?>
    </p>
    <p>
        <a href ="?page = 1">
        << </a>
        <?php
        $first_page = max($page - $page_interval, 1);
        $last_page = min($page_number, $page + $page_interval);

        for($p = $first_page; $p <= $last_page; $p++) {
            if($p === $page) {
                echo "[{$p}]";
            }else{
                echo "<a href='?page={$p}'>[{$p}]</a>";
            }
        }
        ?>
        <a href ="?page =<?php echo $page_number; ?>">
            >> </a>
    </p>
</body>
</html>