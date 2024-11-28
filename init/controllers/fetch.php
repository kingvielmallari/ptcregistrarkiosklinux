<?php
session_start();
include '../model/config/connection2.php';

if (!isset($_SESSION['student_id'])) {
  echo json_encode(['error' => 'Student ID not set in session']);
  exit();
}

$student_id = $_SESSION['student_id'];

if (isset($_POST['view'])) {
  if ($_POST["view"] != '') {
    $stmt = $conn->prepare('UPDATE tbl_documentrequest SET `notif` = 0 WHERE student_id = ? AND `notif` = 1');
    if ($stmt) {
      $stmt->bind_param("i", $student_id);
      $stmt->execute();
      $stmt->close();
    } else {
      echo json_encode(['error' => 'Failed to prepare statement']);
      exit();
    }
  }

  $stmt = $conn->prepare("SELECT COUNT(*) as count FROM tbl_documentrequest WHERE student_id = ? AND `notif` = 1");
  if ($stmt) {
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $unseen_count = $row['count'];
    $stmt->close();
  } else {
    echo json_encode(['error' => 'Failed to prepare statement']);
    exit();
  }

  $stmt = $conn->prepare('SELECT * FROM tbl_documentrequest WHERE student_id = ? ORDER BY request_id DESC LIMIT 10');
  if ($stmt) {
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $output = '';
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $output .= '
        <li style="background-color:#ededed;width:100%">
          <a class="nav-item" href="#" style="margin-left:10px;">
          <b><a style="color:black !important" href="./request-list.php?student=' . $student_id . '&document-name=' . $row["document_name"] . '&date-release=' . $row["date_releasing"] . '"><i class="fa fa-fw fa-file" style="color: #1269af !important"></i>Document Name: ' . $row["document_name"] . '</b></a>
          <p style="margin-left:14px;font-size:11px;color:#000000 !important;"><i class="fa fa-calendar"></i> Status: <i>' . $row["status"] . '</i></p>
          <p style="border-bottom:1px dotted blue;width:100%;"></p>
          </a>
        </li>';
      }
    } else {
      $output .= '
      <li style="color:red"><a href="#" class="text-bold text-italic"><p style="margin-left:10px;color:red">No Notification Found</p></a></li>';
    }
    $stmt->close();
  } else {
    echo json_encode(['error' => 'Failed to prepare statement']);
    exit();
  }

  $data = array(
    'notification' => $output,
    'unseen_notification' => $unseen_count
  );

  echo json_encode($data);
}
?>
