<?php
require_once "functions.php";
require_once "settings.php";
require_once "db_functions.php";

start_secure_session();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$sort_columns = [
    "eoi" => ["EOInumber", "EOI number"],
    "job" => ["job_ref", "Job reference"],
    "first" => ["first_name", "First name"],
    "last" => ["last_name", "Last name"],
    "state" => ["state", "State"],
    "status" => ["status", "Status"],
    "date" => ["submitted_at", "Date submitted"],
];
$statuses = ["New" => true, "Current" => true, "Final" => true];

$filter_job = isset($_GET["job_ref"]) ? sanitise_input($_GET["job_ref"]) : "";
$filter_first = isset($_GET["first_name"]) ? sanitise_input($_GET["first_name"]) : "";
$filter_last = isset($_GET["last_name"]) ? sanitise_input($_GET["last_name"]) : "";
$sort_key = isset($_GET["sort"]) && is_string($_GET["sort"]) && isset($sort_columns[$_GET["sort"]]) ? $_GET["sort"] : "eoi";
$sort_order = isset($_GET["order"]) && $_GET["order"] === "desc" ? "desc" : "asc";

$list_query = "job_ref=" . urlencode($filter_job) . "&first_name=" . urlencode($filter_first)
    . "&last_name=" . urlencode($filter_last) . "&sort=" . $sort_key . "&order=" . $sort_order;

$conn = connect_database($host, $user, $pwd, $sql_db);
create_jobs_table($conn);
create_eoi_table($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = isset($_POST["action"]) ? $_POST["action"] : "";

    if ($action === "change_status") {
        $eoi_number = isset($_POST["eoi_number"]) ? sanitise_input($_POST["eoi_number"]) : "";
        $new_status = isset($_POST["status"]) ? sanitise_input($_POST["status"]) : "";
        if (preg_match("/^\d+$/", $eoi_number) && isset($statuses[$new_status])) {
            $eoi_id = (int) $eoi_number;
            $stmt = $conn->prepare("UPDATE eoi SET status = ? WHERE EOInumber = ?");
            $stmt->bind_param("si", $new_status, $eoi_id);
            $stmt->execute();
            $stmt->close();
            $_SESSION["manage_message"] = "EOI " . $eoi_id . " is now " . $new_status . ".";
        } else {
            $_SESSION["manage_error"] = "Please choose a valid EOI and status.";
        }
    }

    if ($action === "delete_by_job") {
        $delete_ref = isset($_POST["delete_job_ref"]) ? sanitise_input($_POST["delete_job_ref"]) : "";
        if (!preg_match("/^[A-Za-z0-9]{5}$/", $delete_ref)) {
            $_SESSION["manage_error"] = "Enter a job reference number of exactly 5 letters or numbers to delete.";
        } elseif (!isset($_POST["confirm_delete"])) {
            $_SESSION["manage_error"] = "Tick the confirmation box before deleting applications.";
        } else {
            $stmt = $conn->prepare("DELETE FROM eoi WHERE job_ref = ?");
            $stmt->bind_param("s", $delete_ref);
            $stmt->execute();
            $_SESSION["manage_message"] = $stmt->affected_rows . " application(s) deleted for job " . $delete_ref . ".";
            $stmt->close();
        }
    }

    mysqli_close($conn);
    header("Location: manage.php?" . $list_query);
    exit();
}

$sort_column = $sort_columns[$sort_key][0];
$job_pattern = $filter_job;
$first_pattern = "%" . $filter_first . "%";
$last_pattern = "%" . $filter_last . "%";

$stmt = $conn->prepare("SELECT * FROM eoi
    WHERE (? = '' OR job_ref = ?)
    AND (? = '' OR first_name LIKE ?)
    AND (? = '' OR last_name LIKE ?)
    ORDER BY $sort_column $sort_order");
$stmt->bind_param("ssssss", $filter_job, $job_pattern, $filter_first, $first_pattern, $filter_last, $last_pattern);
$stmt->execute();
$result = $stmt->get_result();
$applications = [];
while ($row = mysqli_fetch_assoc($result)) {
    $applications[] = $row;
}
$stmt->close();
mysqli_close($conn);

$message = isset($_SESSION["manage_message"]) ? $_SESSION["manage_message"] : "";
$error = isset($_SESSION["manage_error"]) ? $_SESSION["manage_error"] : "";
unset($_SESSION["manage_message"], $_SESSION["manage_error"]);

$page_title = "Careers at Apple - Manage applications";
$page_description = "HR manager page for listing, sorting, updating and deleting Expressions of Interest.";
$page_keywords = "HR manager, EOI, manage applications";
$page_css = "manage.css";
$current_page = "manage";
include "header.inc";
?>
  <main id="main-content" tabindex="-1">
    <div class="container">

      <div class="manage-heading">
        <h1>Manage applications</h1>
        <p>
          Logged in as <strong><?php echo escape_html($_SESSION["username"]); ?></strong>.
          <a class="button secondary" href="logout.php">Log out</a>
        </p>
      </div>

<?php if ($message !== "") { ?>
      <p class="success-message"><?php echo escape_html($message); ?></p>
<?php } ?>
<?php if ($error !== "") { ?>
      <p class="error-message"><?php echo escape_html($error); ?></p>
<?php } ?>

      <div class="manage-panels">
        <section aria-labelledby="list-heading">
          <h2 id="list-heading">List applications</h2>
          <form method="get" action="manage.php" class="manage-form">
            <div class="manage-field">
              <label for="job_ref">Job reference</label>
              <input type="text" id="job_ref" name="job_ref" value="<?php echo escape_html($filter_job); ?>">
            </div>
            <div class="manage-field">
              <label for="first_name">Applicant first name</label>
              <input type="text" id="first_name" name="first_name" value="<?php echo escape_html($filter_first); ?>">
            </div>
            <div class="manage-field">
              <label for="last_name">Applicant last name</label>
              <input type="text" id="last_name" name="last_name" value="<?php echo escape_html($filter_last); ?>">
            </div>
            <div class="manage-field">
              <label for="sort">Sort by</label>
              <select id="sort" name="sort">
<?php foreach ($sort_columns as $key => $column) { ?>
                <option value="<?php echo $key; ?>"<?php if ($key === $sort_key) { echo " selected"; } ?>><?php echo $column[1]; ?></option>
<?php } ?>
              </select>
            </div>
            <div class="manage-field">
              <label for="order">Order</label>
              <select id="order" name="order">
                <option value="asc"<?php if ($sort_order === "asc") { echo " selected"; } ?>>Ascending</option>
                <option value="desc"<?php if ($sort_order === "desc") { echo " selected"; } ?>>Descending</option>
              </select>
            </div>
            <p class="manage-actions">
              <button type="submit" class="button">Show applications</button>
              <a class="button secondary" href="manage.php">List all EOIs</a>
            </p>
          </form>
        </section>

        <section aria-labelledby="delete-heading">
          <h2 id="delete-heading">Delete by job reference</h2>
          <form method="post" action="manage.php?<?php echo escape_html($list_query); ?>" class="manage-form">
            <input type="hidden" name="action" value="delete_by_job">
            <div class="manage-field">
              <label for="delete_job_ref">Job reference to delete</label>
              <input type="text" id="delete_job_ref" name="delete_job_ref">
            </div>
            <label class="confirm-delete"><input type="checkbox" name="confirm_delete" value="yes"> I understand this deletes every application for this job and cannot be undone.</label>
            <p class="manage-actions">
              <button type="submit" class="button danger">Delete applications</button>
            </p>
          </form>
        </section>
      </div>

      <section aria-labelledby="results-heading">
        <h2 id="results-heading"><?php echo count($applications); ?> application(s)</h2>
<?php if (count($applications) === 0) { ?>
        <p class="note">No applications match this search.</p>
<?php } else { ?>
        <div class="table-wrapper" tabindex="0" role="region" aria-labelledby="results-heading">
          <table class="eoi-table">
            <caption>Expressions of Interest</caption>
            <thead>
              <tr>
                <th scope="col">EOI</th>
                <th scope="col">Job</th>
                <th scope="col">Name</th>
                <th scope="col">Date of birth</th>
                <th scope="col">Gender</th>
                <th scope="col">Address</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Skills</th>
                <th scope="col">Other skills</th>
                <th scope="col">Submitted</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
<?php foreach ($applications as $application) {
    $skills = [];
    if ((int) $application["skill_html"] === 1) {
        $skills[] = "HTML";
    }
    if ((int) $application["skill_css"] === 1) {
        $skills[] = "CSS";
    }
    $eoi_id = (int) $application["EOInumber"];
?>
              <tr>
                <td><?php echo $eoi_id; ?></td>
                <td><span class="ref"><?php echo escape_html($application["job_ref"]); ?></span></td>
                <td><?php echo escape_html($application["first_name"] . " " . $application["last_name"]); ?></td>
                <td><?php echo escape_html(format_short_date($application["dob"])); ?></td>
                <td><?php echo escape_html($application["gender"]); ?></td>
                <td><?php echo escape_html($application["street"] . ", " . $application["suburb"] . " " . $application["state"] . " " . $application["postcode"]); ?></td>
                <td><?php echo escape_html($application["email"]); ?></td>
                <td><?php echo escape_html($application["phone"]); ?></td>
                <td><?php echo escape_html(implode(", ", $skills)); ?></td>
                <td><?php echo escape_html($application["other_skills"]); ?></td>
                <td><?php echo escape_html($application["submitted_at"]); ?></td>
                <td>
                  <form method="post" action="manage.php?<?php echo escape_html($list_query); ?>" class="status-form">
                    <input type="hidden" name="action" value="change_status">
                    <input type="hidden" name="eoi_number" value="<?php echo $eoi_id; ?>">
                    <label class="visually-hidden" for="status-<?php echo $eoi_id; ?>">Status for EOI <?php echo $eoi_id; ?></label>
                    <select id="status-<?php echo $eoi_id; ?>" name="status">
<?php foreach ($statuses as $status => $unused) { ?>
                      <option value="<?php echo $status; ?>"<?php if ($application["status"] === $status) { echo " selected"; } ?>><?php echo $status; ?></option>
<?php } ?>
                    </select>
                    <button type="submit" class="button small">Update</button>
                  </form>
                </td>
              </tr>
<?php } ?>
            </tbody>
          </table>
        </div>
<?php } ?>
      </section>

    </div>
  </main>

<?php include "footer.inc"; ?>
