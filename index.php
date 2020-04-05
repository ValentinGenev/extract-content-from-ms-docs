<?php
/**
 * Scans directories for MS Word documents
 * and extracts their content into a
 * plain text file.
 * 
 * The documents must be in a directory
 * named 'documetns'
 */

include_once 'document-converter.php';


dir_digger(__DIR__ . '\documents\\', scandir(__DIR__ . '\documents\\'));


/**
 * Goes through all the nested directries
 * 
 * @param string $dir_url
 * @param array $dir_cont
 */
function dir_digger($dir_url, $dir_cont) {

	for ($i = 2; $i < count($dir_cont); $i++) {
		if (is_dir($dir_url . $dir_cont[$i])) {
			$nested_dir_url		= $dir_url . $dir_cont[$i] . '\\';
			$nested_dir_cont	= scandir($nested_dir_url);

			dir_digger($nested_dir_url, $nested_dir_cont);
		}
		else {
			echo('<div style="font-family: monospace; color: rgb(0, 0, 0, .5);">' . $dir_cont[$i] . '</div>');
		}
	}
}
