<?php
/**
 * Script to extract text from MS Word documents
 *
 * Based on a stackoverflow answer:
 * @link https://stackoverflow.com/questions/19503653/how-to-extract-text-from-word-file-doc-docx-xlsx-pptx-php
 */


class Docx_Conversion {
	private $filename;

	public function __construct($filePath) {
		$this->filename = $filePath;
	}

	private function read_doc() {
		$fileHandle = fopen($this->filename, 'r');
		$line       = @fread($fileHandle, filesize($this->filename));
		$lines			= explode(chr(0x0D), $line);
		$outtext		= '';

		foreach ($lines as $thisline) {
			$pos = strpos($thisline, chr(0x00));

			if ($pos !== false || strlen($thisline) == 0) {
			}
			else {
				$outtext .= $thisline . ' ';
			}
		}

		return preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/", '', $outtext);
	}

	private function read_docx() {
		$striped_content	= '';
		$content					= '';

		$zip = zip_open($this->filename);

		if (!$zip || is_numeric($zip)) return false;

		while ($zip_entry = zip_read($zip)) {
			if (zip_entry_open($zip, $zip_entry) == false) continue;
			if (zip_entry_name($zip_entry) != "word/document.xml") continue;

			$content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

			zip_entry_close($zip_entry);
		}

		zip_close($zip);

		$content					= str_replace('</w:r></w:p></w:tc><w:tc>', ' ', $content);
		$content					= str_replace('</w:r></w:p>', '\r\n', $content);
		$striped_content	= strip_tags($content);

		return $striped_content;
	}

	public function convert_to_text() {
		$fileArray = pathinfo($this->filename);
		$file_ext  = $fileArray['extension'];

		switch ($file_ext) {
			case 'doc':
				return $this->read_doc();
				break;

			case 'docx':
				return $this->read_docx();
				break;

			default:
				return 'Invalid file type';
				break;
		}
	}
}
