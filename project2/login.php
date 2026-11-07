<?php
require_once "functions.php";
require_once "settings.php";
require_once "db_functions.php";

start_secure_session();

if (isset($_SESSION["username"])) {
    header("Location: manage.php");
    exit();
}

$login_failed = false;
$username = "";

$conn = connect_database($host, $user, $pwd, $sql_db);
create_users_table($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = isset($_POST["username"]) ? sanitise_input($_POST["username"]) : "";
    $password = isset($_POST["password"]) && is_string($_POST["password"]) ? $_POST["password"] : "";

    $stmt = $conn->prepare("SELECT user_id, username, password, failed_attempts,
        (locked_until IS NOT NULL AND locked_until > NOW()) AS is_locked
        FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $account = mysqli_fetch_assoc($stmt->get_result());
    $stmt->close();

    if ($account && !$account["is_locked"] && password_verify($password, $account["password"])) {
        $stmt = $conn->prepare("UPDATE users SET failed_attempts = 0, locked_until = NULL WHERE user_id = ?");
        $stmt->bind_param("i", $account["user_id"]);
        $stmt->execute();
        $stmt->close();
        mysqli_close($conn);

        session_regenerate_id(true);
        $_SESSION["username"] = $account["username"];
        header("Location: manage.php");
        exit();
    }

    if ($account && !$account["is_locked"]) {
        $stmt = $conn->prepare("UPDATE users SET
            locked_until = IF(failed_attempts + 1 >= 5, DATE_ADD(NOW(), INTERVAL 5 MINUTE), NULL),
            failed_attempts = IF(failed_attempts + 1 >= 5, 0, failed_attempts + 1)
            WHERE user_id = ?");
        $stmt->bind_param("i", $account["user_id"]);
        $stmt->execute();
        $stmt->close();
    }
    $login_failed = true;
}
mysqli_close($conn);

$page_title = "Careers at Apple - HR manager login";
$page_description = "Login page for HR managers of the Apple Careers student project.";
$page_keywords = "HR manager, login, Apple Careers";
$page_css = "manage.css";
$current_page = "manage";
include "header.inc";
?>
  <main id="main-content" tabindex="-1">
    <div class="container">
      <div class="login-box">
        <h1>HR manager login</h1>
        <p>Log in to view and manage job applications.</p>

<?php if ($login_failed) { ?>
        <p class="error-message">
          Incorrect username or password, or the account is locked for 5 minutes after 5 failed attempts.
        </p>
<?php } ?>

        <form method="post" action="login.php" class="manage-form">
          <div class="manage-field">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" autocomplete="username" value="<?php echo escape_html($username); ?>">
          </div>
          <div class="manage-field">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" autocomplete="current-password">
          </div>
          <button type="submit" class="button">Log in</button>
        </form>
      </div>
    </div>
  </main>

<?php include "footer.inc"; ?>
