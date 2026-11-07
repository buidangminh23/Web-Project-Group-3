<?php
require_once "functions.php";
require_once "settings.php";
require_once "db_functions.php";
require_once "job_functions.php";

$conn = connect_database($host, $user, $pwd, $sql_db);
create_jobs_table($conn);
$jobs = fetch_all_jobs($conn);
mysqli_close($conn);

$page_title = "Careers at Apple - Current jobs";
$page_description = "Current vacancies in the Apple Online Store web team in Sydney, loaded from the jobs database.";
$page_keywords = "Apple jobs, front-end web developer, UX designer, accessibility, Sydney, vacancies";
$page_css = "jobs.css";
$current_page = "jobs";
include "header.inc";
?>
  <main id="main-content" tabindex="-1">
    <div class="container">

      <h1>Current jobs</h1>
      <p>
        We have <?php echo count($jobs); ?> openings in the Apple Online Store web team in Sydney.
        Read each job description, note its five-character reference number, then use it on the
        <a href="apply.php">application form</a>.
      </p>

      <form class="search-row" action="search.php" method="get">
        <label for="keywords">Search jobs by title, reference or keyword</label>
        <input type="search" id="keywords" name="keywords" placeholder="e.g. accessibility">
        <button type="submit">Search</button>
      </form>

<?php if (count($jobs) > 0) { ?>
      <aside aria-labelledby="life-heading">
        <h2 id="life-heading">Life at Apple</h2>
        <p>Benefits offered with both roles:</p>
        <ul>
          <?php render_list_items($jobs[0]["benefits"]); ?>
        </ul>
        <h3>Closing date</h3>
        <p>Each role lists its closing date under <em>Job details</em>.</p>
        <h3>Need adjustments?</h3>
        <p>
          If you need any changes to the application or interview process, let us know in the
          <em>Other skills</em> box of the form and we will contact you.
        </p>
      </aside>
<?php } ?>

      <?php foreach ($jobs as $job) { render_job($job); } ?>

      <p class="clear centered-note">
        Don't see the right role? Check back soon: new positions are added every month.
      </p>

    </div>
  </main>

<?php include "footer.inc"; ?>
