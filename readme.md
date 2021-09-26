# Scan directories for MS Word documents
The script in this repository crawls through directories, looks for MS Word documents, extracts their content into and prints it into the browser.
Remember to change the Windows `\` with `/` in the paths if you're running the script on Linux.

## Requirements
- folder named `/documents` that will contain the documents in the root dir.

## Resources
- base on a [StackOverflow answer](https://stackoverflow.com/questions/19503653/how-to-extract-text-from-word-file-doc-docx-xlsx-pptx-php)

## TODO:
- extract the recursive search into it's own function;
- add markup parser; and
- add more supported files.
