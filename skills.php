<?php
// skills.php

$technical_skills = [
    ["name" => "HTML",       "desc" => "Building structured and semantic web pages.",          "icon" => "🌐"],
    ["name" => "CSS",        "desc" => "Styling and designing responsive user interfaces.",    "icon" => "🎨"],
    ["name" => "JavaScript", "desc" => "Adding interactivity and logic to web applications.", "icon" => "⚡"],
    ["name" => "PHP",        "desc" => "Server-side scripting and backend development.",      "icon" => "🖥️"],
];

$hardware_skills = [
    ["name" => "Laptop Repair",          "desc" => "Diagnosing and fixing hardware faults including motherboard, screen, and power issues.", "icon" => "🔧"],
    ["name" => "Laptop Parts Isolation", "desc" => "Identifying and isolating faulty components to pinpoint hardware failures accurately.",  "icon" => "🔍"],
    ["name" => "Reformat / Reboot",      "desc" => "Performing system reformats, OS reinstallation, and clean reboots for optimal performance.", "icon" => "💿"],
];

$soft_skills = [
    ["name" => "Technical Problem Solving",       "desc" => "Debugging hardware, software, and network issues.",                         "icon" => "🛠️"],
    ["name" => "Attention to Detail & UX Design", "desc" => "Creating polished scripts, intuitive forms, and interfaces.",               "icon" => "✏️"],
    ["name" => "Leadership & Adaptability",       "desc" => "Coordinating projects across technical, creative, and educational domains.", "icon" => "🌟"],
    ["name" => "Time Management",                 "desc" => "Efficiently balancing school, tech, and creative projects.",                "icon" => "⏰"],
    ["name" => "Self-Learning & Growth Mindset",  "desc" => "Continuously acquiring new tools, languages, and techniques.",             "icon" => "📈"],
];
?>

<div class="section">
    <h2>Skills</h2>
    <p style="color:#aaa; margin-bottom:24px; font-size:14px; padding-left:20px;">Technologies & strengths I bring to the table</p>

    <!-- Technical Skills -->
    <div class="skills-block-title">Technical Skills</div>
    <div class="soft-skills-grid">
        <?php foreach ($technical_skills as $skill): ?>
        <div class="soft-skill-card">
            <div class="soft-skill-icon"><?php echo $skill['icon']; ?></div>
            <div>
                <div class="soft-skill-name"><?php echo $skill['name']; ?></div>
                <div class="soft-skill-desc"><?php echo $skill['desc']; ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Hardware Skills -->
    <div class="skills-block-title" style="margin-top: 28px;">Hardware Skills</div>
    <div class="soft-skills-grid">
        <?php foreach ($hardware_skills as $skill): ?>
        <div class="soft-skill-card">
            <div class="soft-skill-icon"><?php echo $skill['icon']; ?></div>
            <div>
                <div class="soft-skill-name"><?php echo $skill['name']; ?></div>
                <div class="soft-skill-desc"><?php echo $skill['desc']; ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Soft Skills -->
    <div class="skills-block-title" style="margin-top: 28px;">Soft Skills</div>
    <div class="soft-skills-grid">
        <?php foreach ($soft_skills as $skill): ?>
        <div class="soft-skill-card">
            <div class="soft-skill-icon"><?php echo $skill['icon']; ?></div>
            <div>
                <div class="soft-skill-name"><?php echo $skill['name']; ?></div>
                <div class="soft-skill-desc"><?php echo $skill['desc']; ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</div>