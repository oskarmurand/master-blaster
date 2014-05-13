<?php
  $src = $_POST['orig'];
  if(empty($src))
  {
    echo("You didn't select any files.");
  }
  else
  {
    $N = count($src);
 
    echo("You selected $N file(s): ");
    for($i=0; $i < $N; $i++)
    {
      echo($src[$i] . "<br />");
    }
  }

//=================================//
//          Copy Function          //
//=================================//

function xcopy($src, $dest) { 
  foreach (scandir($src) as $file) { 
    $srcfile = rtrim($src, '/') .'/'. $file; 
    $destfile = rtrim($dest, '/') .'/'. $file; 
    if (!is_readable($srcfile)) { 
      continue; 
    } if ($file != '.' && $file != '..') 
    { if (is_dir($srcfile)) { 
      if (!file_exists($destfile)) { 
        mkdir($destfile); 
      } xcopy($srcfile, $destfile); 
    } else { copy($srcfile, $destfile); } } } }

// Copy action

$inputdest = 'files/';
  for($i=0; $i < $N; $i++)
  {
      if(is_dir($src[$i])){
        //$src = "../".$src[$i];
        mkdir($inputdest.$src[$i]);
        $dest = $inputdest.$src[$i];
        $src = $src[$i];
        xcopy($src, $dest);
      } else { copy($src[$i], $dest."/".$src[$i]); }
  }


?>