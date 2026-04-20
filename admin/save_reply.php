<?php
// admin/save_reply.php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

include 'db.php';

$message_id = (int) ($_POST['message_id'] ?? 0);
$to_email   = trim($conn->real_escape_string($_POST['to_email']  ?? ''));
$to_name    = trim($conn->real_escape_string($_POST['to_name']   ?? ''));
$subject    = trim($conn->real_escape_string($_POST['subject']   ?? ''));
$body       = trim($conn->real_escape_string($_POST['body']      ?? ''));

if (!$message_id || !$to_email || !$subject || !$body) {
    echo json_encode(['success' => false, 'error' => 'Missing fields.']);
    exit;
}

$sql = "INSERT INTO replies (message_id, to_email, to_name, subject, body)
        VALUES ('$message_id', '$to_email', '$to_name', '$subject', '$body')";

if ($conn->query($sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}
?>