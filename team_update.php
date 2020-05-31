<?php
include("connMysqlObj.php");
if (isset($_POST["action"]) && ($_POST["action"] == "update")) {
    $sql_query = "UPDATE teams SET t_name=?, zone=?, city=?, home=? WHERE t_ID=?";
    $stmt = $db_link->prepare($sql_query);
    $stmt->bind_param("ssssi", $_POST["t_name"], $_POST["zone"], $_POST["city"], $_POST["home"], $_POST["t_ID"]);
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
    <h1 align="center">NBA 球隊資料管理系統 - 修改球隊資料</h1>
    <p align="center"><a href="team_data.php">回主畫面</a></p>
    <form action="" method="post" name="formFix" id="formFix">
        <table border="1" align="center" cellpadding="4">
            <tr>
                <th>欄位</th>
                <th>資料</th>
            </tr>
            <tr>
                <td>球隊名稱</td>
                <td><input type="text" name="t_name" id="t_name" value="<?php echo $t_name; ?>"></td>
            </tr>
            <tr>
                <td>分區</td>
                <td><input type="text" name="zone" id="zone" value="<?php echo $zone; ?>"></td>
            </tr>
            <tr>
                <td>城市</td>
                <td><input type="text" name="city" id="city" value="<?php echo $city; ?>"></td>
            </tr>
            <tr>
                <td>主場</td>
                <td><input type="text" name="home" id="home" value="<?php echo $home; ?>"></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input name="t_ID" type="hidden" value="<?php echo $t_ID; ?>">
                    <input name="action" type="hidden" value="update">
                    <input type="submit" name="button" id="button" value="更新資料">
                    <input type="reset" name="button2" id="button2" value="重新填寫">
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