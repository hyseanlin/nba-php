<?php
include("connMysqlObj.php");
if (isset($_POST["action"]) && ($_POST["action"] == "delete")) {
    $sql_query = "DELETE FROM teams WHERE t_ID=?";
    $stmt = $db_link->prepare($sql_query);
    $stmt->bind_param("i", $_POST["t_ID"]);
    $stmt->execute();
    $stmt->close();
    $db_link->close();
    //重新導向回到主畫面
    header("Location: team_data.php");
}
$sql_select = "SELECT t_ID, t_name, zone, city, home FROM teams WHERE t_ID = ?";
$stmt = $db_link->prepare($sql_select);
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
$stmt->bind_result($t_ID, $t_name, $zone, $city, $home);
$stmt->fetch();
?>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>NBA 球隊資料管理系統</title>
    </head>
    <body>
    <h1 align="center">NBA 球隊資料管理系統 - 刪除球隊資料</h1>
    <p align="center"><a href="team_data.php">回主畫面</a></p>
    <form action="" method="post" name="formDel" id="formDel">
        <table border="1" align="center" cellpadding="4">
            <tr>
                <th>欄位</th>
                <th>資料</th>
            </tr>
            <tr>
                <td>姓名</td>
                <td><?php echo $t_name; ?></td>
            </tr>
            <tr>
                <td>性別</td>
                <td><?php echo $zone; ?></td>
            </tr>
            <tr>
                <td>生日</td>
                <td><?php echo $city; ?></td>
            </tr>
            <tr>
                <td>電子郵件</td>
                <td><?php echo $home; ?></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input name="t_ID" type="hidden" value="<?php echo $t_ID; ?>">
                    <input name="action" type="hidden" value="delete">
                    <input type="submit" name="button" id="button" value="確定刪除這筆資料嗎？">
                </td>
            </tr>
        </table>
    </form>
    </body>
    </html>
<?php
$stmt->close();
$db_link->close();
?>