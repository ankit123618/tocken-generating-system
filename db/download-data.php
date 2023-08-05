<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once("connection.php");
require '../vendor/autoload.php'; // Include the Composer autoloader

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

# ALL DATA DOWNLOAD
if ($_GET["table"] == "all") {


    // Query the data you want to export
    $sql = 'SELECT * FROM kisaan';
    $result = mysqli_query($connection, $sql);

    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set headers for the Excel file
    $sheet->setCellValue('A1', 'name');
    $sheet->setCellValue('B1', 'tahseel');
    $sheet->setCellValue('C1', 'vitran kendra');
    $sheet->setCellValue('D1', 'phone');
    $sheet->setCellValue('E1', 'samagra');
    $sheet->setCellValue('F1', 'bahi');
    $sheet->setCellValue('G1', 'rakva');
    $sheet->setCellValue('H1', 'date of registration');
    $sheet->setCellValue('I1', 'alloted date');
    $sheet->setCellValue('J1', 'alloted time');
    // Add more headers as needed

    // Loop through the database result and populate the Excel sheet
    $row = 2; // Start from the second row since the first row is for headers
    while ($data = mysqli_fetch_assoc($result)) {
        $sheet->setCellValue('A' . $row, $data['name']);
        $sheet->setCellValue('B' . $row, $data['tahseel']);
        $sheet->setCellValue('C' . $row, $data['vitrankendra']);
        $sheet->setCellValue('D' . $row, $data['phone']);
        $sheet->setCellValue('E' . $row, $data['samagra']);
        $sheet->setCellValue('F' . $row, $data['bahi']);
        $sheet->setCellValue('G' . $row, $data['rakva']);
        $sheet->setCellValue('H' . $row, $data['date']);
        $sheet->setCellValue('I' . $row, $data['datealloted']);
        $sheet->setCellValue('J' . $row, $data['timealloted']);
        // Add more cells as needed
        $row++;
    }

    // Set headers for the Excel file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="data.xlsx"');

    // Save the Excel file to output stream
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
}

# VERIFIED DATA DOWNLOAD
if ($_GET["table"] == "verified") {


    // Query the data you want to export
    $sql = "SELECT * FROM kisaan where status = 'verified'";
    $result = mysqli_query($connection, $sql);

    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set headers for the Excel file
    $sheet->setCellValue('A1', 'name');
    $sheet->setCellValue('B1', 'tahseel');
    $sheet->setCellValue('C1', 'vitran kendra');
    $sheet->setCellValue('D1', 'phone');
    $sheet->setCellValue('E1', 'samagra');
    $sheet->setCellValue('F1', 'bahi');
    $sheet->setCellValue('G1', 'rakva');
    $sheet->setCellValue('H1', 'date of registration');
    $sheet->setCellValue('I1', 'alloted date');
    $sheet->setCellValue('J1', 'alloted time');
    // Add more headers as needed

    // Loop through the database result and populate the Excel sheet
    $row = 2; // Start from the second row since the first row is for headers
    while ($data = mysqli_fetch_assoc($result)) {
        $sheet->setCellValue('A' . $row, $data['name']);
        $sheet->setCellValue('B' . $row, $data['tahseel']);
        $sheet->setCellValue('C' . $row, $data['vitrankendra']);
        $sheet->setCellValue('D' . $row, $data['phone']);
        $sheet->setCellValue('E' . $row, $data['samagra']);
        $sheet->setCellValue('F' . $row, $data['bahi']);
        $sheet->setCellValue('G' . $row, $data['rakva']);
        $sheet->setCellValue('H' . $row, $data['date']);
        $sheet->setCellValue('I' . $row, $data['datealloted']);
        $sheet->setCellValue('J' . $row, $data['timealloted']);
        // Add more cells as needed
        $row++;
    }

    // Set headers for the Excel file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="verified-data.xlsx"');

    // Save the Excel file to output stream
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
}

# UNVERIFIED DATA DOWNLOAD
if ($_GET["table"] == "unverified") {


    // Query the data you want to export
    $sql = 'SELECT * FROM kisaan where status = "uverified"';
    $result = mysqli_query($connection, $sql);

    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set headers for the Excel file
    $sheet->setCellValue('A1', 'name');
    $sheet->setCellValue('B1', 'tahseel');
    $sheet->setCellValue('C1', 'vitran kendra');
    $sheet->setCellValue('D1', 'phone');
    $sheet->setCellValue('E1', 'samagra');
    $sheet->setCellValue('F1', 'bahi');
    $sheet->setCellValue('G1', 'rakva');
    $sheet->setCellValue('H1', 'date of registration');
    $sheet->setCellValue('I1', 'alloted date');
    $sheet->setCellValue('J1', 'alloted time');
    // Add more headers as needed

    // Loop through the database result and populate the Excel sheet
    $row = 2; // Start from the second row since the first row is for headers
    while ($data = mysqli_fetch_assoc($result)) {
        $sheet->setCellValue('A' . $row, $data['name']);
        $sheet->setCellValue('B' . $row, $data['tahseel']);
        $sheet->setCellValue('C' . $row, $data['vitrankendra']);
        $sheet->setCellValue('D' . $row, $data['phone']);
        $sheet->setCellValue('E' . $row, $data['samagra']);
        $sheet->setCellValue('F' . $row, $data['bahi']);
        $sheet->setCellValue('G' . $row, $data['rakva']);
        $sheet->setCellValue('H' . $row, $data['date']);
        $sheet->setCellValue('I' . $row, $data['datealloted']);
        $sheet->setCellValue('J' . $row, $data['timealloted']);
        // Add more cells as needed
        $row++;
    }

    // Set headers for the Excel file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="unverified-data.xlsx"');

    // Save the Excel file to output stream
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
}

# DELETED DATA DOWNLOAD
if ($_GET["table"] == "deleted") {


    // Query the data you want to export
    $sql = 'SELECT * FROM kisaan where status = "deleted"';
    $result = mysqli_query($connection, $sql);

    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set headers for the Excel file
    $sheet->setCellValue('A1', 'name');
    $sheet->setCellValue('B1', 'tahseel');
    $sheet->setCellValue('C1', 'vitran kendra');
    $sheet->setCellValue('D1', 'phone');
    $sheet->setCellValue('E1', 'samagra');
    $sheet->setCellValue('F1', 'bahi');
    $sheet->setCellValue('G1', 'rakva');
    $sheet->setCellValue('H1', 'date of registration');
    $sheet->setCellValue('I1', 'alloted date');
    $sheet->setCellValue('J1', 'alloted time');
    // Add more headers as needed

    // Loop through the database result and populate the Excel sheet
    $row = 2; // Start from the second row since the first row is for headers
    while ($data = mysqli_fetch_assoc($result)) {
        $sheet->setCellValue('A' . $row, $data['name']);
        $sheet->setCellValue('B' . $row, $data['tahseel']);
        $sheet->setCellValue('C' . $row, $data['vitrankendra']);
        $sheet->setCellValue('D' . $row, $data['phone']);
        $sheet->setCellValue('E' . $row, $data['samagra']);
        $sheet->setCellValue('F' . $row, $data['bahi']);
        $sheet->setCellValue('G' . $row, $data['rakva']);
        $sheet->setCellValue('H' . $row, $data['date']);
        $sheet->setCellValue('I' . $row, $data['datealloted']);
        $sheet->setCellValue('J' . $row, $data['timealloted']);
        // Add more cells as needed
        $row++;
    }

    // Set headers for the Excel file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="deleted-data.xlsx"');

    // Save the Excel file to output stream
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
}



# Close the database connection
mysqli_close($connection);
