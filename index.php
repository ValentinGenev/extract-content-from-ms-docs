<?php
/**
 * Scans directories for MS Word documents
 * and extracts their content into a
 * plain text file
 */

include_once 'document-converter.php';


$dir1		= 'D:\wamp\www\mofa-copies\\';
$level1	= scandir($dir1);

echo 'D:\wamp\www\mofa-copies\\ <br>';

// Enters categories folders
foreach ($level1 as $key => $folder_name) {
	if ($key > 1 && $key < 12) {
		$dir2		= $dir1 . $folder_name;
		$level2	= scandir($dir2);

		echo '#CAT#' . $folder_name . '<br>';

		// Lists movies
		foreach ($level2 as $key => $file_name) {
			if ($key > 1 && $file_name != 'shorts') {
				echo '<br>' . $file_name . '<br>';

				$new_doc = new Docx_Conversion($dir1 . $folder_name . '\\' . $file_name);
				echo '<br>' . $new_doc->convert_to_text() . '<br>';
			}

			if ($file_name == 'shorts') {
				$dir3		= $dir1 . $folder_name . '\shorts';
				$level3	= scandir($dir3);

				echo '<br>##SHORTS##<br>';

				// Lists movies in shorts folder
				foreach ($level3 as $key => $short_name) {
					if ($key > 1) {
						echo '<br>' . $short_name . '<br>';

						$new_doc = new Docx_Conversion($dir1 . $folder_name . '\shorts\\' . $short_name);
						echo '<br>' . $new_doc->convert_to_text() . '<br>';
					}
				}
			}
		}

		echo '<br>#END-CAT#<br>';
	}
}
