<?php
if (isset($_POST["action"]) && ($_POST["action"] == "add")) {
    include("connMysqlObj.php");
    $sql_query = "INSERT INTO teams (t_name, zone, city, home) VALUES (?, ? ,? ,?)";
    $stmt = $db_link->prepare($sql_query);
    $stmt->bind_param("ssss", $_POST["t_name"], $_POST["zone"], $_POST["city"], $_POST["home"]);
    $stmt->execute();
    $stmt->close();
    $db_link->close();
    //重新導向回到主畫面
    header("Location: team_data.php");
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>NBA 球隊資料管理系統</title>
</head>
<body>
<h1 align="center">NBA 球隊資料管理系統 - 新增球隊資料</h1>
<p align="center"><a href="team_data.php">回主畫面</a></p>
<form action="" method="post" name="formAdd" id="formAdd">
    <table border="1" align="center" cellpadding="4">
        <tr>
            <th>欄位</th>
            <th>資料</th>
        </tr>
        <tr>
            <td>球隊名稱</td>
            <td><input type="text" name="t_name" id="t_name"></td>
        </tr>
        <tr>
            <td>分區</td>
            <td><input type="text" name="zone" id="zone"></td>
        </tr>
        <tr>
            <td>城市</td>
            <td><input type="text" name="city" id="city"></td>
        </tr>
        <tr>
            <td>主場</td>
            <td><input type="text" name="home" id="home"></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input name="action" type="hidden" value="add">
                <input type="submit" name="button" id="button" value="新增資料">
                <input type="reset" name="button2" id="button2" value="重新填寫">
            </td>
        </tr>
    </table>
</form>
</body>
</html>