<?php
/**
 * Scans directories for MS Word documents
 * and extracts their content into a
 * plain text file.
 */

include_once 'document-converter.php';


dir_digger(__DIR__ . '\documents\\', scandir(__DIR__ . '\documents\\')); // Windows path


/**
 * Goes through all the nested directries
 *
 * @param string $dir_url
 * @param array $dir_cont
 */
function dir_digger($dir_url, $dir_cont) {
	echo '<div style="margin-left: 1rem;">';
	echo '<strong>' . $dir_url . '</strong>';

	for ($i = 2; $i < count($dir_cont); $i++) {
		if (is_dir($dir_url . $dir_cont[$i])) {
			$nested_dir_url		= $dir_url . $dir_cont[$i] . '\\';
			$nested_dir_cont	= scandir($nested_dir_url);

			dir_digger($nested_dir_url, $nested_dir_cont);
		}
		else {
			$file_url		= $dir_url . $dir_cont[$i];
			$file_obj		= new Docx_Conversion($file_url);
			$file_cont	= $file_obj->convert_to_text();

			if ($file_cont !== 'Invalid file type') {
				echo '<div style="padding: 1rem;">' . $file_cont . '</div>';
			}
		}
	}

	echo '</div>';
}
