<?php
// sidebar.php
?>

<!-- Topbar -->
<div class="topbar">
    <div class="topbar-left" onclick="window.open('admin/login.php', '_blank')" style="cursor:pointer;" title="Admin Panel">
        <img src="assets/images/logo.png" alt="Logo" class="logo-img">
        <span class="logo-text">Lai's Portfolio</span>
    </div>

    <ul class="topbar-menu">
        <li class="active" data-page="dashboard">Dashboard</li>
        <li data-page="skills">Skills</li>
        <li data-page="projects">Projects</li>
        <li data-page="resume">Resume</li>
        <li data-page="contact">Contact</li>
    </ul>
</div>