<?php

include 'CSVProject.php'; //import the CSVProject Class

$proiect = new CSVProject("fisier.csv"); //Create a new object - if the file does not exist, it automatically creates it with dummy data

$proiect->removeLine(5); //Remove a specific line from the content array
$proiect->updateLine(6, "Marius,Danila,Sinaia,44"); //Update a specific line with new data
$proiect->appendRow("Ionel,Stoica,Beclean,57"); //Append a new row at the end of the content array

$content = $proiect->getContent(); //Get the content (stored in the CSV file as well)
print_r($content);

?>
