# evozoncsv
Create a program that will do CRUD (Create, Read, Update, Delete) operations on a CSV (Comma Separated Values) file. The program does not need to have a GUI (command line or just the operations in a sequence is enough)


USAGE EXAMPLE


include 'CSVProject.php'; //import the CSVProject Class

$proiect = new CSVProject("fisier.csv"); //Create a new object - if the file does not exist, it automatically creates it with dummy data

$proiect->removeLine(5); //Remove a specific line from the content array
$proiect->updateLine(6, "Marius,Danila,Sinaia,44"); //Update a specific line with new data
$proiect->appendRow("Ionel,Stoica,Beclean,57"); //Append a new row at the end of the content array
