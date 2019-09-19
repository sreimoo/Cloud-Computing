<!DOCTYPE html>
<html lang = "en">
<head>
  <meta charset = "utf-8"/>
  <meta name = "description" content = "Assignment-1b Cloud Computing Architecture"/>
  <meta name = "keywords" content ="ec2,aws,cloud"/>
  <meta name = "author" content = "Sanee Salim - 101887181"
  <link rel = "stylesheet" src = "getphotos.css"/>
  <title>Upload to Photo Album</title>
</head>
<body>
  <h1>
Photo Uploader
  </h1>
<h2>Student ID: 101887181</h2>
<h2>Name: Sanee Salim</h2>
<form action="pupload.php" method="post" enctype="multipart/form-data">
<fieldset>
  <p><label for="PhotoTitle"><b> Photo Title: </b></label>
  <input type="text" name="PhotoTitle" id = "PhotoTitle"/>
  </p>
  <p>
<label for = "Date"><b> Date : </b></label>
<input type = "date" name ="Date" id ="Date"/>
</p>
<p>
<label for = "Keywords" ><b> Keyword: </b></label></p>
<p>
<input type="text" name="Keywords" id = "Keywords" />
  </p>
  <p>
    <input type = "file" name = "fname">

<input type="submit" value="upload"/>

  </p>
  </fieldset>
</form>
  </body>
</html>
  