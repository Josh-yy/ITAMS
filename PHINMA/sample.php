<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sample Page</title>
</head>
<body>
<h1>Select Day: 
	<select>
		<?php
		for($i=1; $i<=31; $i++)
		{
		?>
		<option><?php echo $i; ?></option>
		<?php
		}
		?>
	</select>
</h1>
</body>
</html>