
<?php
require __DIR__ . '/vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

// Check if data is received from the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $control_no = isset($_POST['control_no']) ? $_POST['control_no'] : 'N/A';
    $studentID_no = isset($_POST['studentID_no']) ? $_POST['studentID_no'] : 'N/A';
    $email_address = isset($_POST['email_address']) ? $_POST['email_address'] : 'N/A';
    $document_name = isset($_POST['document_name']) ? $_POST['document_name'] : 'N/A';
    $no_ofcopies = isset($_POST['no_ofcopies']) ? $_POST['no_ofcopies'] : 'N/A';
    $date_request = isset($_POST['date_request']) ? $_POST['date_request'] : 'N/A';

    // Debugging: print received data
    error_log("Received data - Control No: $control_no, Student ID: $studentID_no, Email: $email_address, Document Name: $document_name, Copies: $no_ofcopies, Date Requested: $date_request");

    try {
        // Connect to the printer (adjust the path to your printer)
        $connector = new FilePrintConnector("/dev/usb/lp0");
        $printer = new Printer($connector);

        // Print content
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH | Printer::MODE_EMPHASIZED);
        //$printer->text("\n");
        $printer->text("DOCUMENT\n");
        $printer->text("REQUEST DETAILS\n");
        $printer->text("---------------------------\n");
        $printer->feed(1);
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->selectPrintMode(Printer::MODE_EMPHASIZED);
        $printer->text("Queue No: $control_no\n");
        $printer->text("Student ID: $studentID_no\n");
        $printer->text("Email Address: $email_address\n");
        $printer->text("Document: $document_name\n");
        $printer->text("Number of Copies: $no_ofcopies\n");
        $printer->text("Requested: $date_request\n");
        $printer->text("\n");
        $printer->text("---------------------------\n");
        $printer->text("Please Proceed to Cashier\nfor Payment.\n");
        $printer->text("---------------------------\n");
       	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("THANK YOU FOR USING\n");
        $printer->text("PTC REGISTRAR KIOSK!\n");
        $printer->text("\n\n");
	$printer->text("\n\n");
	//$printer->text("\n\n");
        $printer->cut();
    } catch (Exception $e) {
        error_log("Error printing: " . $e->getMessage());
    }
}
?>

