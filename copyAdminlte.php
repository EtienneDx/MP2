<?php

function rrmdir($dir) {
	if (is_dir($dir)) {
	 $objects = scandir($dir);
	 foreach ($objects as $object) {
	   if ($object != "." && $object != "..") {
	     if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
	       rrmdir($dir. DIRECTORY_SEPARATOR .$object);
	     else
	       unlink($dir. DIRECTORY_SEPARATOR .$object);
	   }
	 }
	 rmdir($dir);
	}
}

function recurseCopy($src, $dst)
{
	rrmdir($dst);
	mkdir($dst);
  $dir = opendir($src);
  while(false !== ( $file = readdir($dir)) ) {
    if (( $file != '.' ) && ( $file != '..' )) {
      if ( is_dir($src . DIRECTORY_SEPARATOR . $file) ) {
        recurseCopy($src . DIRECTORY_SEPARATOR . $file, $dst . DIRECTORY_SEPARATOR . $file);
      } else {
        copy($src . DIRECTORY_SEPARATOR . $file,$dst . DIRECTORY_SEPARATOR . $file);
      }
    }
  }
  closedir($dir);
}

recurseCopy('.' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'almasaeed2010' . DIRECTORY_SEPARATOR . 'adminlte' . DIRECTORY_SEPARATOR . 'dist',
	'.' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'adminlte' . DIRECTORY_SEPARATOR . 'dist');
recurseCopy('.' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'almasaeed2010' . DIRECTORY_SEPARATOR . 'adminlte' . DIRECTORY_SEPARATOR . 'bower_components',
	'.' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'adminlte' . DIRECTORY_SEPARATOR . 'bower_components');
