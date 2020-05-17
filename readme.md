# Scan directories for MS Word documents
The script in this repository crawls through directories, looks for MS Word documents, extracts their content into and prints it into the browser.
Remember to change the Windows `\` with `/` in the paths if you're running the script on Linux.

## Requirements
- folder named `/documetns` that will contain the documents in the root dir.

## Known issues
- in Windows, the script can't output `.doc` files properly, outputs a string of random characters (`Y, B8L 1(IzZYrH9pd4n(KgVB,lDAeX)Ly5otebW3gpj/gQjZTae9i5j5fE514g7vnO( ,jV9kvvadVoTAn7jahy@ARhW.GMuO /e5sZWfPtfkA0zUw@tAm4T2j 6Q`).

## Resoruces
- base on a [stackoverflow answer](https://stackoverflow.com/questions/19503653/how-to-extract-text-from-word-file-doc-docx-xlsx-pptx-php)
