<?php
include 'sidebar.php';
// ===== TEMP DATA (can move later) =====
$skills = ["HTML", "CSS", "JavaScript", "PHP"];

$projects = [
    ["Student Record System", "A CRUD-based system for managing student data."],
    ["Login Authentication System", "A secure login system with validation."]
];

$experience = "4 Year Learning";
?>

<link rel="stylesheet" href="assets/style.css">
<div class="section">

    <!-- Welcome -->
    <div class="dashboard-header">
        <h2>Dashboard</h2>
        <p>Hello, I'm <strong>Lai</strong> 👋</p>
        <p class="tagline">An Aspiring Web Developer passionate about building modern web systems.</p>
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

    <!--  Highlights -->
    <div class="section highlight-section">
        <h3>Highlights</h3>
        <ul class="highlights-list">
            <li>Strong problem-solving mindset</li>
            <li>Adaptable and quick learner</li>
            <li>Focused on web development and UI design</li>
            <li>Driven by growth and continuous improvement</li>
        </ul>
    </div>

</div>