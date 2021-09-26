<?php
/**
 * Script to extract text from MS Word documents
 *
 * Based on a StackOverflow answer:
 * @link https://stackoverflow.com/questions/19503653/how-to-extract-text-from-word-file-doc-docx-xlsx-pptx-php
 */


interface DocumentToText
{
	public static function getText(string $name): string;
	public static function readDocument(string $name): string;
	public static function formatText(string $text): string;
}


class DocxToHTML implements DocumentToText
{
	public static function getText(string $name): string
	{
		$content = DocxToHTML::readDocument($name);

		return DocxToHTML::formatText($content);
	}

	public static function readDocument(string $name): string
	{
		try {
			$zip = new ZipArchive;
			$unzip = $zip->open($name, 16);

			if ($unzip !== true) {
				throw new Exception("Couldn't open file: $name", 1);
			}

			$content = $zip->getFromName('word/document.xml');
			$zip->close();

			return $content;
		}
		catch (Exception $exception) {
			return $exception->getMessage();
		}
	}

	public static function formatText(string $text): string
	{
		$formattedText = $text;
		$formattedText = str_replace('</w:r></w:p></w:tc><w:tc>', ' ', $formattedText);
		$formattedText = str_replace('</w:r></w:p>', '\r\n', $formattedText);
		$formattedText = strip_tags($formattedText);
		$formattedText = str_replace('\r\n', '<br>', $formattedText);

		return $formattedText;
	}
}
