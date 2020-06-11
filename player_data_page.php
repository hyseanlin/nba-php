<?php
include("connMysqlObj.php");

//預設每頁筆數
$pageRow_records = 20;
//預設頁數
$num_pages = 1;
//若已經有翻頁，將頁數更新
if (isset($_GET['page'])) {
    $num_pages = $_GET['page'];
}
//本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
$startRow_records = ($num_pages - 1) * $pageRow_records;
//未加限制顯示筆數的SQL敘述句
$sql_query = "SELECT * FROM players";
//加上限制顯示筆數的SQL敘述句，由本頁開始記錄筆數開始，每頁顯示預設筆數
$sql_query_limit = $sql_query . " LIMIT {$startRow_records}, {$pageRow_records}";
//以加上限制顯示筆數的SQL敘述句查詢資料到 $result 中
$result = $db_link->query($sql_query_limit);
//以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_result 中
$all_result = $db_link->query($sql_query);
//計算總筆數
$total_records = $all_result->num_rows;
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records / $pageRow_records);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>NBA 球員管理系統</title>
</head>
<body>
<h1 align="center">NBA 球員管理系統</h1>
<p align="center">目前資料筆數：<?php echo $total_records; ?>，<a href="player_add.php">新增 NBA 球員</a>。</p>
<table border="1" align="center">
    <!-- 表格表頭 -->
    <tr>
        <th>編號</th>
        <th>球員</th>
        <th>團隊編號</th>
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
        echo "<td>" . $row_result["teamID"] . "</td>";
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
<table border="0" align="center">
    <tr>
        <?php if ($num_pages > 1) { // 若不是第一頁則顯示 ?>
            <td><a href="player_data_page.php?page=1">第一頁</a></td>
            <td><a href="player_data_page.php?page=<?php echo $num_pages - 1; ?>">上一頁</a></td>
        <?php } ?>
        <?php if ($num_pages < $total_pages) { // 若不是最後一頁則顯示 ?>
            <td><a href="player_data_page.php?page=<?php echo $num_pages + 1; ?>">下一頁</a></td>
            <td><a href="player_data_page.php?page=<?php echo $total_pages; ?>">最後頁</a></td>
        <?php } ?>
    </tr>
</table>
<table border="0" align="center">
    <tr>
        <td>
            頁數：
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $num_pages) {
                    echo $i . " ";
                } else {
                    echo "<a href=\"player_data_page.php?page={$i}\">{$i}</a> ";
                }
            }
            ?>
        </td>
    </tr>
</table>
</body>
</html>