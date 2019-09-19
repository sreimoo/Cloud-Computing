<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8 " />
	<title>Show photos</title>
  <meta name = "description" content = "Assignment-1b Cloud Computing Architecture"/>
  <meta name = "keywords" content ="ec2,aws,cloud"/>
  <meta name = "author" content = "Sanee Salim - 101887181"/>
  <link rel = "stylesheet" src = "getphotos.css"/>
  
</head>
<body>

<?php
	require_once "settings.php";	
	$conn = @mysqli_connect ($host,$user,$pwd,$sql_db);	
	if (!$conn) {
		echo "<p> Database connection failure</p>".mysqli_connect_error();
	} 
	else{
		$title = trim($_POST["PhotoTitle"]);
		$datestart = trim($_POST["DateStart"]);
		$datefinish = trim($_POST["DateFinish"]);
		$keyword = trim($_POST["Keywords"]);
		
	$sql_table = "photos";
	$istitle = false;
	$isdatestart = false;
	$isdatefinish = false;
	$iskeyword = false;
	
	if($title > ""){
		$istitle = true;
	}
	if($datestart > ""){
		$isdatestart = true;
	}
	if($datefinish > ""){
		$isdatefinish = true;
	}
	if($keyword >""){
		$iskeyword = true;
	}
	
	//1111checked
	if($istitle && $isdatestart && iskeyword && isdatefinish){
		echo("1111");
		$query = "select * from $sql_table P INNER JOIN Keywords K ON P.title = K.title where P.title like '$title' and (DateOfPhoto BETWEEN '$datestart' and '$datefinish' OR (DateOfPhoto like '$datefinish' OR DateOfPhoto like '$datestart')) or keyword like '$keyword' group by P.title;";	 
	}
	//1011checked
	else if($istitle && !$isdatestart && $iskeyword && isdatefinish){
		echo("1011");
		$query = "select * from $sql_table P INNER JOIN Keywords K ON P.title = K.title where P.title like '$title' and keyword like '$keyword' and DateOfPhoto like '$datefinish';";
	}
	//1101notworking
	else if($istitle && $isdatestart && !$iskeyword && isdatefinish){
		echo("1101");
		$query = "select * from $sql_table P INNER JOIN Keywords K ON P.title = K.title where P.title like '$title' and DateOfPhoto BETWEEN '$datestart' and '$datefinish';";
	}
	
	//0111 checked
	else if(!$istitle && $isdatestart && $iskeyword && isdatefinish){
		echo("0111");
		$query = "select * from $sql_table P INNER JOIN Keywords K ON P.title = K.title where (DateOfPhoto BETWEEN '$datestart' and '$datefinish' OR (DateOfPhoto like '$datefinish' OR DateOfPhoto like '$datestart'))and keyword like '$keyword';";
	}
	//0011 checked
	else if(!$istitle && !$isdatestart && iskeyword && isdatefinish){
		echo("0011");
		$query = "select  * from $sql_table P INNER JOIN Keywords K ON P.title = K.title where keyword like '$keyword' or DateOfPhoto like '$datefinish' group by P.title;";	 
	}
	//0101notworking
	else if(!$istitle && $isdatestart && !iskeyword && $isdatefinish){
		echo("0101");
		$query = "select * from $sql_table P INNER JOIN Keywords K ON P.title = K.title where DateOfPhoto BETWEEN '$datestart' and '$datefinish';";	 
	}
	//1001verynotworking
	else if($istitle && !$isdatestart && !iskeyword && $isdatefinish){
		echo("1001");
		$query = "select * from $sql_table P INNER JOIN Keywords K ON P.title = K.title where P.title like '$title' and DateOfPhoto like '$datefinish';";	
	}
	//0001notworking
	else if(!$istitle && !$isdatestart && !iskeyword && $isdatefinish){
		echo("0001");
		$query = "select * from $sql_table P INNER JOIN Keywords K ON P.title = K.title where DateOfPhoto like '$datefinish';";	 
	}
	
	//1110checked
	else if($istitle && $isdatestart && iskeyword && !isdatefinish){
		echo("1110");
		$query = "select * from $sql_table P INNER JOIN Keywords K ON P.title = K.title where P.title like '$title' and DateOfPhoto like '$datestart'and keyword like '$keyword';";	 
	}
	//1010checked
	else if($istitle && !$isdatestart && $iskeyword &&!isdatefinish){
		echo("1010");
		$query = "select * from $sql_table P INNER JOIN Keywords K ON P.title = K.title where P.title like '$title' and keyword like '$keyword';";
	}
	//1100notworking
	else if($istitle && $isdatestart && !$iskeyword &&!isdatefinish){
		echo("1100");
		$query = "select * from $sql_table P INNER JOIN Keywords K ON P.title = K.title where P.title like '$title' and  DateOfPhoto like '$datestart';";
	}
	//0110 checked
	else if(!$istitle && $isdatestart && $iskeyword &&!isdatefinish){
		echo("0110");
		$query = "select * from $sql_table P INNER JOIN Keywords K ON P.title = K.title where DateOfPhoto like '$datestart' and keyword like '$keyword';";
	}
	//0010 checked
	else if(!$istitle && !$isdate && iskeyword && !isdatefinish){
		echo("0010");
		$query = "select * from $sql_table P INNER JOIN Keywords K ON P.title = K.title where keyword like '$keyword';";	 
	}
	//0100notworking
	else if(!$istitle && $isdate && !iskeyword && !$isdatefinish){
		echo("0100");
		$query = "select * from $sql_table P INNER JOIN Keywords K ON P.title = K.title where DateOfPhoto like '$datestart';";	 
	}
	//1000verynotworking
	else if($istitle && !$isdate && !iskeyword && !$isdatefinish){
		echo("1000");
		$query = "select * from $sql_table P INNER JOIN Keywords K ON P.title = K.title where P.title like '$title';";	
	}
	//0000checked
	else if(!$istitle && !$isdate && !iskeyword && !$isdatefinish){
		echo("0000");
		$query = "select * from $sql_table P INNER JOIN Keywords K ON P.title = K.title;";	 
	}
	else{
		$query = "select * from $sql_table P INNER JOIN Keywords K ON P.title = K.title where keyword like 'nature';";
	}
	
	$result = mysqli_query($conn,$query);
		if (!$result) {					
		echo "<p> Something is wrong with query</p>";
		echo $query;
			}
			else {
				
		echo "<table border = \"1\">\n";
		echo "<tr>\n"
			."<th scope =\"col\"> title </th>\n"
			."<th scope =\"col\"> date </th>\n"
			."<th scope =\"col\"> keyword </th>\n"
			."<th scope =\"col\"> description </th>\n"
			."<th scope =\"col\"> reference </th>\n"
			."</tr>\n";
		while($row = mysqli_fetch_assoc($result)){
			
			echo "<tr>\n";
			echo "<td>",$row["title"],"</td>\n";
			echo "<td>",$row["DateOfPhoto"],"</td>\n";
			echo "<td>",$row["keyword"],"</td>\n";
			echo "<td>",$row["description"],"</td>\n";
			echo "<td>",$row["reference"],"</td>\n";
			echo "</tr>\n";
		}
		echo "</table>\n";
		mysqli_free_result($result);
		}
		mysqli_close ($conn);					// Close the database connect
	} 
	
?>	
</body>
</html>