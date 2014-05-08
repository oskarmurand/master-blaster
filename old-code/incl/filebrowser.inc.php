<?php

if (!@include_once("./incl/auth.inc.php"))
 include_once("../incl/auth.inc.php");

if (!isset($_GET['sortby'])) $_GET['sortby']	= "filename";
if (!isset($_GET['order'])) $_GET['order']	= "asc";

print "<table class='menu' cellpadding=2 cellspacing=0>";
 print "<tr>";
  if ($AllowCreateFolder) print "<td align='center' valign='bottom'><a href='$base_url&amp;path=".htmlentities(rawurlencode($path))."&amp;action=create&amp;type=directory'><img src='icon/newfolder.gif' width=20 height=22 alt='$StrMenuCreateFolder' border=0>&nbsp;$StrMenuCreateFolder</a></td>";
  if ($AllowCreateFile) print "<td align='center' valign='bottom'><a href='$base_url&amp;path=".htmlentities(rawurlencode($path))."&amp;action=create&amp;type=file'><img src='icon/newfile.gif' width=20 height=22 alt='$StrMenuCreateFile' border=0>&nbsp;$StrMenuCreateFile</a></td>";
  if ($AllowUpload) print "<td align='center' valign='bottom'><a href='$base_url&amp;path=".htmlentities(rawurlencode($path))."&amp;action=upload'><img src='icon/upload.gif' width=20 height=22 alt='$StrMenuUploadFiles' border=0>&nbsp;$StrMenuUploadFiles</a></td>";
  if ($phpfm_auth) print "<td align='center' valign='bottom'><a href='$base_url&amp;action=logout'><img src='icon/logout.gif' width=20 height=22 alt='$StrMenuLogOut' border=0>&nbsp;$StrMenuLogOut</a></td>";
 print "</tr>";
print "</table><br />";

print "<table class='index' cellpadding=0 cellspacing=0>";
 print "<tr>";
  print "<td class='iheadline' colspan=4 align='center' height=21>";
   print "<font class='iheadline'>$StrIndexOf&nbsp;".get_linked_path($path,$base_url)."</font>";
  print "</td>";
 print "</tr>";
 print "<tr>";
  print "<td>&nbsp;</td>";
  print "<td class='fbborder' valign='top'>";



  if ($open = @opendir($home_directory.$path))
  {
   for($i=0;($directory = readdir($open)) != FALSE;$i++)
    if (is_dir($home_directory.$path.$directory) && $directory != "." && $directory != ".." && !is_hidden_directory($home_directory.$path.$directory))
      $directories[$i] = array($directory,$directory);
   closedir($open);

   if (isset($directories))
   {
    sort($directories);
    reset($directories);
   }
  }

  print "<table class='directories' width=300 cellpadding=1 cellspacing=0>";
   print "<tr>";
    print "<td class='bold' width=20>&nbsp;</td>";
    print "<td class='bold'>&nbsp;$StrFolderNameShort</td>";
    if ($AllowRename) print "<td class='bold' width=20 align='center'>$StrRenameShort</td>";
    if ($AllowDelete) print "<td class='bold' width=20 align='center'>$StrDeleteShort</td>";
   print "</tr>";
   print "<tr>";
    print "<td width=20><a href='$base_url&amp;path=".htmlentities(rawurlencode($path))."'><img src='icon/folder.gif' width=20 height=22 alt='$StrOpenFolder' border=0></a></td>";
    print "<td>&nbsp;<a href='$base_url'>.</a></td>";
    print "<td width=20>&nbsp;</td>";
    print "<td width=20>&nbsp;</td>";
   print "</tr>";
   print "<tr>";
    print "<td width=20><a href='$base_url&amp;path=".htmlentities(rawurlencode(dirname($path)))."/'><img src='icon/folder.gif' width=20 height=22 alt='$StrOpenFolder' border=0></a></td>";
    print "<td>&nbsp;<a href='$base_url&amp;path=".htmlentities(rawurlencode(dirname($path)))."/'>..</a></td>";
    print "<td width=20>&nbsp;</td>";
    print "<td width=20>&nbsp;</td>";
   print "</tr>";
  if (isset($directories)) foreach($directories as $directory)
  {
   print "<tr>";
    print "<td width=20><a href='$base_url&amp;path=".htmlentities(rawurlencode($path.$directory[0]))."/'><img src='icon/folder.gif' width=20 height=22 alt='$StrOpenFolder' border=0></a></td>";
    print "<td>&nbsp;<a href='$base_url&amp;path=".htmlentities(rawurlencode($path.$directory[0]))."/'>".htmlentities($directory[0])."</a></td>";
    if ($AllowRename) print "<td width=20><a href='$base_url&amp;path=".htmlentities(rawurlencode($path))."&amp;directory_name=".htmlentities(rawurlencode($directory[0]))."/&amp;action=rename'><img src='icon/rename.gif' width=20 height=22 alt='$StrRenameFolder' border=0></a></td>";
    if ($AllowDelete) print "<td width=20><a href='$base_url&amp;path=".htmlentities(rawurlencode($path))."&amp;directory_name=".htmlentities(rawurlencode($directory[0]))."/&amp;action=delete'><img src='icon/delete.gif' width=20 height=22 alt='$StrDeleteFolder' border=0></a></td>";
   print "</tr>";
  }
   print "<tr><td colspan=4>&nbsp;</td></tr>";
  print "</table>";

  print "</td>";
  print "<td>&nbsp;</td>";
  print "<td valign='top'>";



  if ($open = @opendir($home_directory.$path))
  {
   for($i=0;($file = readdir($open)) != FALSE;$i++)
    if (is_file($home_directory.$path.$file) && !is_hidden_file($home_directory.$path.$file))
    {
     $icon = get_icon($file);
     $filesize = filesize($home_directory.$path.$file);
     $permissions = decoct(fileperms($home_directory.$path.$file)%01000);
     $modified = filemtime($home_directory.$path.$file);
     $extension = "";
     $files[$i] = array(
                         "icon"        => $icon,
                         "filename"    => $file,
                         "filesize"    => $filesize,
                         "permissions" => $permissions,
                         "modified"    => $modified,
                         "extension"   => $extension,
                       );
    }
   closedir($open);

   if (isset($files))
   {
    usort($files, "compare_filedata");
    reset($files);
   }
  }

  print "<table class='files' width=500 cellpadding=1 cellspacing=0>";
   print "<tr>";
    print "<td class='bold' width=20>&nbsp;</td>";
    print "<td class='bold'>&nbsp;<a href='$base_url&amp;path=".htmlentities(rawurlencode($path))."&amp;sortby=filename&amp;order=".get_opposite_order("filename", $_GET['order'])."'>$StrFileNameShort</a></td>";
    print "<td class='bold' width=60 align='center'><a href='$base_url&amp;path=".htmlentities(rawurlencode($path))."&amp;sortby=filesize&amp;order=".get_opposite_order("filesize", $_GET['order'])."'>$StrFileSizeShort</a></td>";
    print "<td class='bold' width=35 align='center'><a href='$base_url&amp;path=".htmlentities(rawurlencode($path))."&amp;sortby=permissions&amp;order=".get_opposite_order("permissions", $_GET['order'])."'>$StrPermissionsShort</a></td>";
    print "<td class='bold' width=110 align='center'><a href='$base_url&amp;path=".htmlentities(rawurlencode($path))."&amp;sortby=modified&amp;order=".get_opposite_order("modified", $_GET['order'])."'>$StrLastModifiedShort</a></td>";
    if ($AllowView) print "<td class='bold' width=20 align='center'>$StrViewShort</td>";
    if ($AllowEdit) print "<td class='bold' width=20 align='center'>$StrEditShort</td>";
    if ($AllowRename) print "<td class='bold' width=20 align='center'>$StrRenameShort</td>";
    if ($AllowDownload) print "<td class='bold' width=20 align='center'>$StrDownloadShort</td>";
    if ($AllowDelete) print "<td class='bold' width=20 align='center'>$StrDeleteShort</td>";
   print "</tr>";
  if (isset($files)) foreach($files as $file)
  {
   $file['filesize'] = get_better_filesize($file['filesize']);
   $file['modified'] = date($ModifiedFormat, $file['modified']);

   print "<tr>";
    print "<td width=20><img src='icon/".$file['icon']."' width=20 height=22 border=0 alt='$StrFile'></td>";
    print "<td>&nbsp;".htmlentities($file['filename'])."</td>";
    print "<td width=60 align='right'>".$file['filesize']."</td>";
    print "<td width=35 align='center'>".$file['permissions']."</td>";
    print "<td width=110 align='right'>".$file['modified']."</td>";
    if ($AllowView && is_viewable_file($file['filename'])) print "<td width=20><a href='$base_url&amp;path=".htmlentities(rawurlencode($path))."&amp;filename=".htmlentities(rawurlencode($file['filename']))."&amp;action=view&amp;size=100'><img src='icon/view.gif' width=20 height=22 alt='$StrViewFile' border=0></a></td>";
    else if ($AllowView) print "<td width=20>&nbsp;</td>";
    if ($AllowEdit && is_editable_file($file['filename'])) print "<td width=20><a href='$base_url&amp;path=".htmlentities(rawurlencode($path))."&amp;filename=".htmlentities(rawurlencode($file['filename']))."&amp;action=edit'><img src='icon/edit.gif' width=20 height=22 alt='$StrEditFile' border=0></a></td>";
    else if ($AllowEdit) print "<td width=20>&nbsp;</td>";
    if ($AllowRename) print "<td width=20><a href='$base_url&amp;path=".htmlentities(rawurlencode($path))."&amp;filename=".htmlentities(rawurlencode($file['filename']))."&amp;action=rename'><img src='icon/rename.gif' width=20 height=22 alt='$StrRenameFile' border=0></a></td>";
    if ($AllowDownload) print "<td width=20><a href='$base_url&amp;path=".htmlentities(rawurlencode($path))."&amp;filename=".htmlentities(rawurlencode($file['filename']))."&amp;action=download'><img src='icon/download.gif' width=20 height=22 alt='$StrDownloadFile' border=0></a></td>";
    if ($AllowEdit) print "<td width=20><a href='$base_url&amp;path=".htmlentities(rawurlencode($path))."&amp;filename=".htmlentities(rawurlencode($file['filename']))."&amp;action=delete'><img src='icon/delete.gif' width=20 height=22 alt='$StrDeleteFile' border=0></a></td>";
   print "</tr>";

  }
   print "<tr><td colspan=9>&nbsp;</td></tr>";
  print "</table>";


  print "</td>";
 print "</tr>";
print "</table>";

?>