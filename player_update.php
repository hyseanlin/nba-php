<?php
	include("connMysqlObj.php");
	if(isset($_POST["action"])&&($_POST["action"]=="update")){
		$sql_query = "UPDATE players SET p_name=?, teamID=?, place=?, height=?, weight=?, year=?, country=? WHERE p_ID=?";
		$stmt = $db_link -> prepare($sql_query);
		$stmt -> bind_param("sisddisi",
                      $_POST["p_name"], 
                      $_POST["teamID"], 
                      $_POST["place"], 
                      $_POST["height"], 
                      $_POST["weight"], 
                      $_POST["year"], 
                      $_POST["country"], 
                      $_POST["p_ID"]);
		$stmt -> execute();
		$stmt -> close();
		$db_link -> close();
		//重新導向回到主畫面
		header("Location: player_data.php");
	}
	$sql_query = "SELECT t_ID, t_name FROM teams";
	$result = $db_link->query($sql_query);	

	$sql_select = "SELECT p_ID, p_name, teamID, place, height, weight, year, country FROM players WHERE p_ID = ?";
	$stmt = $db_link -> prepare($sql_select);
	$stmt -> bind_param("i", $_GET["id"]);
	$stmt -> execute();
	
	$stmt -> bind_result($player_id, $player_name, $team_id, $place, $height, $weight, $year, $country);
	$stmt -> fetch();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NBA 球員資料管理系統</title>
</head>
<body>
<h1 align="center">NBA 球員資料管理系統 - 修改資料</h1>
<p align="center"><a href="player_data.php">回主畫面</a></p>
<form action="" method="post" name="formFix" id="formFix">
  <table border="1" align="center" cellpadding="4">
    <tr>
      <th>欄位</th><th>資料</th>
    </tr>
    <tr>
      <td>球員</td><td><input type="text" name="p_name" id="p_name" value="<?php echo $player_name;?>"></td>
    </tr>
    <tr>
      <td>球隊編號</td>
			<td>
<?php
	echo "<select name=\"teamID\" id=\"teamID\">\n";
	while($row_result=$result->fetch_assoc())
	{
		if ($row_result["t_ID"] == $team_id)
    	echo "\t<option value=\"" . $row_result["t_ID"] . "\" selected>" . $row_result["t_name"] . "</option>\n";
		else
    	echo "\t<option value=\"" . $row_result["t_ID"] . "\">" . $row_result["t_name"] . "</option>\n";
	}
	echo "</select>\n";
?>			
			</td>
    </tr>
    <tr>
      <td>位置</td><td><input type="text" name="place" id="place" value="<?php echo $place;?>"></td>
    </tr>
    <tr>
      <td>身高</td><td><input type="text" name="height" id="height" value="<?php echo $height;?>"></td>
    </tr>
    <tr>
      <td>體重</td><td><input type="text" name="weight" id="weight" value="<?php echo $weight;?>"></td>
    </tr>
    <tr>
      <td>年資</td><td><input name="year" type="year" id="year" size="40" value="<?php echo $year;?>"></td>
    </tr>
    <tr>
      <td>國籍</td><td><input name="country" type="country" id="country" size="40" value="<?php echo $country;?>"></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
      <input name="p_ID" type="hidden" value="<?php echo $player_id;?>">
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
	$stmt -> close();
	$db_link -> close();
?>