<?php
/**
 * Scans directories for MS Word documents
 * and extracts their content into a
 * plain text file.
 */

include_once 'inc/document-converter.php';


dir_digger(__DIR__ . '\documents\\', scandir(__DIR__ . '\documents\\')); // Windows path


/**
 * Goes through all the nested directories
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
			// TODO: add the file check around here:
			$fileName = $dir_url . $dir_cont[$i];
			$fileContent = DocxToHTML::getText($fileName);

			if ($fileContent !== 'Invalid file type') {
				echo '<div style="padding: 1rem;">' . $fileContent . '</div>';
			}
		}
	}

	echo '</div>';
}
