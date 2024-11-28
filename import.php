<?php
require 'vendor/autoload.php'; // PhpSpreadsheet autoload
use PhpOffice\PhpSpreadsheet\IOFactory;

include(__DIR__ . '/init/model/config/connection2.php'); // Include DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excel_file'])) {
    $file = $_FILES['excel_file']['tmp_name'];

    try {
        // Load the spreadsheet
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // Skip header row (assuming first row contains column names)
        array_shift($rows);

        foreach ($rows as $row) {
            $studentID_no = $row[0];
            $first_name = $row[1];
            $middle_name = $row[2];
            $last_name = $row[3];
            $course = $row[4];
            $year_level = $row[5];
            $date_ofbirth = $row[6];
            $gender = $row[7];
            $complete_address = $row[8];
            $email_address = $row[9];
            $mobile_number = $row[10];
            $username = $row[11];

            // Insert data into database
            $sql = "INSERT INTO tbl_student (
                    studentID_no, first_name, middle_name, last_name, course, 
                    year_level, date_ofbirth, gender, complete_address, email_address, 
                    mobile_number, username
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                )";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param(
                "ssssssssssss",
                $studentID_no, $first_name, $middle_name, $last_name, $course,
                $year_level, $date_ofbirth, $gender, $complete_address, $email_address,
                $mobile_number, $username
            );

            if (!$stmt->execute()) {
                throw new Exception("Database insertion failed: " . $stmt->error);
            }
        }

        echo "Data imported successfully.";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
