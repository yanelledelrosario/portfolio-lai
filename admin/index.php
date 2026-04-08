<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}



// Mark message as read
if (isset($_GET['read'])) {
    $id = (int) $_GET['read'];
    $conn->query("UPDATE messages SET is_read = 1 WHERE id = $id");
    header('Location: index.php');
    exit;
}

// Delete message
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $conn->query("DELETE FROM messages WHERE id = $id");
    header('Location: index.php');
    exit;
}

// Fetch messages
$filter = $_GET['filter'] ?? 'all';
$where  = $filter === 'unread' ? 'WHERE is_read = 0' : ($filter === 'read' ? 'WHERE is_read = 1' : '');
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
    
</head>
<body>

<div class="topbar">
    <div class="topbar-title">Messages</div>
    <div class="topbar-right">
        Hi!<strong><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong>
        <button onclick="openLogoutModal()" class="btn-logout">Logout</button>    </div>
</div>

<div class="main">

    <!-- Stats -->
    <div class="stats-row">
        <div class="stat-box">
            <h3><?php echo $total; ?></h3>
            <p>Total Messages</p>
        </div>
        <div class="stat-box">
            <h3><?php echo $unread; ?></h3>
            <p>Unread</p>
        </div>
        <div class="stat-box">
            <h3><?php echo $total - $unread; ?></h3>
            <p>Read</p>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="filter-tabs">
        <a href="?filter=all"    class="filter-tab <?php echo $filter === 'all'    ? 'active' : ''; ?>">All</a>
        <a href="?filter=unread" class="filter-tab <?php echo $filter === 'unread' ? 'active' : ''; ?>">
            Unread <?php if ($unread > 0): ?><span class="unread-badge"><?php echo $unread; ?></span><?php endif; ?>
        </a>
        <a href="?filter=read"   class="filter-tab <?php echo $filter === 'read'   ? 'active' : ''; ?>">Read</a>
    </div>

    <!-- Messages Table -->
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
                        <div class="empty-state">
                            <span>📭</span>
                            No messages found.
                        </div>
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
                                <?php if (!$msg['is_read']): ?>
                                    <a href="?read=<?php echo $msg['id']; ?>" class="btn-read">Mark Read</a>
                                <?php endif; ?>
                                <a href="?delete=<?php echo $msg['id']; ?>" class="btn-delete"
                                   onclick="return confirm('Delete this message?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- View Message Modal -->
<div class="modal-overlay" id="msgModal">
    <div class="modal-box">
        <h3 id="modal-subject"></h3>
        <div class="modal-meta" id="modal-meta"></div>
        <div class="modal-message" id="modal-message"></div>
        <button class="btn-close" onclick="closeModal()">Close</button>
    </div>
</div>
<!-- Logout Modal -->
<div id="logoutModal" class="modal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeLogoutModal()">&times;</span>
        <h3 style="margin-bottom:10px; color: var(--deep-wisteria);">Confirm Logout</h3>
        <p style="font-size:14px; color:#555; margin-bottom:20px;">
            Are you sure you want to log out?
        </p>

        <div style="display:flex; justify-content:flex-end; gap:10px;">
            <button onclick="closeLogoutModal()" class="btn-cancel">Cancel</button>
            <a href="logout.php" class="btn-logout-confirm">Logout</a>
        </div>
    </div>
</div>
<script>
document.querySelectorAll('.btn-view').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const row = this.closest('tr');
        document.getElementById('modal-subject').textContent  = row.dataset.subject;
        document.getElementById('modal-meta').innerHTML =
            `<strong>From:</strong> ${row.dataset.name}<br>
             <strong>Email:</strong> ${row.dataset.email}<br>
             <strong>Date:</strong> ${row.dataset.date}`;
        document.getElementById('modal-message').textContent = row.dataset.message;
        document.getElementById('msgModal').classList.add('open');

        // Auto mark as read
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

function closeModal() {
    document.getElementById('msgModal').classList.remove('open');
}

document.getElementById('msgModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

// Logout Modal
function openLogoutModal() {
    document.getElementById("logoutModal").style.display = "flex";
}

function closeLogoutModal() {
    document.getElementById("logoutModal").style.display = "none";
}

// Close when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById("logoutModal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
}

</script>

</body>
</html>