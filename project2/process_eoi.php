<?php
require_once "functions.php";
require_once "settings.php";
require_once "db_functions.php";

start_secure_session();

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["job_ref"], $_POST["first_name"], $_POST["last_name"])) {
    header("Location: apply.php");
    exit();
}

$field_names = ["job_ref", "first_name", "last_name", "dob", "gender", "street", "suburb",
    "state", "postcode", "email", "phone", "other_skills"];
$values = [];
foreach ($field_names as $name) {
    $values[$name] = isset($_POST[$name]) ? sanitise_input($_POST[$name]) : "";
}

$skill_html = 0;
$skill_css = 0;
if (isset($_POST["skills"]) && is_array($_POST["skills"])) {
    foreach ($_POST["skills"] as $skill) {
        if ($skill === "html") {
            $skill_html = 1;
        }
        if ($skill === "css") {
            $skill_css = 1;
        }
    }
}
$values["skill_html"] = $skill_html;
$values["skill_css"] = $skill_css;

$allowed_genders = ["female" => true, "male" => true, "non-binary" => true, "not-stated" => true];
$allowed_states = ["VIC" => true, "NSW" => true, "QLD" => true, "NT" => true, "WA" => true,
    "SA" => true, "TAS" => true, "ACT" => true];
$errors = [];

if (!preg_match("/^[A-Za-z0-9]{5}$/", $values["job_ref"])) {
    $errors["job-ref"] = "Job reference number must be exactly 5 letters or numbers.";
}
if (!preg_match("/^[A-Za-z]{1,20}$/", $values["first_name"])) {
    $errors["first-name"] = "First name is required and must be up to 20 letters (A to Z).";
}
if (!preg_match("/^[A-Za-z]{1,20}$/", $values["last_name"])) {
    $errors["last-name"] = "Last name is required and must be up to 20 letters (A to Z).";
}

$dob_for_database = "";
if (!preg_match("/^(\d{2})\/(\d{2})\/(\d{4})$/", $values["dob"], $dob_parts)) {
    $errors["dob"] = "Date of birth is required and must use the format dd/mm/yyyy.";
} elseif (!is_real_date((int) $dob_parts[1], (int) $dob_parts[2], (int) $dob_parts[3])) {
    $errors["dob"] = "Date of birth must be a real calendar date.";
} else {
    $dob_for_database = $dob_parts[3] . "-" . $dob_parts[2] . "-" . $dob_parts[1];
    if ((int) $dob_parts[3] < 1900 || $dob_for_database >= date("Y-m-d")) {
        $errors["dob"] = "Date of birth must be a past date from 1900 onwards.";
    }
}

if (!isset($allowed_genders[$values["gender"]])) {
    $errors["gender-female"] = "Please select a gender option.";
}
if ($values["street"] === "" || strlen($values["street"]) > 40) {
    $errors["street"] = "Street address is required and must be up to 40 characters.";
}
if ($values["suburb"] === "" || strlen($values["suburb"]) > 40) {
    $errors["suburb"] = "Suburb or town is required and must be up to 40 characters.";
}
if (!isset($allowed_states[$values["state"]])) {
    $errors["state"] = "Please select an Australian state or territory.";
}
if (!preg_match("/^\d{4}$/", $values["postcode"])) {
    $errors["postcode"] = "Postcode must be exactly 4 digits.";
}
if (strlen($values["email"]) > 100 || !filter_var($values["email"], FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "Please enter a valid email address.";
}
if (!preg_match("/^\d{8,12}$/", $values["phone"])) {
    $errors["phone"] = "Phone number must be 8 to 12 digits with no spaces.";
}
if ($skill_html === 0 || $skill_css === 0) {
    $errors["skill-html"] = "Please confirm both essential skills, HTML and CSS.";
}
if (strlen($values["other_skills"]) > 1000) {
    $errors["other-skills"] = "Other skills must be 1000 characters or fewer.";
}

$conn = connect_database($host, $user, $pwd, $sql_db);
create_jobs_table($conn);
create_eoi_table($conn);

$job_ref = "";
if (!isset($errors["job-ref"])) {
    $stmt = $conn->prepare("SELECT job_ref FROM jobs WHERE job_ref = ?");
    $stmt->bind_param("s", $values["job_ref"]);
    $stmt->execute();
    $job = mysqli_fetch_assoc($stmt->get_result());
    $stmt->close();
    if ($job) {
        $job_ref = $job["job_ref"];
    } else {
        $errors["job-ref"] = "That job reference number does not match a current job.";
    }
}

if (count($errors) > 0) {
    mysqli_close($conn);
    $_SESSION["apply_errors"] = $errors;
    $_SESSION["apply_values"] = $values;
    header("Location: apply.php");
    exit();
}

$stmt = $conn->prepare("INSERT INTO eoi (job_ref, first_name, last_name, dob, gender, street, suburb,
    state, postcode, email, phone, skill_html, skill_css, other_skills)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssssiis", $job_ref, $values["first_name"], $values["last_name"],
    $dob_for_database, $values["gender"], $values["street"], $values["suburb"], $values["state"],
    $values["postcode"], $values["email"], $values["phone"], $skill_html, $skill_css, $values["other_skills"]);
$saved = $stmt->execute();
$eoi_number = mysqli_insert_id($conn);
$stmt->close();
mysqli_close($conn);

if (!$saved) {
    show_service_error();
}

$page_title = "Careers at Apple - Application received";
$page_description = "Confirmation that a job application was saved in the Apple Careers student project.";
$page_keywords = "Apple jobs, application received, expression of interest";
$page_css = "";
$current_page = "apply";
include "header.inc";
?>
  <main id="main-content" tabindex="-1">
    <div class="container">
      <h1>Application received</h1>
      <p class="success-message">
        Thank you, <?php echo escape_html($values["first_name"]); ?>. Your Expression of Interest number is
        <strong><?php echo (int) $eoi_number; ?></strong> for job <span class="ref"><?php echo escape_html($job_ref); ?></span>.
      </p>
      <p>Please keep this number. Its status starts as <strong>New</strong>.</p>
      <p>
        <a class="button" href="jobs.php">Back to current jobs</a>
        <a class="button secondary" href="index.php">Go to the home page</a>
      </p>
    </div>
  </main>

<?php include "footer.inc"; ?>
