# Scan directories for MS Word documents
The script in this repository crawls through directories, looks for MS Word documents, extracts their content into and prints it into the browser.
Remember to change the Windows `\` with `/` in the paths if you're running the script on Linux.

## Requirements
- folder named `/documetns` that will contain the documents in the root dir.

## Known issues
- in Windows, the script can't output `.doc` files properly, outputs a string of random characters.

## Resoruces
- base on a [stackoverflow answer](https://stackoverflow.com/questions/19503653/how-to-extract-text-from-word-file-doc-docx-xlsx-pptx-php)
