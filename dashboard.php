<?php
// dashboard.php

$technical_skills = ["HTML", "CSS", "JavaScript", "PHP"];
$hardware_skills  = ["Laptop Repair", "Laptop Parts Isolation", "Reformat / Reboot"];
$soft_skills      = ["Technical Problem Solving", "Attention to Detail & UX Design", "Leadership & Adaptability", "Time Management", "Self-Learning & Growth Mindset"];

$projects = [
    ["Laptop Inventory Management System", "A CRUD-based system for managing laptop inventory."],
    ["Employee Management System", "A comprehensive system for managing employee information."],
    ["Laptop Parts Price Checklist", "A system for maintaining laptop parts pricing across branches."],
];

$experience = "4";

$stat_modals = [
    "technical_skills" => [
        "title" => "💻 Technical Skills",
        "items" => array_map(fn($s) => ["name" => $s, "desc" => ""], $technical_skills),
    ],
    "hardware_skills" => [
        "title" => "🖥️ Hardware Skills",
        "items" => array_map(fn($s) => ["name" => $s, "desc" => ""], $hardware_skills),
    ],
    "soft_skills" => [
        "title" => "🤝 Soft Skills",
        "items" => array_map(fn($s) => ["name" => $s, "desc" => ""], $soft_skills),
    ],
    "projects" => [
        "title" => "📁 Projects",
        "items" => array_map(fn($p) => ["name" => $p[0], "desc" => $p[1]], $projects),
    ],
    "experience" => [
        "title" => "🎓 Learning Experience",
        "items" => [
            ["name" => "Universidad de Manila", "desc" => "BS Information Technology with Specialization in Data Science · 2022–2026"],
            ["name" => "Eulogio Amang Rodriguez Vocational High School", "desc" => "Information and Communication Technology (ICT) · 2018–2021"],
            ["name" => "IOIO Korea English Tutorial", "desc" => "ESL Tutor · September 2023 – July 2024"],
            ["name" => "Alorica Inc.", "desc" => "Customer Care Representative (Healthcare Account) · November 2024 – July 2025"],
        ],
    ],
];
?>

<div class="hero-section">
    <div class="section about-me">
        <!-- Hero Top: Header Image -->
        <div class="hero-top">
            <img src="assets/images/header.png" alt="Lai Rache - Web Developer" class="hero-banner-img">
        </div>
    </div>

    <!-- Hero Bottom: Bio + Photo -->
    <div class="hero-body">
        <div class="hero-bio">
            <h2>About Me</h2>
            <p>I am a passionate and adaptable individual with a strong interest in technology and creative development. I specialize in building web-based systems and exploring innovative solutions that solve real-world problems.</p>
            <p>With experience in system development, database management, and user interface design, I enjoy transforming ideas into functional and user-friendly applications. Beyond technology, I also engage in creative work such as Script writing, Narrative writing and Visual art, allowing me to balance logic with creativity.</p>
            <p>Driven by growth and guided by innovation, I continuously strive to improve my skills and contribute meaningful solutions in both technical and creative fields.</p>
        </div>

        <div class="hero-photo">
            <img src="assets/images/profile.png" alt="Lai Rache" style="object-position: center top;">
        </div>
    </div>

    <!-- Stats Row 1: 3 cards -->
    <div class="stats stats-row-1">
        <div class="stat-card stat-clickable" data-modal="technical_skills">
            <h3><?php echo count($technical_skills); ?></h3>
            <p>Technical Skills</p>
            <div class="stat-hint">View all →</div>
        </div>
        <div class="stat-card stat-clickable" data-modal="hardware_skills">
            <h3><?php echo count($hardware_skills); ?></h3>
            <p>Hardware Skills</p>
            <div class="stat-hint">View all →</div>
        </div>
        <div class="stat-card stat-clickable" data-modal="soft_skills">
            <h3><?php echo count($soft_skills); ?></h3>
            <p>Soft Skills</p>
            <div class="stat-hint">View all →</div>
        </div>
    </div>

    <!-- Stats Row 2: 2 cards -->
    <div class="stats stats-row-2">
        <div class="stat-card stat-clickable" data-modal="projects">
            <h3><?php echo count($projects); ?></h3>
            <p>Projects</p>
            <div class="stat-hint">View all →</div>
        </div>
        <div class="stat-card stat-clickable" data-modal="experience">
            <h3><?php echo $experience; ?></h3>
            <p>Years of Learning Experience</p>
            <div class="stat-hint">View details →</div>
        </div>
    </div>

</div>

<script>
(function () {
    const modals = <?php echo json_encode($stat_modals); ?>;

    // Build modal on document.body so no parent CSS interferes
    const overlay = document.createElement('div');
    overlay.id = 'stat-modal-overlay';
    overlay.style.cssText = 'display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); z-index:9999; align-items:center; justify-content:center; padding:20px;';
    overlay.innerHTML = `
        <div style="background:#ffffff; border-radius:18px; padding:32px; width:100%; max-width:480px; max-height:80vh; overflow-y:auto; box-shadow:0 12px 40px rgba(0,0,0,0.18); position:relative;">
            <button id="stat-modal-close" style="position:absolute; top:14px; right:18px; background:none; border:none; font-size:22px; cursor:pointer; color:#999; line-height:1;">&times;</button>
            <h3 id="stat-modal-title" style="font-size:17px; font-weight:700; color:#8E44AD; margin-bottom:20px; padding-right:24px;"></h3>
            <ul id="stat-modal-list" style="list-style:none; padding:0; display:flex; flex-direction:column; gap:12px;"></ul>
        </div>
    `;
    document.body.appendChild(overlay);

    document.getElementById('stat-modal-close').addEventListener('click', () => {
        overlay.style.display = 'none';
    });

    overlay.addEventListener('click', function (e) {
        if (e.target === this) this.style.display = 'none';
    });

    document.querySelectorAll('.stat-clickable').forEach(card => {
        card.addEventListener('click', function () {
            const key  = this.dataset.modal;
            const data = modals[key];
            const list = document.getElementById('stat-modal-list');

            document.getElementById('stat-modal-title').textContent = data.title;
            list.innerHTML = '';

            data.items.forEach(item => {
                const li = document.createElement('li');
                li.style.cssText = 'background:#F0E0FF; border:1px solid #DBC3EA; border-radius:12px; padding:14px 16px;';
                li.innerHTML = `<div style="font-size:14px; font-weight:600; color:#8E44AD;">${item.name}</div>`
                    + (item.desc ? `<div style="font-size:12px; color:#777; margin-top:4px; line-height:1.6;">${item.desc}</div>` : '');
                list.appendChild(li);
            });

            overlay.style.display = 'flex';
        });
    });
})();
</script>