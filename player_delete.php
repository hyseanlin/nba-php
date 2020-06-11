<?php 
	include("connMysqlObj.php");
	if(isset($_POST["action"])&&($_POST["action"]=="delete")){	
		$sql_query = "DELETE FROM players WHERE p_ID=?";
		$stmt = $db_link -> prepare($sql_query);
		$stmt -> bind_param("i", $_POST["p_ID"]);
		$stmt -> execute();
		$stmt -> close();
		$db_link -> close();
		//重新導向回到主畫面
		header("Location: player_data.php");
	}
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
<h1 align="center">NBA 球員資料管理系統 - 刪除資料</h1>
<p align="center"><a href="player_data.php">回主畫面</a></p>
<form action="" method="post" name="formDel" id="formDel">
  <table border="1" align="center" cellpadding="4">
    <tr>
      <th>欄位</th><th>資料</th>
    </tr>
    <tr>
      <td>球員姓名</td><td><?php echo $player_name;?></td>
    </tr>
    <tr>
      <td>球隊編號</td><td><?php echo $team_id; ?></td>
    </tr>
    <tr>
      <td>位置</td><td><?php echo $place; ?></td>
    </tr>
    <tr>
      <td>身高</td><td><?php echo $height; ?></td>
    </tr>
    <tr>
      <td>體重</td><td><?php echo $weight; ?></td>
    </tr>
    <tr>
      <td>年資</td><td><?php echo $year; ?></td>
    </tr>
    <tr>
      <td>國籍</td><td><?php echo $country; ?></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
      <input name="p_ID" type="hidden" value="<?php echo $player_id;?>">
      <input name="action" type="hidden" value="delete">
      <input type="submit" name="button" id="button" value="確定刪除這筆資料嗎？">
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