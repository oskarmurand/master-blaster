<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>FILE BROWSER</title>
</head>
<body>
	
		<pre>
	<?
		$path = realpath('/www/data01/users/e/erikweb.planet.ee/htdocs/');
		foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $filename) {
        	echo "<li>$filename</li>";
		}
	?>
		</pre>
	
</body>
</html>