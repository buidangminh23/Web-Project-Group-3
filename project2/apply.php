<?php
require_once "functions.php";

start_secure_session();

$errors = isset($_SESSION["apply_errors"]) ? $_SESSION["apply_errors"] : [];
$values = isset($_SESSION["apply_values"]) ? $_SESSION["apply_values"] : [];
unset($_SESSION["apply_errors"], $_SESSION["apply_values"]);

$field_names = ["job_ref", "first_name", "last_name", "dob", "gender", "street", "suburb",
    "state", "postcode", "email", "phone", "other_skills", "skill_html", "skill_css"];
foreach ($field_names as $name) {
    if (!isset($values[$name])) {
        $values[$name] = "";
    }
}

if ($values["job_ref"] === "" && isset($_GET["job_ref"])) {
    $requested_ref = sanitise_input($_GET["job_ref"]);
    if (preg_match("/^[A-Za-z0-9]{5}$/", $requested_ref)) {
        $values["job_ref"] = $requested_ref;
    }
}

$genders = ["female" => "Female", "male" => "Male", "non-binary" => "Non-binary", "not-stated" => "Prefer not to say"];
$states = ["VIC" => "Victoria", "NSW" => "New South Wales", "QLD" => "Queensland", "NT" => "Northern Territory",
    "WA" => "Western Australia", "SA" => "South Australia", "TAS" => "Tasmania", "ACT" => "Australian Capital Territory"];

$page_title = "Careers at Apple - Job application";
$page_description = "Apply online for a job in the Apple Online Store web team. Your answers are checked on the server.";
$page_keywords = "Apple jobs, job application form, apply online, AFE26, AUX26";
$page_css = "apply.css";
$current_page = "apply";
include "header.inc";
?>
  <main id="main-content" tabindex="-1">
    <div class="container">

      <h1>Job application</h1>
      <p>
        Fill in the form below to apply for one of our <a href="jobs.php">current jobs</a>.
        Fields marked with <span class="required-star">*</span> are required.
      </p>

      <!-- Privacy and dark-pattern guidance: Swinburne COS10026 Canvas, Week 06: Dark patterns examples in web development. -->
      <section id="privacy" aria-labelledby="privacy-heading">
        <h2 id="privacy-heading">Why we ask for this information</h2>
        <p>
          <strong>This is a demonstration form for a student project. Please do not enter real personal details;
          use made-up test data.</strong> Your answers are saved in this project's database, not sent to Apple,
          and can only be viewed by a logged-in HR manager.
        </p>
        <p>
          In a real application we would only ask for details needed to assess you and contact you:
          your date of birth confirms your identity and that you are old enough to work, and gender is used
          only for equal-opportunity reporting, which is why "Prefer not to say" is always accepted.
          Information about adjustments you need is used only to arrange your interview.
        </p>
      </section>

<?php if (count($errors) > 0) { ?>
      <section class="error-summary" aria-labelledby="error-heading">
        <h2 id="error-heading">Please fix these <?php echo count($errors); ?> problem(s)</h2>
        <ul>
<?php foreach ($errors as $field_id => $message) { ?>
          <li><a href="#<?php echo escape_html($field_id); ?>"><?php echo escape_html($message); ?></a></li>
<?php } ?>
        </ul>
      </section>
<?php } ?>

      <form id="application" method="post" action="process_eoi.php" novalidate>

        <fieldset>
          <legend>Job</legend>
          <div class="form-grid">
            <div class="field">
              <label for="job-ref">Job reference number <span class="required-star">*</span>
                <span class="hint">Exactly 5 letters or numbers, for example AFE26</span>
              </label>
              <input type="text" id="job-ref" name="job_ref" placeholder="AFE26" value="<?php echo escape_html($values["job_ref"]); ?>">
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>Personal details</legend>
          <div class="form-grid">
            <div class="field">
              <label for="first-name">First name <span class="required-star">*</span>
                <span class="hint">Up to 20 letters</span>
              </label>
              <input type="text" id="first-name" name="first_name" value="<?php echo escape_html($values["first_name"]); ?>">
            </div>

            <div class="field">
              <label for="last-name">Last name <span class="required-star">*</span>
                <span class="hint">Up to 20 letters</span>
              </label>
              <input type="text" id="last-name" name="last_name" value="<?php echo escape_html($values["last_name"]); ?>">
            </div>

            <div class="field">
              <label for="dob">Date of birth <span class="required-star">*</span>
                <span class="hint">Format dd/mm/yyyy</span>
              </label>
              <input type="text" id="dob" name="dob" placeholder="dd/mm/yyyy" value="<?php echo escape_html($values["dob"]); ?>">
            </div>

            <div class="field wide">
              <fieldset>
                <legend>Gender <span class="required-star">*</span></legend>
                <div class="choices">
<?php foreach ($genders as $value => $label) { ?>
                  <label><input type="radio" id="gender-<?php echo $value; ?>" name="gender" value="<?php echo $value; ?>"<?php if ($values["gender"] === $value) { echo " checked"; } ?>> <?php echo $label; ?></label>
<?php } ?>
                </div>
              </fieldset>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>Address</legend>
          <div class="form-grid">
            <div class="field">
              <label for="street">Street address <span class="required-star">*</span>
                <span class="hint">Up to 40 characters</span>
              </label>
              <input type="text" id="street" name="street" value="<?php echo escape_html($values["street"]); ?>">
            </div>

            <div class="field">
              <label for="suburb">Suburb or town <span class="required-star">*</span>
                <span class="hint">Up to 40 characters</span>
              </label>
              <input type="text" id="suburb" name="suburb" value="<?php echo escape_html($values["suburb"]); ?>">
            </div>

            <div class="field">
              <label for="state">State or territory <span class="required-star">*</span>
                <span class="hint">Select your Australian state or territory</span>
              </label>
              <!-- State and territory names: Treasury Corporation of Victoria, State & Commonwealth Relationship, https://www.tcv.vic.gov.au/about-tcv/victoria-s-economy/state-commonwealth-relationship -->
              <select id="state" name="state">
                <option value="">Please select</option>
<?php foreach ($states as $value => $label) { ?>
                <option value="<?php echo $value; ?>"<?php if ($values["state"] === $value) { echo " selected"; } ?>><?php echo $label; ?></option>
<?php } ?>
              </select>
            </div>

            <div class="field">
              <label for="postcode">Postcode <span class="required-star">*</span>
                <span class="hint">Exactly 4 digits</span>
              </label>
              <input type="text" id="postcode" name="postcode" placeholder="2000" value="<?php echo escape_html($values["postcode"]); ?>">
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>Contact details</legend>
          <div class="form-grid">

            <div class="field">
              <label for="email">Email address <span class="required-star">*</span></label>
              <input type="text" id="email" name="email" placeholder="name@domain.com" value="<?php echo escape_html($values["email"]); ?>">
            </div>

            <div class="field">
              <label for="phone">Phone number <span class="required-star">*</span>
                <span class="hint">8 to 12 digits, no spaces</span>
              </label>
              <input type="text" id="phone" name="phone" placeholder="0412345678" value="<?php echo escape_html($values["phone"]); ?>">
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>Skills</legend>
          <p>Confirm both essential skills. HTML and CSS are required for both advertised roles. <span class="required-star">*</span></p>
          <div class="choices">
            <label><input type="checkbox" id="skill-html" name="skills[]" value="html"<?php if ($values["skill_html"] === 1) { echo " checked"; } ?>> HTML <span class="required-star">*</span></label>
            <label><input type="checkbox" id="skill-css" name="skills[]" value="css"<?php if ($values["skill_css"] === 1) { echo " checked"; } ?>> CSS <span class="required-star">*</span></label>
          </div>

          <div class="field">
            <label for="other-skills">Other skills
              <span class="hint">Optional. Describe any additional skills you have, such as web accessibility, responsive design, user research, Git, GitHub, Agile or Jira. You may also mention interview adjustments.</span>
            </label>
            <textarea id="other-skills" name="other_skills" rows="5" cols="40"
                      placeholder="Tell us about other skills or experience..."><?php echo escape_html($values["other_skills"]); ?></textarea>
          </div>
        </fieldset>

        <p class="form-buttons">
          <input type="submit" value="Submit application">
          <input type="reset" value="Clear form">
        </p>
      </form>

    </div>
  </main>

<?php include "footer.inc"; ?>
