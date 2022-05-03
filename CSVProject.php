<?php

/**
 * Create CRUD operations on a CSV file for Evozon Internship
 * Create a program that will do CRUD (Create, Read, Update, Delete) operations on a CSV (Comma Separated Values) file.
 * The program does not need to have a GUI (command line or just the operations in a sequence is enough)
 * Author: Andreea Gotea
 */

class CSVProject
{

	private $filename; //name of the file (string)
    private $file; //file handler
	private $content; //content of the file (array)

	/**
		* @param $name - name of the CSV file
	*/
	function __construct($name) {
        $this->filename = $name;

		if( !file_exists( $name ) ) { //check if a file with this name exists
            //if the file does not exist - populate with dummy data
            $this->populateFile();
		}
        else {
            //if the file exists, open it and read its content
            $this->openFile("r");
            $this->parseFile();
        }

	}

	/**
		* Populate the file with some dummy data
	*/
    public function populateFile() {
        $content = [
            "Prenume,Nume,Oras,Ani",
            "Andreea,Gotea,Cluj-Napoca,22",
            "Paul,Muresan,Bistrita,26",
            "Cristina,Fergo,Lugoj,32",
            "Mihalea,Pop,Sibiu,49",
            "Daniela,Sirb,Mures,51",
        ];

        foreach ($content as $key => $value) {
            $value = explode(",", $value);
            $content[$key] = $value;
        }

        $this->setContent($content);
        $this->writeFile();
    }

	/**
		* Get the name of the file
		* @return name of the csv file
	*/
	public function getFileName() {
		return $this->filename;
	}

	/**
		* Open the file handler
	*/
    public function openFile($mode) {
		$filename = $this->getFileName();

		$file = fopen($filename, $mode); //open the file having R+ privileges, meaning it has both READ and WRITE access

        $this->file = $file;
    }

	/**
		* Close the file handler
	*/
    public function closeFile() {
        fclose($this->file);
    }

	/**
		* Parse the CSV file and get it into the content array
	*/
	public function parseFile() {
		$content = [];

		while( !feof($this->file) ) {   //iterate file until we reach the end of the file

			$data = fgetcsv($this->file, 1000, ","); //filename, number of rows, separator

            if( empty($data) )
                continue;

			$content[] = $data;
		}

        $this->setContent($content);
        $this->closeFile();
	}

	/**
		* Get the content of the CSV file
		* @param $columns - false/true - to get or avoid the columns of CSV in array
		* @return content of the CSV file as array
	*/
	public function getContent($columns = true) {
        if( $columns )
		    return $this->content;

        $content = $this->content;
        unset($content[0]);

        return $content;
	}

	/**
		* Set the content of CSV file in array
	*/
	public function setContent($newContent) {
		$this->content = $newContent;
	}

	/**
		* Append a new row at the end of the content array
		* @param $data - new row data for CSV (string)
	*/
    public function appendRow($data) {
        $data = explode(",", $data);

        $this->content[] = $data;

        $this->writeFile();
    }

	/**
		* Remove a specific line from the content array
	*/
    public function removeLine($line) {

        $content = $this->getContent();

        foreach ($content as $lineNumber => $value) {
            if( $line != $lineNumber )
                continue;

            unset( $content[$line] );

            $this->setContent($content);
            break;
        }

        $this->writeFile();
    }

	/**
		* Update a specific line with new data
		* @param $line - number of the line you want to update
		* @param $newLineContent - new content for specified line - string
	*/
    public function updateLine($line, $newLineContent) {
        $content = $this->getContent();

        foreach ($content as $lineNumber => $value) {
            if( $line != $lineNumber )
                continue;

            $newLineContent = explode(",", $newLineContent);

            if( count($newLineContent) != count($content[0]) )
                break;

            $content[$lineNumber] = $newLineContent;
            $this->setContent($content);
            break;
        }

        $this->writeFile();
    }

	/**
		* Write the content array into a CSV file
	*/
    public function writeFile() {

        $this->openFile("w");

        $content = $this->getContent();

        foreach ($content as $row) {
            if(empty($row))
                continue;

            fputcsv($this->file, $row);
        }

        $this->closeFile();

    }

}
