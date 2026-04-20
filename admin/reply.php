<?php
// admin/reply.php
session_start();
include 'db.php';
include 'mailer.php';

header('Content-Type: application/json');

if (!isset($_SESSION['admin_logged_in'])) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
    exit;
}

$id      = (int)   ($_POST['id']      ?? 0);
$subject = trim(   $_POST['subject']  ?? '');
$body    = trim(   $_POST['body']     ?? '');

if (!$id || !$subject || !$body) {
    echo json_encode(['success' => false, 'error' => 'All fields are required.']);
    exit;
}

// Get the original message sender
$stmt = $conn->prepare("SELECT name, email FROM messages WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$msg    = $result->fetch_assoc();

if (!$msg) {
    echo json_encode(['success' => false, 'error' => 'Message not found.']);
    exit;
}

$result = sendReply($msg['email'], $msg['name'], $subject, $body);
echo json_encode($result);