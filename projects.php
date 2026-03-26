<?php
// projects.php

$projects = [
    [
        "title"       => "Student Record System",
        "description" => "A CRUD-based system for managing student data. Supports adding, editing, viewing, and deleting student records with a clean interface.",
        "tags"        => ["PHP", "MySQL", "CRUD"],
    ],
    [
        "title"       => "Login Authentication System",
        "description" => "A secure login system with form validation, session handling, and password hashing to keep user accounts safe.",
        "tags"        => ["PHP", "Sessions", "Security"],
    ],
];
?>

<div class="section">
    <h2>Projects</h2>
    <p style="color:#777; margin-bottom:24px; font-size:14px;">Things I've built</p>

    <div class="projects-list">
        <?php foreach ($projects as $project): ?>
        <div class="project-card">
            <h3 class="project-title"><?php echo $project['title']; ?></h3>
            <p class="project-desc"><?php echo $project['description']; ?></p>
            <div class="project-tags">
                <?php foreach ($project['tags'] as $tag): ?>
                <span class="project-tag"><?php echo $tag; ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>