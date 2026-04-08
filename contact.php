<?php
// contact.php
include 'admin/db.php';

// Handle AJAX POST — return JSON, never redirect
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $name    = trim($conn->real_escape_string($_POST['name']    ?? ''));
    $email   = trim($conn->real_escape_string($_POST['email']   ?? ''));
    $subject = trim($conn->real_escape_string($_POST['subject'] ?? ''));
    $message = trim($conn->real_escape_string($_POST['message'] ?? ''));

    if (!$name || !$email || !$subject || !$message) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all fields.']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
        exit;
    }

    $sql = "INSERT INTO messages (name, email, subject, message)
            VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Something went wrong. Please try again.']);
    }
    exit;
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
        <div class="contact-form">
            <div id="contact-alert" class="form-alert" style="display:none;"></div>

            <div class="form-group">
                <label>Name</label>
                <input type="text" id="c-name" placeholder="Your name">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" id="c-email" placeholder="your@email.com">
            </div>
            <div class="form-group">
                <label>Subject</label>
                <input type="text" id="c-subject" placeholder="What's this about?">
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea id="c-message" rows="5" placeholder="Write your message here..."></textarea>
            </div>
            <button class="btn-send" id="contact-submit">Send Message →</button>
        </div>

    </div>
</div>

<!-- Success Modal -->
<div id="sent-modal-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.35); z-index:999; align-items:center; justify-content:center;">
    <div style="background:#e8dff5; border-radius:24px; padding:48px 40px; max-width:420px; width:90%; text-align:center; box-shadow:0 8px 32px rgba(80,0,120,0.15);">
        <p style="font-size:1.3rem; font-weight:600; color:#1a1a2e; margin-bottom:12px; line-height:1.5;">
            Your message has been sent!<br>I'll get back to you as soon as I can.
        </p>
        <p style="color:#555; font-size:0.95rem; margin-bottom:28px;">How would you like to continue?</p>
        <button id="modal-dashboard-btn" style="display:block; width:100%; padding:14px; margin-bottom:12px; background:#7c3aed; color:#fff; border:none; border-radius:50px; font-size:1rem; font-family:inherit; cursor:pointer; font-weight:500;">
            Back to Dashboard
        </button>
        <button id="modal-another-btn" style="display:block; width:100%; padding:14px; background:#7c3aed; color:#fff; border:none; border-radius:50px; font-size:1rem; font-family:inherit; cursor:pointer; font-weight:500;">
            Send another message
        </button>
    </div>
</div>

<script>
(function () {
    const btn     = document.getElementById('contact-submit');
    const alertEl = document.getElementById('contact-alert');
    const overlay = document.getElementById('sent-modal-overlay');

    function showError(msg) {
        alertEl.textContent = msg;
        alertEl.className = 'form-alert error';
        alertEl.style.display = 'block';
        setTimeout(() => { alertEl.style.display = 'none'; }, 5000);
    }

    function clearForm() {
        document.getElementById('c-name').value    = '';
        document.getElementById('c-email').value   = '';
        document.getElementById('c-subject').value = '';
        document.getElementById('c-message').value = '';
    }

    btn.addEventListener('click', function () {
        const name    = document.getElementById('c-name').value.trim();
        const email   = document.getElementById('c-email').value.trim();
        const subject = document.getElementById('c-subject').value.trim();
        const message = document.getElementById('c-message').value.trim();

        if (!name || !email || !subject || !message) {
            showError('Please fill in all fields.');
            return;
        }

        btn.disabled = true;
        btn.textContent = 'Sending...';

        const formData = new FormData();
        formData.append('name',    name);
        formData.append('email',   email);
        formData.append('subject', subject);
        formData.append('message', message);

        fetch('contact.php', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    clearForm();
                    overlay.style.display = 'flex';
                } else {
                    showError(data.message);
                }
            })
            .catch(() => showError('Something went wrong. Please try again.'))
            .finally(() => {
                btn.disabled = false;
                btn.textContent = 'Send Message →';
            });
    });

    // Back to Dashboard — click the dashboard tab
    document.getElementById('modal-dashboard-btn').addEventListener('click', function () {
        overlay.style.display = 'none';
        const dashTab = document.querySelector('.topbar-menu li[data-page="dashboard"]');
        if (dashTab) dashTab.click();
    });

    // Send another message — just close modal, form already cleared
    document.getElementById('modal-another-btn').addEventListener('click', function () {
        overlay.style.display = 'none';
    });
})();
</script>