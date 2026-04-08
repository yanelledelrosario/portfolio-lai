<?php
// resume.php

$education = [
    [
        "degree" => "Bachelor of Science in Information Technology (Data Science)",
        "school" => "Universidad de Manila",
        "period" => "2022 – 2026",
        "description" => "Focused on web development, data analysis, and system design with hands-on projects and academic training.",
    ],
    [
        "degree" => "Information and Communication Technology (ICT)",
        "school" => "Eulogio Amang Rodriguez Vocational High School",
        "period" => "2018 – 2021",
        "description" => "Studied computer systems, programming basics, and IT fundamentals.",
    ],
    [
        "degree" => "Cosmetology (Tech-Voc Course)",
        "school" => "Eulogio Amang Rodriguez Vocational High School",
        "period" => "2014 – 2018",
        "description" => "Completed technical-vocational training while developing discipline and attention to detail.",
    ],
];

$experience = [
    [
        "role" => "ESL Tutor",
        "type" => "Work",
        "period" => "September 2023 – July 2024",
        "description" => "Conducted English lessons focusing on speaking, reading, and comprehension while helping students improve language skills.",
    ],
    [
        "role" => "Customer Care Representative (Healthcare Account)",
        "type" => "Work",
        "period" => "November 2024 – July 2025",
        "description" => "Handled healthcare inquiries, resolved concerns efficiently, and maintained high customer satisfaction.",
    ],
    [
        "role" => "Work Immersion – IT Department (Developer)",
        "type" => "Experience",
        "period" => "CREOTEC Philippines",
        "description" => "Gained hands-on experience in IT development and real-world technical problem solving.",
    ],
    [
        "role" => "Google Philippines Seminar & She++ Workshop",
        "type" => "Workshop",
        "period" => "Industry Exposure",
        "description" => "Participated in tech seminars and workshops focused on innovation and development.",
    ],
];

$skills_summary = [
    "Technical Problem Solving",
    "Attention to Detail & UX Design",
    "Leadership & Adaptability",
    "Time Management",
    "Self-Learning & Growth Mindset",
    "HTML",
    "CSS",
    "JavaScript",
    "PHP"
];
?>

<div class="section">
    <h2>Resume</h2>
    <p style="color:#777; margin-bottom:28px; padding-left:10px; font-size:14px;">
        My background and learning journey
    </p>

    <!-- Education -->
    <div class="resume-block">
        <div class="resume-block-title">🎓 Education</div>

        <?php foreach ($education as $item): ?>
        <div class="timeline-item">
            <div class="timeline-dot"></div>
            <div class="timeline-body">
                <div class="timeline-role"><?php echo $item['degree']; ?></div>
                <div class="timeline-meta">
                    <?php echo $item['school']; ?> · 
                    <span><?php echo $item['period']; ?></span>
                </div>
                <div class="timeline-desc"><?php echo $item['description']; ?></div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>

    <!-- Experience -->
    <div class="resume-block">
        <div class="resume-block-title">💼 Experience & Exposure</div>

        <?php foreach ($experience as $item): ?>
        <div class="timeline-item">
            <div class="timeline-dot"></div>
            <div class="timeline-body">
                <div class="timeline-role">
                    <?php echo $item['role']; ?>
                    <span class="type-badge"><?php echo $item['type']; ?></span>
                </div>
                <div class="timeline-meta"><?php echo $item['period']; ?></div>
                <div class="timeline-desc"><?php echo $item['description']; ?></div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>

    <!-- Skills -->
    <div class="resume-block">
        <div class="resume-block-title">🛠 Skills</div>
        <div class="skills-summary">
            <?php foreach ($skills_summary as $skill): ?>
                <span class="skill-pill"><?php echo $skill; ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</div>