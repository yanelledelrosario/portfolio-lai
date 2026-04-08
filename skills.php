<?php
// skills.php

$skills = [
    ["name" => "HTML",       "level" => 90, "tag" => "Markup"],
    ["name" => "CSS",        "level" => 80, "tag" => "Styling"],
    ["name" => "JavaScript", "level" => 70, "tag" => "Logic"],
    ["name" => "PHP",        "level" => 65, "tag" => "Backend"],
];
?>

<div class="section">
    <h2>Skills</h2>
    <p style="color:#777; padding-left: 10px; margin-bottom:24px; font-size:14px;">Technologies I work with</p>

    <div class="skills-grid">
        <?php foreach ($skills as $skill): ?>
        <div class="skill-card">
            <div class="skill-top">
                <span class="skill-name"><?php echo $skill['name']; ?></span>
                <span class="skill-tag"><?php echo $skill['tag']; ?></span>
            </div>
            <div class="skill-bar-track">
                <div class="skill-bar-fill" style="width: <?php echo $skill['level']; ?>%"></div>
            </div>
            <div class="skill-percent"><?php echo $skill['level']; ?>%</div>
        </div>
        <?php endforeach; ?>
    </div>
</div>