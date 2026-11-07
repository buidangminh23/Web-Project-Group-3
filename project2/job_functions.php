<?php
function fetch_all_jobs($conn) {
    $jobs = [];
    $result = mysqli_query($conn, "SELECT * FROM jobs ORDER BY job_ref");
    while ($row = mysqli_fetch_assoc($result)) {
        $jobs[] = $row;
    }
    return $jobs;
}

function search_jobs($conn, $keywords) {
    $pattern = "%" . $keywords . "%";
    $stmt = $conn->prepare("SELECT * FROM jobs
        WHERE job_ref LIKE ? OR title LIKE ? OR summary LIKE ? OR location LIKE ?
        OR responsibilities LIKE ? OR essential_requirements LIKE ? OR preferable_requirements LIKE ?
        ORDER BY job_ref");
    $stmt->bind_param("sssssss", $pattern, $pattern, $pattern, $pattern, $pattern, $pattern, $pattern);
    $stmt->execute();
    $result = $stmt->get_result();
    $jobs = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $jobs[] = $row;
    }
    $stmt->close();
    return $jobs;
}

function render_list_items($text) {
    foreach (explode("\n", $text) as $item) {
        echo "<li>" . escape_html($item) . "</li>\n";
    }
}

function render_job($job) {
    $ref = escape_html($job["job_ref"]);
    ?>
    <section class="job" id="job-<?php echo $ref; ?>" aria-labelledby="title-<?php echo $ref; ?>">
      <h2 id="title-<?php echo $ref; ?>"><?php echo escape_html($job["title"]); ?></h2>
      <p>Reference number: <span class="ref"><?php echo $ref; ?></span></p>
      <p><?php echo escape_html($job["summary"]); ?></p>

      <section aria-labelledby="facts-<?php echo $ref; ?>">
        <h3 id="facts-<?php echo $ref; ?>">Job details</h3>
        <dl class="job-facts">
          <dt>Salary</dt>
          <dd><?php echo escape_html($job["salary"]); ?></dd>
          <dt>Reports to</dt>
          <dd><?php echo escape_html($job["reports_to"]); ?></dd>
          <dt>Location</dt>
          <dd><?php echo escape_html($job["location"]); ?></dd>
          <dt>Work type</dt>
          <dd><?php echo escape_html($job["work_type"]); ?></dd>
          <dt>Closing date</dt>
          <dd><?php echo escape_html(format_long_date($job["closing_date"])); ?></dd>
        </dl>
      </section>

      <section aria-labelledby="duties-<?php echo $ref; ?>">
        <h3 id="duties-<?php echo $ref; ?>">Key responsibilities</h3>
        <ul>
          <?php render_list_items($job["responsibilities"]); ?>
        </ul>
      </section>

      <section aria-labelledby="req-<?php echo $ref; ?>">
        <h3 id="req-<?php echo $ref; ?>">Requirements</h3>
        <h4>Essential (in order of importance)</h4>
        <ol>
          <?php render_list_items($job["essential_requirements"]); ?>
        </ol>
        <h4>Preferable</h4>
        <ul class="preferable">
          <?php render_list_items($job["preferable_requirements"]); ?>
        </ul>
      </section>

      <p class="job-apply">
        <a class="button" href="apply.php?job_ref=<?php echo $ref; ?>">Apply for this role</a>
        Use reference number <span class="ref"><?php echo $ref; ?></span>.
      </p>
    </section>
    <?php
}
?>
