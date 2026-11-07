<?php
require_once "functions.php";
require_once "settings.php";
require_once "db_functions.php";
require_once "job_functions.php";

$keywords = isset($_GET["keywords"]) ? sanitise_input($_GET["keywords"]) : "";
if ($keywords === "") {
    header("Location: jobs.php");
    exit();
}

$conn = connect_database($host, $user, $pwd, $sql_db);
create_jobs_table($conn);
$jobs = search_jobs($conn, $keywords);
mysqli_close($conn);

$page_title = "Careers at Apple - Job search results";
$page_description = "Search results from the Apple Careers jobs database.";
$page_keywords = "Apple jobs, job search, vacancies";
$page_css = "jobs.css";
$current_page = "jobs";
include "header.inc";
?>
  <main id="main-content" tabindex="-1">
    <div class="container">

      <h1>Job search results</h1>
      <p>
        <?php echo count($jobs); ?> job(s) found for
        <strong><?php echo escape_html($keywords); ?></strong>.
        <a href="jobs.php">See all current jobs</a>.
      </p>

      <form class="search-row" action="search.php" method="get">
        <label for="keywords">Search jobs by title, reference or keyword</label>
        <input type="search" id="keywords" name="keywords" value="<?php echo escape_html($keywords); ?>">
        <button type="submit">Search</button>
      </form>

<?php if (count($jobs) === 0) { ?>
      <p class="note">No jobs match your search. Try a shorter keyword such as &quot;design&quot; or &quot;HTML&quot;.</p>
<?php } ?>

      <?php foreach ($jobs as $job) { render_job($job); } ?>

    </div>
  </main>

<?php include "footer.inc"; ?>
