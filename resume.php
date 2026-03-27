<?php
// resume.php

$education = [
    [
        "degree"      => "Bachelor in Information Technology with Specialization in Data Science",
        "school"      => "Universidad de Manila",
        "period"      => "2022 – 2026",
        "description" => "Learning HTML, CSS, JavaScript, and PHP through coursework and hands-on personal projects.",
    ],
];

$experience = [
    [
        "role"        => "Student Record System",
        "type"        => "Project",
        "period"      => "2024",
        "description" => "Designed and built a full CRUD application for managing student records using PHP and MySQL.",
    ],
    [
        "role"        => "Login Authentication System",
        "type"        => "Project",
        "period"      => "2024",
        "description" => "Implemented a secure user authentication system with session management and password hashing.",
    ],
];

$skills_summary = ["HTML", "CSS", "JavaScript", "PHP"];
?>

<div class="section">
    <h2>Resume</h2>
    <p style="color:#777; margin-bottom:28px; font-size:14px;">My background and learning journey</p>

    <!-- Education -->
    <div class="resume-block">
        <div class="resume-block-title">🎓 Education</div>
        <?php foreach ($education as $item): ?>
        <div class="timeline-item">
            <div class="timeline-dot"></div>
            <div class="timeline-body">
                <div class="timeline-role"><?php echo $item['degree']; ?></div>
                <div class="timeline-meta"><?php echo $item['school']; ?> · <span><?php echo $item['period']; ?></span></div>
                <div class="timeline-desc"><?php echo $item['description']; ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Experience -->
    <div class="resume-block">
        <div class="resume-block-title">Projects & Experience</div>
        <?php foreach ($experience as $item): ?>
        <div class="timeline-item">
            <div class="timeline-dot"></div>
            <div class="timeline-body">
                <div class="timeline-role"><?php echo $item['role']; ?> <span class="type-badge"><?php echo $item['type']; ?></span></div>
                <div class="timeline-meta"><?php echo $item['period']; ?></div>
                <div class="timeline-desc"><?php echo $item['description']; ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Skills Summary -->
    <div class="resume-block">
        <div class="resume-block-title">🛠 Skills</div>
        <div class="skills-summary">
            <?php foreach ($skills_summary as $skill): ?>
            <span class="skill-pill"><?php echo $skill; ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</div>