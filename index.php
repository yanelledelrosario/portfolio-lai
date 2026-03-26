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
<!-- Google Fonts: Poppins -->
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

<!-- Embedded JS at bottom -->
<script>
// Tab switching
const tabs = document.querySelectorAll('.sidebar-menu li');
const content = document.getElementById('tab-content');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        // Remove active class from all
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        const page = tab.dataset.page;
        fetch(page + '.php')
            .then(res => res.text())
            .then(data => {
                content.innerHTML = data;
            });
    });
});

// Modal popup (for future projects)
document.addEventListener('click', function(e) {
    if(e.target.classList.contains('modal-open')) {
        const modal = document.querySelector('.modal');
        modal.style.display = 'block';
    }
    if(e.target.classList.contains('modal-close')) {
        const modal = e.target.closest('.modal');
        modal.style.display = 'none';
    }
});
</script>

</body>
</html>