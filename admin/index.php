<?php
// admin/index.php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

include '../db.php';

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
    <title>Admin — Messages</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --deep-wisteria: #8E44AD;
            --classic-wisteria: #9B59B6;
            --soft-wisteria: #BB8FCE;
            --pale-lilac: #DBC3EA;
            --mist: #F0E0FF;
            --white: #FFFFFF;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #f7f0ff; min-height: 100vh; }

        /* Topbar */
        .topbar {
            position: fixed;
            top: 0; left: 0; width: 100%;
            height: 60px;
            background: var(--white);
            border-bottom: 2px solid var(--pale-lilac);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 36px;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(142,68,173,0.08);
        }
        .topbar-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--deep-wisteria);
        }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 13px;
            color: #888;
        }
        .btn-logout {
            background: var(--mist);
            border: 1px solid var(--pale-lilac);
            color: var(--deep-wisteria);
            border-radius: 8px;
            padding: 7px 16px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-logout:hover { background: var(--pale-lilac); }

        /* Main */
        .main {
            margin-top: 80px;
            padding: 0 36px 40px;
            max-width: 1100px;
        }

        /* Stats row */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }
        .stat-box {
            background: var(--white);
            border: 1px solid var(--pale-lilac);
            border-radius: 14px;
            padding: 20px 24px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(142,68,173,0.06);
        }
        .stat-box h3 {
            font-size: 32px;
            font-weight: 700;
            color: var(--deep-wisteria);
        }
        .stat-box p {
            font-size: 12px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-top: 4px;
        }
        .unread-badge {
            display: inline-block;
            background: var(--deep-wisteria);
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 99px;
            margin-left: 6px;
        }

        /* Filter tabs */
        .filter-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
        }
        .filter-tab {
            padding: 7px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            color: var(--classic-wisteria);
            background: var(--white);
            border: 1px solid var(--pale-lilac);
            transition: all 0.2s;
        }
        .filter-tab:hover, .filter-tab.active {
            background: var(--deep-wisteria);
            color: var(--white);
            border-color: var(--deep-wisteria);
        }

        /* Messages table */
        .table-wrap {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--pale-lilac);
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(142,68,173,0.06);
        }
        table { width: 100%; border-collapse: collapse; }
        thead {
            background: var(--mist);
        }
        thead th {
            padding: 14px 20px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--deep-wisteria);
        }
        tbody tr {
            border-top: 1px solid #f3eaff;
            transition: background 0.15s;
        }
        tbody tr:hover { background: #faf5ff; }
        tbody tr.unread { background: #fdf8ff; }
        tbody td {
            padding: 16px 20px;
            font-size: 14px;
            color: #444;
            vertical-align: top;
        }
        .td-name { font-weight: 600; color: #333; }
        .td-email { font-size: 12px; color: #888; margin-top: 2px; }
        .td-subject { font-weight: 500; color: var(--deep-wisteria); }
        .td-message { font-size: 13px; color: #666; max-width: 300px; }
        .td-date { font-size: 12px; color: #aaa; white-space: nowrap; }
        .badge-unread {
            display: inline-block;
            background: var(--deep-wisteria);
            color: white;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 99px;
            margin-left: 6px;
            vertical-align: middle;
        }
        .actions { display: flex; gap: 8px; }
        .btn-read {
            font-size: 12px;
            padding: 5px 12px;
            border-radius: 7px;
            text-decoration: none;
            font-weight: 500;
            background: var(--mist);
            color: var(--deep-wisteria);
            border: 1px solid var(--pale-lilac);
            transition: background 0.2s;
        }
        .btn-read:hover { background: var(--pale-lilac); }
        .btn-delete {
            font-size: 12px;
            padding: 5px 12px;
            border-radius: 7px;
            text-decoration: none;
            font-weight: 500;
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
            transition: background 0.2s;
        }
        .btn-delete:hover { background: #fee2e2; }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #bbb;
            font-size: 15px;
        }
        .empty-state span { display: block; font-size: 40px; margin-bottom: 12px; }

        /* View message modal */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 999;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.open { display: flex; }
        .modal-box {
            background: var(--white);
            border-radius: 16px;
            padding: 36px;
            width: 90%;
            max-width: 540px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }
        .modal-box h3 {
            font-size: 18px;
            font-weight: 700;
            color: var(--deep-wisteria);
            margin-bottom: 16px;
        }
        .modal-meta { font-size: 13px; color: #888; margin-bottom: 16px; line-height: 1.8; }
        .modal-meta strong { color: #444; }
        .modal-message {
            background: var(--mist);
            border-radius: 10px;
            padding: 16px 18px;
            font-size: 14px;
            color: #333;
            line-height: 1.8;
            margin-bottom: 20px;
        }
        .btn-close {
            background: var(--mist);
            border: 1px solid var(--pale-lilac);
            color: var(--deep-wisteria);
            border-radius: 8px;
            padding: 9px 20px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="topbar">
    <div class="topbar-title">🔐 Admin Panel — Messages</div>
    <div class="topbar-right">
        Hi, <strong><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
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
</script>

</body>
</html>