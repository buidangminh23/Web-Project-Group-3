<?php
function start_secure_session() {
    session_set_cookie_params(["httponly" => true, "samesite" => "Lax"]);
    session_start();
}

function sanitise_input($value) {
    if (!is_string($value)) {
        return "";
    }
    return stripslashes(trim($value));
}

function escape_html($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES);
}

function format_long_date($iso_date) {
    $months = ["January", "February", "March", "April", "May", "June", "July",
        "August", "September", "October", "November", "December"];
    $parts = explode("-", $iso_date);
    return (int) $parts[2] . " " . $months[(int) $parts[1] - 1] . " " . $parts[0];
}

function format_short_date($iso_date) {
    $parts = explode("-", $iso_date);
    return $parts[2] . "/" . $parts[1] . "/" . $parts[0];
}

function is_real_date($day, $month, $year) {
    $days_in_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    if (($year % 4 === 0 && $year % 100 !== 0) || $year % 400 === 0) {
        $days_in_month[1] = 29;
    }
    return $month >= 1 && $month <= 12 && $day >= 1 && $day <= $days_in_month[$month - 1];
}
?>
