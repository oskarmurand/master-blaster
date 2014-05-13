<?php


$list = glob('*');
usort(
   $list,
   create_function('$b,$a', 'return filemtime($a) - filemtime($b);')
);

// Show results:
//echo "<table>\n";
echo "<form action='check.php' method='post'>";
foreach($list as $file)
{
   printf(
      "<input type='checkbox' name='orig[]' value='".$file."' />".$file."<br />"
   );
}
//echo "</table>\n";
echo "<input type='submit' name='formSubmit' value='Copy' /></form>";


?>