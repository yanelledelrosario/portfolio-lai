<?php
// dashboard.php

$skills = ["HTML", "CSS", "JavaScript", "PHP"];

$projects = [
    ["Student Record System", "A CRUD-based system for managing student data."],
    ["Login Authentication System", "A secure login system with validation."]
];

$experience = "4 Year Learning";
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

    <!-- Stats -->
    <div class="stats">
        <div class="stat-card">
            <h3><?php echo count($skills); ?></h3>
            <p>Skills</p>
        </div>
        <div class="stat-card">
            <h3><?php echo count($projects); ?></h3>
            <p>Projects</p>
        </div>
        <div class="stat-card">
            <h3><?php echo $experience; ?></h3>
            <p>Experience</p>
        </div>
    </div>

    <div class="section about-me">
    <p>i am still thinking of what to put here</p>
           
</div>