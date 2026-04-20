<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['read'])) {
    $id = (int) $_GET['read'];
    $conn->query("UPDATE messages SET is_read = 1 WHERE id = $id");
    header('Location: index.php');
    exit;
}

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $conn->query("DELETE FROM messages WHERE id = $id");
    header('Location: index.php');
    exit;
}

$filter   = $_GET['filter'] ?? 'all';
$where    = $filter === 'unread' ? 'WHERE is_read = 0' : ($filter === 'read' ? 'WHERE is_read = 1' : '');
$messages = $conn->query("SELECT * FROM messages $where ORDER BY created_at DESC");

$total  = $conn->query("SELECT COUNT(*) as c FROM messages")->fetch_assoc()['c'];
$unread = $conn->query("SELECT COUNT(*) as c FROM messages WHERE is_read = 0")->fetch_assoc()['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script>emailjs.init('1Yj59XizZ6tXC52aY');</script>
</head>
<body>

<div class="topbar">
    <div class="topbar-title">Messages</div>
    <div class="topbar-right">
        Hi! <strong><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong>
        <button onclick="openLogoutModal()" class="btn-logout">Logout</button>
    </div>
</div>

<div class="main">

    <div class="stats-row">
        <div class="stat-box"><h3><?php echo $total; ?></h3><p>Total Messages</p></div>
        <div class="stat-box"><h3><?php echo $unread; ?></h3><p>Unread</p></div>
        <div class="stat-box"><h3><?php echo $total - $unread; ?></h3><p>Read</p></div>
    </div>

    <div class="filter-tabs">
        <a href="?filter=all"    class="filter-tab <?php echo $filter === 'all'    ? 'active' : ''; ?>">All</a>
        <a href="?filter=unread" class="filter-tab <?php echo $filter === 'unread' ? 'active' : ''; ?>">
            Unread <?php if ($unread > 0): ?><span class="unread-badge"><?php echo $unread; ?></span><?php endif; ?>
        </a>
        <a href="?filter=read"   class="filter-tab <?php echo $filter === 'read'   ? 'active' : ''; ?>">Read</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>From</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($messages->num_rows === 0): ?>
                    <tr><td colspan="5">
                        <div class="empty-state"><span>📭</span>No messages found.</div>
                    </td></tr>
                <?php else: ?>
                    <?php while ($msg = $messages->fetch_assoc()): ?>
                    <tr class="<?php echo !$msg['is_read'] ? 'unread' : ''; ?>"
                        data-name="<?php echo htmlspecialchars($msg['name']); ?>"
                        data-email="<?php echo htmlspecialchars($msg['email']); ?>"
                        data-subject="<?php echo htmlspecialchars($msg['subject']); ?>"
                        data-message="<?php echo htmlspecialchars($msg['message']); ?>"
                        data-date="<?php echo $msg['created_at']; ?>">
                        <td>
                            <div class="td-name"><?php echo htmlspecialchars($msg['name']); ?>
                                <?php if (!$msg['is_read']): ?>
                                    <span class="badge-unread">New</span>
                                <?php endif; ?>
                            </div>
                            <div class="td-email"><?php echo htmlspecialchars($msg['email']); ?></div>
                        </td>
                        <td class="td-subject"><?php echo htmlspecialchars($msg['subject']); ?></td>
                        <td class="td-message"><?php echo htmlspecialchars(substr($msg['message'], 0, 80)) . (strlen($msg['message']) > 80 ? '...' : ''); ?></td>
                        <td class="td-date"><?php echo date('M d, Y', strtotime($msg['created_at'])); ?><br><?php echo date('h:i A', strtotime($msg['created_at'])); ?></td>
                        <td>
                            <div class="actions">
                                <a href="#" class="btn-read btn-view"
                                   data-id="<?php echo $msg['id']; ?>"
                                   data-read="<?php echo $msg['is_read']; ?>">View</a>
                                <a href="#" class="btn-read btn-reply-trigger"
                                   data-email="<?php echo htmlspecialchars($msg['email']); ?>"
                                   data-name="<?php echo htmlspecialchars($msg['name']); ?>"
                                   data-subject="<?php echo htmlspecialchars($msg['subject']); ?>" data-message="<?php echo htmlspecialchars($msg['message']); ?>">Reply</a>
                                <?php if (!$msg['is_read']): ?>
                                    <a href="?read=<?php echo $msg['id']; ?>" class="btn-read">Mark Read</a>
                                <?php endif; ?>
                                <a href="#" class="btn-delete btn-delete-trigger"
                                   data-id="<?php echo $msg['id']; ?>"
                                   data-name="<?php echo htmlspecialchars($msg['name']); ?>">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- View Modal -->
<div class="modal-overlay" id="msgModal">
    <div class="modal-box">
        <h3 id="modal-subject"></h3>
        <div class="modal-meta" id="modal-meta"></div>
        <div class="modal-message" id="modal-message"></div>
        <button class="btn-close" onclick="closeModal()">Close</button>
    </div>
</div>

<!-- Reply Modal -->
<div id="replyModal" class="modal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeReplyModal()">&times;</span>
        <h3 style="margin-bottom:6px; color:var(--deep-wisteria);">Reply</h3>
        <p id="reply-to-label" style="font-size:13px; color:#888; margin-bottom:18px;"></p>
        <div class="form-group" style="margin-bottom:14px;">
            <label>Subject</label>
            <input type="text" id="reply-subject">
        </div>
        <div class="form-group" style="margin-bottom:18px;">
            <label>Message</label>
            <textarea id="reply-body" rows="6" placeholder="Write your reply..."></textarea>
        </div>
        <div id="reply-feedback" style="margin-bottom:12px; font-size:13px;"></div>
        <div style="display:flex; justify-content:flex-end; gap:10px;">
            <button onclick="closeReplyModal()" class="btn-cancel">Cancel</button>
            <button onclick="sendReply()" id="reply-send-btn" class="btn-send" style="align-self:auto;">Send Reply</button>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeDeleteModal()">&times;</span>
        <h3 style="margin-bottom:10px; color:#dc2626;">Delete Message</h3>
        <p style="font-size:14px; color:#555; margin-bottom:6px;">Are you sure you want to delete the message from</p>
        <p style="font-size:14px; font-weight:600; color:#333; margin-bottom:20px;" id="delete-name"></p>
        <p style="font-size:13px; color:#aaa; margin-bottom:20px;">This action cannot be undone.</p>
        <div style="display:flex; justify-content:flex-end; gap:10px;">
            <button onclick="closeDeleteModal()" class="btn-cancel">Cancel</button>
            <a id="delete-confirm-btn" href="#" class="btn-delete-confirm">Delete</a>
        </div>
    </div>
</div>

<!-- Logout Modal -->
<div id="logoutModal" class="modal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeLogoutModal()">&times;</span>
        <h3 style="margin-bottom:10px; color:var(--deep-wisteria);">Confirm Logout</h3>
        <p style="font-size:14px; color:#555; margin-bottom:20px;">Are you sure you want to log out?</p>
        <div style="display:flex; justify-content:flex-end; gap:10px;">
            <button onclick="closeLogoutModal()" class="btn-cancel">Cancel</button>
            <a href="logout.php" class="btn-logout-confirm">Logout</a>
        </div>
    </div>
</div>

<script>
// ── View Modal ──
document.querySelectorAll('.btn-view').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const row = this.closest('tr');
        document.getElementById('modal-subject').textContent = row.dataset.subject;
        document.getElementById('modal-meta').innerHTML =
            `<strong>From:</strong> ${row.dataset.name}<br>
             <strong>Email:</strong> ${row.dataset.email}<br>
             <strong>Date:</strong> ${row.dataset.date}`;
        document.getElementById('modal-message').textContent = row.dataset.message;
        document.getElementById('msgModal').classList.add('open');
        const id = this.dataset.id;
        if (this.dataset.read === '0') {
            fetch('?read=' + id);
            row.classList.remove('unread');
            const badge = row.querySelector('.badge-unread');
            if (badge) badge.remove();
            this.dataset.read = '1';
        }
    });
});
function closeModal() { document.getElementById('msgModal').classList.remove('open'); }
document.getElementById('msgModal').addEventListener('click', function(e) { if (e.target === this) closeModal(); });

// ── Reply Modal ──
let replyEmail = '', replyName = '';

document.querySelectorAll('.btn-reply-trigger').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        replyEmail = this.dataset.email;
        replyName  = this.dataset.name;
        document.getElementById('reply-to-label').textContent = `To: ${replyName} <${replyEmail}>`;
        document.getElementById('reply-subject').value = 'Re: ' + this.dataset.subject;
        document.getElementById('reply-body').value = '';
        document.getElementById('reply-feedback').textContent = '';
        document.getElementById('replyModal').style.display = 'flex';
    });
});

function closeReplyModal() { document.getElementById('replyModal').style.display = 'none'; }

function sendReply() {
    const subject  = document.getElementById('reply-subject').value.trim();
    const body     = document.getElementById('reply-body').value.trim();
    const feedback = document.getElementById('reply-feedback');
    const btn      = document.getElementById('reply-send-btn');

    if (!subject || !body) {
        feedback.style.color = '#dc2626';
        feedback.textContent = 'Please fill in all fields.';
        return;
    }

    btn.textContent  = 'Sending...';
    btn.disabled     = true;
    feedback.style.color = '#888';
    feedback.textContent = '';

    emailjs.send('service_h7daoem', 'template_3eud82l', {
        to_email: replyEmail,
        name:     replyName,
        subject:  subject,
        message:  body,
        reply_to: 'yanelledelrosario@gmail.com'
    })
    .then(() => {
        feedback.style.color = '#16a34a';
        feedback.textContent = '✅ Reply sent successfully!';
        btn.textContent = 'Send Reply';
        btn.disabled    = false;
        setTimeout(closeReplyModal, 1500);
    })
    .catch(err => {
        feedback.style.color = '#dc2626';
        feedback.textContent = '❌ Failed: ' + (err.text || JSON.stringify(err));
        btn.textContent = 'Send Reply';
        btn.disabled    = false;
    });
}

// ── Delete Modal ──
document.querySelectorAll('.btn-delete-trigger').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('delete-name').textContent = this.dataset.name;
        document.getElementById('delete-confirm-btn').href = '?delete=' + this.dataset.id;
        document.getElementById('deleteModal').style.display = 'flex';
    });
});
function closeDeleteModal() { document.getElementById('deleteModal').style.display = 'none'; }

// ── Logout Modal ──
function openLogoutModal()  { document.getElementById('logoutModal').style.display = 'flex'; }
function closeLogoutModal() { document.getElementById('logoutModal').style.display = 'none'; }

// Close on outside click
window.addEventListener('click', function(e) {
    if (e.target === document.getElementById('deleteModal'))  document.getElementById('deleteModal').style.display  = 'none';
    if (e.target === document.getElementById('logoutModal'))  document.getElementById('logoutModal').style.display  = 'none';
    if (e.target === document.getElementById('replyModal'))   document.getElementById('replyModal').style.display   = 'none';
});
</script>

</body>
</html>