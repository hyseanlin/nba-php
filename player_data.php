<?php
include("connMysqlObj.php");
$sql_query = "SELECT `players`.`p_ID`, `players`.`p_name`, `teams`.`t_name`, 
										 `players`.`place`, `players`.`height`, `players`.`weight`,
										 `players`.`year`, `players`.`country`
										 FROM `players`
							INNER JOIN `teams`
							ON players.`teamID` = `teams`.`t_ID`
							ORDER BY p_ID ASC"; // DESC
$result = $db_link->query($sql_query);
$total_records = $result->num_rows;
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>NBA 球員資料管理系統</title>
</head>
<body>
<table align="center">
    <tr>
        <td>
            <a href="player_data.php"><img src="images/players.jpg"/></a>
        </td>
        <td>
            <a href="team_data.php"><img src="images/teams.jpg"/></a>
        </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
</table>
<h1 align="center">NBA 球員資料管理系統</h1>
<p align="center">目前資料筆數：<?php echo $total_records; ?>，<a href="player_add.php">新增球員資料</a>。</p>
<table border="1" align="center">
    <!-- 表格表頭 -->
    <tr>
        <th>編號</th>
        <th>球員</th>
        <th>球隊名稱</th>
        <th>位置</th>
        <th>身高</th>
        <th>體重</th>
        <th>年資</th>
        <th>國籍</th>
        <th>功能</th>
    </tr>
    <!-- 資料內容 -->
    <?php
    while ($row_result = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row_result["p_ID"] . "</td>";
        echo "<td>" . $row_result["p_name"] . "</td>";
        echo "<td>" . $row_result["t_name"] . "</td>";
        echo "<td>" . $row_result["place"] . "</td>";
        echo "<td>" . $row_result["height"] . "</td>";
        echo "<td>" . $row_result["weight"] . "</td>";
        echo "<td>" . $row_result["year"] . "</td>";
        echo "<td>" . $row_result["country"] . "</td>";
        echo "<td><a href='player_update.php?id=" . $row_result["p_ID"] . "'>修改</a> ";
        echo "<a href='player_delete.php?id=" . $row_result["p_ID"] . "'>刪除</a></td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>