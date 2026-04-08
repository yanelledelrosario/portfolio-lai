<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lai's Portfolio</title>
<link rel="stylesheet" href="assets/style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<?php include 'sidebar.php'; ?>

<!-- Main Content -->
<div class="main-content">
    <div id="tab-content">
        <?php include 'dashboard.php'; ?>
    </div>
</div>

<script>
const tabs = document.querySelectorAll('.topbar-menu li:not(.admin-link)');
const content = document.getElementById('tab-content');

// Re-runs <script> tags injected via innerHTML (they don't execute automatically)
function runScripts(container) {
    container.querySelectorAll('script').forEach(oldScript => {
        const newScript = document.createElement('script');
        newScript.textContent = oldScript.textContent;
        oldScript.parentNode.replaceChild(newScript, oldScript);
    });
}

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        const page = tab.dataset.page;
        fetch(page + '.php')
            .then(res => res.text())
            .then(data => {
                content.innerHTML = data;
                runScripts(content); // <-- execute any scripts in the loaded page
            });
    });
});

// Modal popup
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-open')) {
        const modal = document.querySelector('.modal');
        modal.style.display = 'flex';
    }
    if (e.target.classList.contains('modal-close')) {
        const modal = e.target.closest('.modal');
        modal.style.display = 'none';
    }
});
</script>

</body>
</html>