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
        <div class="stat-card">
            <h3><?php echo count($technical_skills); ?></h3>
            <p>Technical Skills</p>
        </div>
        <div class="stat-card">
            <h3><?php echo count($hardware_skills); ?></h3>
            <p>Hardware Skills</p>
        </div>
        <div class="stat-card">
            <h3><?php echo count($soft_skills); ?></h3>
            <p>Soft Skills</p>
        </div>
    </div>

    <!-- Stats Row 2: 2 cards -->
    <div class="stats stats-row-2">
        <div class="stat-card">
            <h3><?php echo count($projects); ?></h3>
            <p>Projects</p>
        </div>
        <div class="stat-card">
            <h3><?php echo $experience; ?></h3>
            <p>Years of Learning Experience</p>
        </div>
    </div>

</div>

<div class="section about-me">
    <p>when hovered it should a short list of my skills and projects</p>
           
</div>