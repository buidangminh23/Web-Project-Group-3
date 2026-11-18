<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?php echo htmlspecialchars($page_description, ENT_QUOTES); ?>">
  <meta name="keywords" content="<?php echo htmlspecialchars($page_keywords, ENT_QUOTES); ?>">
  <meta name="author" content="Group 3, COS10026">
  <title><?php echo htmlspecialchars($page_title, ENT_QUOTES); ?></title>

  <link rel="stylesheet" href="styles/style.css">
<?php if ($page_css !== "") { ?>
  <link rel="stylesheet" href="styles/<?php echo $page_css; ?>">
<?php } ?>
</head>

<body>
  <a class="skip-link" href="#main-content">Skip to main content</a>

  <header id="site-header">
    <div class="container">
      <a class="brand" href="index.php">

        <!-- Logo glyph adapted from Devicon apple-original, https://devicon.dev/ (MIT); Apple trademark, educational use. -->
        <img src="images/logo.png" alt="Apple logo" width="48" height="48">
        Apple Careers
      </a>

<?php include "nav.inc"; ?>
    </div>
  </header>

  <p class="project-banner">
    <strong>Student project for COS10026 at Swinburne.</strong> This is not an official Apple website and all jobs are fictional.
  </p>
