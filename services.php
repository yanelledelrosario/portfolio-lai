<?php
// services.php

$services = [
    [
        "category" => "Web Development",
        "icon"     => "🌐",
        "items"    => [
            ["title" => "Website Building",             "desc" => "Creating responsive and functional websites using HTML, CSS, JavaScript, and PHP."],
            ["title" => "Web-Based Systems",            "desc" => "Building CRUD applications and database-driven systems tailored to your needs."],
            ["title" => "Login & Authentication",       "desc" => "Implementing secure user login systems with session management and validation."],
        ]
    ],
    [
        "category" => "UI/UX Design",
        "icon"     => "🎨",
        "items"    => [
            ["title" => "Interface Design",             "desc" => "Designing clean, intuitive, and visually appealing user interfaces for web apps."],
            ["title" => "Form & Layout Design",         "desc" => "Crafting well-structured forms and page layouts with attention to usability."],
        ]
    ],
    [
        "category" => "Hardware Services",
        "icon"     => "🔧",
        "items"    => [
            ["title" => "Laptop Repair",                "desc" => "Diagnosing and repairing hardware faults including screens, motherboards, and power issues."],
            ["title" => "Parts Isolation",              "desc" => "Accurately identifying and isolating faulty laptop components for targeted repair."],
            ["title" => "Reformat & OS Reinstallation", "desc" => "Performing clean system reformats and OS reinstallation for optimal performance."],
        ]
    ],
    [
        "category" => "Content & Creative",
        "icon"     => "✍️",
        "items"    => [
            ["title" => "Script Writing",               "desc" => "Writing compelling scripts for videos, presentations, and creative projects."],
            ["title" => "Narrative Writing",            "desc" => "Crafting engaging stories, narratives, and written content for various purposes."],
            ["title" => "Visual Art",                   "desc" => "Creating visual artwork and creative design pieces for digital use."],
        ]
    ],
    [
        "category" => "Tutoring & Teaching",
        "icon"     => "📚",
        "items"    => [
            ["title" => "English Language Tutoring (Beginner - Intermediate)", "desc" => "Teaching English with focus on speaking, reading, and comprehension skills."],
            ["title" => "Mathematics Tutoring (Elementary)", "desc" => "Providing guidance and tutoring for elementary mathematics concepts."],
            ["title" => "Science Tutoring (Elementary - High School)",  "desc" => "Supporting students from elementary to high school with science concepts and experiments."],

        ]
    ],
];
?>

<div class="section">
    <h2>Services</h2>
    <p style="color:#aaa; margin-bottom: 28px; font-size:14px; padding-left:20px;">What I can do for you</p>

    <div class="services-wrapper">
        <?php foreach ($services as $group): ?>
        <div class="service-group">
            <div class="service-group-title">
                <span class="service-group-icon"><?php echo $group['icon']; ?></span>
                <?php echo $group['category']; ?>
            </div>
            <div class="service-cards">
                <?php foreach ($group['items'] as $item): ?>
                <div class="service-card">
                    <div class="service-card-title"><?php echo $item['title']; ?></div>
                    <div class="service-card-desc"><?php echo $item['desc']; ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>