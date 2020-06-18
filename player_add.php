<?php 
include("connMysqlObj.php");
if(isset($_POST["action"])&&($_POST["action"]=="add")){
	$sql_query = "INSERT INTO players (p_name, teamID, place, height, weight, year, country) VALUES (?, ?, ?, ?, ? ,? ,?)";
	$stmt = $db_link -> prepare($sql_query);
	// bind paramter (繫結參數)
	$stmt -> bind_param("sisddis",
                      $_POST["p_name"],
                      $_POST["teamID"],
                      $_POST["place"],
                      $_POST["height"],
                      $_POST["weight"],
                      $_POST["year"],
                      $_POST["country"]);
	$stmt -> execute();
	$stmt -> close();
	$db_link -> close();
	//重新導向回到主畫面
	header("Location: player_data.php");
}
$sql_query = "SELECT t_ID, t_name FROM teams";
$result = $db_link->query($sql_query);	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>球員資料管理系統</title>
</head>
<body>
<h1 align="center">球員資料管理系統 - 新增資料</h1>
<p align="center"><a href="player_data.php">回主畫面</a></p>
<form action="" method="post" name="formAdd" id="formAdd">
  <table border="1" align="center" cellpadding="4">
    <tr>
      <th>欄位</th><th>資料</th>
    </tr>
    <tr>
      <td>球員姓名</td><td><input type="text" name="p_name" id="p_name"></td>
    </tr>
    <tr>
      <td>球隊名稱</td>
			<td>
<?php
	echo "<select name=\"teamID\" id=\"teamID\">\n";
	while($row_result=$result->fetch_assoc())
	{
    echo "\t<option value=\"" . $row_result["t_ID"] . "\">" . $row_result["t_name"] . "</option>\n";
	}
	echo "</select>\n";
?>			
			</td>
    </tr>
    <tr>
      <td>位置</td><td><input type="text" name="place" id="place"></td>
    </tr>
    <tr>
      <td>身高</td><td><input type="text" name="height" id="height"></td>
    </tr>
    <tr>
      <td>體重</td><td><input type="text" name="weight" id="weight"></td>
    </tr>
    <tr>
      <td>年資</td><td><input name="year" type="text" id="year" size="40"></td>
    </tr>
    <tr>
      <td>國籍</td><td><input name="country" type="text" id="country" size="40"></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
      <input type="hidden" name="action" value="add">
      <input type="submit" name="button" id="button" value="新增資料">
      <input type="reset" name="button2" id="button2" value="重新填寫">
      </td>
    </tr>
  </table>
</form>
</body>
</html>