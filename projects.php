<?php
// projects.php

$projects = [
    [
        "title"       => "Laptop Inventory Management System",
        "short"       => "A CRUD-based system for managing laptop inventory.",
        "description" => "A full-featured inventory management system designed to track and manage laptop stock. Supports adding, editing, viewing, and deleting laptop records with a clean and intuitive interface. Includes search and filter functionality to quickly locate specific units, as well as status tracking for available, issued, and under-repair laptops.",
        "tags"        => ["PHP", "MySQL", "CRUD"],
        "screenshots" => [
            ["src" => "assets/images/inventory_system/Screenshot_dashboard.png",       "caption" => "Dashboard — Presents an overview of the system, including summarized data on total assets, their current status, and key metrics for monitoring inventory performance."],
            ["src" => "assets/images/inventory_system/Screenshot_addasset.png",        "caption" => "Add Asset — Displays the asset entry interface where users can input and register new assets by providing relevant details such as asset name, identification number, category, and assigned personnel."],
            ["src" => "assets/images/inventory_system/Screenshot_allassets.png",       "caption" => "All Assets — Shows a comprehensive list of all recorded assets, including their corresponding details and current status for efficient tracking and management."],
            ["src" => "assets/images/inventory_system/Screenshot_listofemployees.png", "caption" => "List of Employees — Provides a directory of employees who can be designated as accountable individuals for assigned assets within the system."],
            ["src" => "assets/images/inventory_system/Screenshot_logs.png",            "caption" => "Logs — Captures and displays system activity logs, documenting user actions along with timestamps to ensure accountability and traceability."],
            ["src" => "assets/images/inventory_system/Screenshot_manageusers.png",     "caption" => "Manage Users — Serves as the user management module, allowing administrators to create, update, and manage user accounts and their corresponding roles within the system."],
        ],
    ],
    [
        "title"       => "Employee Management System",
        "short"       => "A comprehensive system for managing employee information.",
        "description" => "A comprehensive HR system for managing employee records including personal details, department assignments, incident reports, and notices of decision. Designed to streamline administrative workflows and keep employee data organized and accessible. Features role-based access and printable report generation.",
        "tags"        => ["PHP", "MySQL", "CRUD"],
        "screenshots" => [
            ["src" => "assets/images/emp/emp-1.png", "caption" => "Screenshot coming soon."],
            ["src" => "assets/images/emp/emp-2.png", "caption" => "Screenshot coming soon."],
            ["src" => "assets/images/emp/emp-3.png", "caption" => "Screenshot coming soon."],
        ],
    ],
    [
        "title"       => "Laptop Parts Price Checklist",
        "short"       => "A system for maintaining laptop parts pricing across branches.",
        "description" => "A system for maintaining and updating laptop parts pricing information across different branches across the country. Allows administrators to set, compare, and update prices with inline editing, bulk upload via Excel/CSV, and exportable reports. Features role-based access for Admin, User, and CCR roles.",
        "tags"        => ["PHP", "MySQL", "CRUD"],
        "screenshots" => [
            ["src" => "assets/images/lpdb/Screenshot_admindashboard.png",    "caption" => "Admin Dashboard — The main admin interface displaying the full inventory table with all laptop parts. Admins can inline-edit serial numbers, descriptions, and prices directly in the table. Includes search, sort, bulk delete, and duplicate serial number detection."],
            ["src" => "assets/images/lpdb/Screenshot_dashboard.png",         "caption" => "Dashboard — The admin dashboard viewed without the sidebar open, showing the clean full-width inventory table layout with the sticky search bar and column headers."],
            ["src" => "assets/images/lpdb/Screenshot_dashboardwithsidebar.png", "caption" => "Dashboard with Sidebar — The system features a collapsible sidebar accessible across all admin pages. It can be toggled open or closed using the hamburger button in the top bar, and its state is preserved across page reloads."],
            ["src" => "assets/images/lpdb/Screenshot_adddata_manualentry.png",  "caption" => "Add Data (Manual Entry) — A modal form for manually adding a single inventory item by entering the serial number, description, and unit price. VAT Inc is automatically computed upon entering the unit price."],
            ["src" => "assets/images/lpdb/Screenshot_adddata_excelupload.png",  "caption" => "Add Data (Excel Upload) — A modal form for bulk uploading inventory data via an Excel (.xlsx) or CSV file. Automatically computes all pricing columns upon upload."],
            ["src" => "assets/images/lpdb/Screenshot_export_file.png",          "caption" => "Export File — A modal that allows the admin to select which columns to include before downloading the inventory as an Excel-compatible CSV file. All columns are pre-selected by default."],
            ["src" => "assets/images/lpdb/Screenshot_inventorylogs.png",        "caption" => "Inventory Logs — The System Logs page showing a grouped log of all inventory uploads, displaying the category, total item count, who performed the action, and the date and time. Item counts are clickable to view individual items."],
            ["src" => "assets/images/lpdb/Screenshot_activitylogs.png",         "caption" => "Activity Logs — Tracks all user actions including logins, logouts, additions, edits, and deletions. Each action is color-coded with a badge for quick identification."],
            ["src" => "assets/images/lpdb/Screenshot_manageuser.png",           "caption" => "Manage Users — The user management page where admins can add, edit, and delete user accounts. Supports three roles: Admin, User, and CCR."],
            ["src" => "assets/images/lpdb/Screenshot_userdashboard.png",        "caption" => "User Dashboard — The read-only inventory view for regular users, displaying all laptop parts with full pricing information. Includes a live search bar and a Change Password option in the top bar."],
        ],
    ],
];
?>

<div class="section">
    <h2>Projects</h2>
    <p style="color:#777; padding-left:10px; margin-bottom:24px; font-size:14px;">Things I've built — click a card to learn more</p>

    <div class="projects-list">
        <?php foreach ($projects as $i => $project): ?>
        <div class="project-card project-clickable" data-index="<?php echo $i; ?>" style="cursor:pointer;">
            <h3 class="project-title"><?php echo $project['title']; ?></h3>
            <p class="project-desc"><?php echo $project['short']; ?></p>
            <div class="project-tags">
                <?php foreach ($project['tags'] as $tag): ?>
                <span class="project-tag"><?php echo $tag; ?></span>
                <?php endforeach; ?>
            </div>
            <div class="project-view-hint">Click to view details →</div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Project Detail Modal -->
<div id="project-modal-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:999; align-items:center; justify-content:center; padding:20px;">
    <div class="project-modal-box">

        <button id="project-modal-close" style="position:absolute; top:16px; right:20px; background:none; border:none; font-size:22px; cursor:pointer; color:#999; line-height:1;">&times;</button>

        <h2 id="pm-title" style="color:var(--deep-wisteria); font-size:20px; margin-bottom:10px; padding-right:30px;"></h2>
        <div id="pm-tags" style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:16px;"></div>
        <p id="pm-desc" style="font-size:14px; color:#555; line-height:1.8; margin-bottom:24px;"></p>

        <!-- Screenshot Gallery -->
        <div id="pm-gallery-wrap">
            <div style="font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:1.2px; color:var(--soft-wisteria); margin-bottom:12px;">Screenshots</div>

            <!-- Main image -->
            <div style="background:var(--mist); border-radius:12px; overflow:hidden; margin-bottom:8px; text-align:center; min-height:200px; display:flex; align-items:center; justify-content:center;">
                <img id="pm-main-img" src="" alt="Screenshot" style="max-width:100%; max-height:360px; object-fit:contain; display:block; border-radius:8px; cursor:zoom-in;">
                <p id="pm-no-img" style="color:#bbb; font-size:13px; display:none;">Screenshots coming soon</p>
            </div>

            <!-- Caption -->
            <p id="pm-caption" style="font-size:13px; color:#666; line-height:1.7; margin-bottom:14px; min-height:20px;"></p>

            <!-- Thumbnails -->
            <div id="pm-thumbs" style="display:flex; gap:10px; flex-wrap:wrap;"></div>
        </div>

    </div>
</div>

<script>
(function () {
    const projects = <?php echo json_encode($projects); ?>;
    const overlay  = document.getElementById('project-modal-overlay');
    const closeBtn = document.getElementById('project-modal-close');
    const mainImg  = document.getElementById('pm-main-img');
    const noImg    = document.getElementById('pm-no-img');
    const captionEl= document.getElementById('pm-caption');
    const thumbsEl = document.getElementById('pm-thumbs');

    document.querySelectorAll('.project-clickable').forEach(card => {
        card.addEventListener('click', function () {
            const idx     = parseInt(this.dataset.index);
            const project = projects[idx];

            document.getElementById('pm-title').textContent = project.title;
            document.getElementById('pm-desc').textContent  = project.description;

            // Tags
            const tagsEl = document.getElementById('pm-tags');
            tagsEl.innerHTML = '';
            project.tags.forEach(tag => {
                const span = document.createElement('span');
                span.className   = 'project-tag';
                span.textContent = tag;
                tagsEl.appendChild(span);
            });

            // Screenshots
            thumbsEl.innerHTML = '';

            if (project.screenshots && project.screenshots.length > 0) {
                const first = project.screenshots[0];
                mainImg.src           = first.src;
                mainImg.style.display = 'block';
                noImg.style.display   = 'none';
                captionEl.textContent = first.caption;

                project.screenshots.forEach((shot, i) => {
                    const thumb = document.createElement('img');
                    thumb.src         = shot.src;
                    thumb.alt         = 'Screenshot ' + (i + 1);
                    thumb.className   = 'pm-thumb';
                    thumb.title       = shot.caption;
                    thumb.style.cssText = 'width:80px; height:60px; object-fit:cover; border-radius:8px; cursor:pointer; border:2px solid ' + (i === 0 ? 'var(--deep-wisteria)' : 'var(--pale-lilac)') + '; transition:border 0.2s;';
                    thumb.addEventListener('click', function () {
                        mainImg.src           = shot.src;
                        captionEl.textContent = shot.caption;
                        document.querySelectorAll('.pm-thumb').forEach(t => t.style.borderColor = 'var(--pale-lilac)');
                        this.style.borderColor = 'var(--deep-wisteria)';
                    });
                    thumbsEl.appendChild(thumb);
                });
            } else {
                mainImg.style.display = 'none';
                noImg.style.display   = 'block';
                captionEl.textContent = '';
            }

            overlay.style.display = 'flex';
        });
    });

    closeBtn.addEventListener('click', () => { overlay.style.display = 'none'; });
    overlay.addEventListener('click', function (e) {
        if (e.target === this) overlay.style.display = 'none';
    });

    // Lightbox
    const lightbox    = document.createElement('div');
    lightbox.id       = 'pm-lightbox';
    lightbox.style.cssText = 'display:none; position:fixed; inset:0; background:rgba(0,0,0,0.88); z-index:1100; align-items:center; justify-content:center; cursor:zoom-out;';
    lightbox.innerHTML = '<img id="pm-lightbox-img" style="max-width:90vw; max-height:90vh; object-fit:contain; border-radius:10px; box-shadow:0 8px 40px rgba(0,0,0,0.5);">';
    document.body.appendChild(lightbox);

    mainImg.addEventListener('click', function () {
        if (!this.src) return;
        document.getElementById('pm-lightbox-img').src = this.src;
        lightbox.style.display = 'flex';
    });

    lightbox.addEventListener('click', function () {
        this.style.display = 'none';
    });
})();
</script>