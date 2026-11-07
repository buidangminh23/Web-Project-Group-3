<?php
function show_service_error() {
    $page_title = "Careers at Apple - Service unavailable";
    $page_description = "The Apple Careers student project cannot reach its database.";
    $page_keywords = "Apple Careers, service unavailable";
    $page_css = "";
    $current_page = "";
    include "header.inc";
    echo '<main id="main-content" tabindex="-1"><div class="container">';
    echo "<h1>Service unavailable</h1>";
    echo "<p>The site cannot reach its database right now. Please start MySQL in XAMPP and try again.</p>";
    echo "</div></main>";
    include "footer.inc";
    exit();
}

function connect_database($host, $user, $pwd, $sql_db) {
    mysqli_report(MYSQLI_REPORT_OFF);
    $conn = @mysqli_connect($host, $user, $pwd);
    if (!$conn) {
        show_service_error();
    }
    mysqli_set_charset($conn, "utf8mb4");
    mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `$sql_db` CHARACTER SET utf8mb4");
    if (!mysqli_select_db($conn, $sql_db)) {
        show_service_error();
    }
    return $conn;
}

function table_is_empty($conn, $table) {
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM `$table`");
    $row = mysqli_fetch_assoc($result);
    return (int) $row["total"] === 0;
}

function create_jobs_table($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS jobs (
        job_ref CHAR(5) PRIMARY KEY,
        title VARCHAR(100) NOT NULL,
        summary TEXT NOT NULL,
        salary VARCHAR(100) NOT NULL,
        reports_to VARCHAR(100) NOT NULL,
        location VARCHAR(60) NOT NULL,
        work_type VARCHAR(40) NOT NULL,
        closing_date DATE NOT NULL,
        responsibilities TEXT NOT NULL,
        essential_requirements TEXT NOT NULL,
        preferable_requirements TEXT NOT NULL,
        benefits TEXT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    mysqli_query($conn, $sql);
    if (table_is_empty($conn, "jobs")) {
        seed_jobs_table($conn);
    }
}

function seed_jobs_table($conn) {
    $benefits = "Discounts on Apple products\nEducation and training reimbursement\n"
        . "Hybrid work: three days a week in the office\nPaid parental leave\nWellbeing and volunteering days";
    $jobs = [
        ["AFE26", "Front-End Web Developer, Apple Online Store",
            "Build and improve the pages customers use to explore, compare and buy Apple products online. You will turn designs into fast, standards-based and accessible HTML and CSS that works on every screen size, from iPhone to Pro Display XDR.",
            "AUD $115,000 to $135,000 per year, plus superannuation",
            "Engineering Manager, Online Store Web Team",
            "Sydney, NSW (hybrid)", "Full time, permanent", "2027-01-31",
            "Build product and checkout pages in semantic HTML5 and CSS3 from design files.\nMake every layout responsive and test it on phones, tablets and desktop browsers.\nCheck pages against accessibility guidelines and fix issues found with tools such as WAVE.\nKeep code valid using the W3C HTML and CSS validators.\nReview other developers' code and share what you learn with the team.",
            "Strong skills in HTML5 and CSS3, including Flexbox, Grid and media queries.\nExperience building accessible websites, including forms and tables.\nExperience with Git and GitHub in a team.\nClear written and spoken communication in English.",
            "A degree or diploma in IT, computer science or a related field.\nExperience with e-commerce or retail websites.\nExperience working in an Agile team using Jira.",
            $benefits],
        ["AUX26", "Accessibility and UX Designer, Apple Online Store",
            "Help make shopping with Apple simple for every customer, including people who use screen readers, keyboards, voice control or larger text. You will design page layouts, test them with real users and work with developers to turn the results into improvements.",
            "AUD $105,000 to $125,000 per year, plus superannuation",
            "Design Lead, Online Store Experience",
            "Sydney, NSW (hybrid)", "Full time, permanent", "2027-01-31",
            "Design page layouts, forms and navigation for the online store.\nRun usability tests with customers, including people with disability.\nCheck colour contrast, heading order, alternative text and form labels in every design.\nWrite clear, plain-language content for product and help pages.\nMake sure designs avoid dark patterns such as hidden costs or trick questions.",
            "Examples of user-centred and accessible design work, from a portfolio or from study, work or community projects.\nGood knowledge of web accessibility guidelines (WCAG).\nExperience planning and running usability tests.\nBasic understanding of HTML and CSS.",
            "Experience testing with screen readers such as VoiceOver.\nExperience designing for e-commerce or retail.\nA qualification in design, human-computer interaction or a related field.",
            $benefits],
    ];
    $stmt = $conn->prepare("INSERT INTO jobs VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    foreach ($jobs as $job) {
        $stmt->bind_param("ssssssssssss", $job[0], $job[1], $job[2], $job[3], $job[4], $job[5],
            $job[6], $job[7], $job[8], $job[9], $job[10], $job[11]);
        $stmt->execute();
    }
    $stmt->close();
}

function create_eoi_table($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS eoi (
        EOInumber INT AUTO_INCREMENT PRIMARY KEY,
        job_ref CHAR(5) NOT NULL,
        first_name VARCHAR(20) NOT NULL,
        last_name VARCHAR(20) NOT NULL,
        dob DATE NOT NULL,
        gender VARCHAR(20) NOT NULL,
        street VARCHAR(40) NOT NULL,
        suburb VARCHAR(40) NOT NULL,
        state VARCHAR(3) NOT NULL,
        postcode CHAR(4) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(12) NOT NULL,
        skill_html TINYINT(1) NOT NULL DEFAULT 0,
        skill_css TINYINT(1) NOT NULL DEFAULT 0,
        other_skills TEXT NOT NULL,
        status ENUM('New', 'Current', 'Final') NOT NULL DEFAULT 'New',
        submitted_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (job_ref) REFERENCES jobs(job_ref)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    mysqli_query($conn, $sql);
}

function create_users_table($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS users (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        failed_attempts INT NOT NULL DEFAULT 0,
        locked_until DATETIME NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    mysqli_query($conn, $sql);
    if (table_is_empty($conn, "users")) {
        $username = "admin";
        $password = password_hash("admin", PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->close();
    }
}

function create_about_table($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS about (
        student_id CHAR(9) PRIMARY KEY,
        member_name VARCHAR(60) NOT NULL,
        part1_contribution TEXT NOT NULL,
        part2_contribution TEXT NOT NULL,
        quote_vietnamese VARCHAR(150) NOT NULL,
        quote_english VARCHAR(200) NOT NULL,
        display_order INT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    mysqli_query($conn, $sql);
    if (table_is_empty($conn, "about")) {
        seed_about_table($conn);
    }
}

function seed_about_table($conn) {
    $members = [
        ["105716425", "Bui Dang Minh",
            "index.html and its CSS; shared styles.css sections (base, header, navigation, footer and responsive layout); images; GitHub repository and GitHub Pages deployment.",
            "index.php; shared header.inc, nav.inc and footer.inc; settings.php and the database connection; users table, login.php, logout.php and manage.php; SQL export and final packaging.",
            "Có công mài sắt, có ngày nên kim.",
            "If you keep grinding an iron bar, one day it becomes a needle. Hard work always pays off.", 1],
        ["106229050", "Le Ho Hoang Lan",
            "jobs.html and its CSS; assistance and support with assignments, offering ideas.",
            "jobs.php and search.php; jobs table and its job data; the job search bar.",
            "Đi một ngày đàng, học một sàng khôn.",
            "A day of travelling brings a wealth of knowledge. New experiences help us learn and grow.", 2],
        ["106202475", "Nguyen Quang Thang",
            "apply.html and its CSS; assistance and support with assignments, offering ideas.",
            "apply.php and process_eoi.php; eoi table; server-side validation and sanitising of applications.",
            "Không thầy đố mày làm nên.",
            "Teachers guide us towards success. Good guidance is important for learning.", 3],
        ["106233462", "Tran Vo Nhat Minh",
            "about.html and its CSS; assistance and support with assignments, offering ideas.",
            "about.php; about table and the member contribution records; group presentation slides.",
            "Học đi đôi với hành.",
            "Learning goes together with practice. Knowledge is more useful when applied in practice.", 4],
    ];
    $stmt = $conn->prepare("INSERT INTO about VALUES (?, ?, ?, ?, ?, ?, ?)");
    foreach ($members as $member) {
        $stmt->bind_param("ssssssi", $member[0], $member[1], $member[2], $member[3],
            $member[4], $member[5], $member[6]);
        $stmt->execute();
    }
    $stmt->close();
}
?>
