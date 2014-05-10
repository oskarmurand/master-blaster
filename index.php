<?php require_once('header.php'); ?>
	
	<pre>
		<?
		$path = realpath('/www/data01/users/e/erikweb.planet.ee/htdocs/');
		foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $filename) {
        	echo "$filename".PHP_EOL;
		}
		?>
	</pre>

<?php require_once('footer.php'); ?>
	
