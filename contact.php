<?php
// contact.php
include 'db.php';

$success = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($conn->real_escape_string($_POST['name']    ?? ''));
    $email   = trim($conn->real_escape_string($_POST['email']   ?? ''));
    $subject = trim($conn->real_escape_string($_POST['subject'] ?? ''));
    $message = trim($conn->real_escape_string($_POST['message'] ?? ''));

    if ($name && $email && $subject && $message) {
        $sql = "INSERT INTO messages (name, email, subject, message)
                VALUES ('$name', '$email', '$subject', '$message')";
        if ($conn->query($sql)) {
            $success = "Your message has been sent! I'll get back to you soon.";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<div class="section contact-section">
    <h2>Contact Me</h2>
    <p class="contact-subtitle">Feel free to reach out — I'd love to connect!</p>

    <div class="contact-wrapper">

        <!-- Contact Info -->
        <div class="contact-info">
            <div class="contact-card">
                <div class="contact-icon">📧</div>
                <div>
                    <div class="contact-label">Email</div>
                    <div class="contact-value">lairache@email.com</div>
                </div>
            </div>
            <div class="contact-card">
                <div class="contact-icon">🔗</div>
                <div>
                    <div class="contact-label">GitHub</div>
                    <div class="contact-value">github.com/lairache</div>
                </div>
            </div>
            <div class="contact-card">
                <div class="contact-icon">💼</div>
                <div>
                    <div class="contact-label">LinkedIn</div>
                    <div class="contact-value">linkedin.com/in/lairache</div>
                </div>
            </div>
            <div class="contact-card">
                <div class="contact-icon">📍</div>
                <div>
                    <div class="contact-label">Location</div>
                    <div class="contact-value">Philippines</div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <form class="contact-form" method="POST" action="contact.php">
            <?php if ($success): ?>
                <div class="form-alert success"><?php echo $success; ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="form-alert error"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" placeholder="Your name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="your@email.com" required>
            </div>
            <div class="form-group">
                <label>Subject</label>
                <input type="text" name="subject" placeholder="What's this about?" required>
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea name="message" rows="5" placeholder="Write your message here..." required></textarea>
            </div>
            <button type="submit" class="btn-send">Send Message →</button>
        </form>

    </div>
</div>