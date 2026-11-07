<?php
$nav_items = [
    "index" => ["index.php", "Home"],
    "jobs" => ["jobs.php", "Jobs"],
    "apply" => ["apply.php", "Apply"],
    "about" => ["about.php", "About"],
    "manage" => ["manage.php", "HR manager"],
];
?>
      <nav>
        <ul>
<?php foreach ($nav_items as $key => $item) { ?>
          <li><a href="<?php echo $item[0]; ?>"<?php if ($key === $current_page) { echo ' class="current"'; } ?>><?php echo $item[1]; ?></a></li>
<?php } ?>
        </ul>
      </nav>
