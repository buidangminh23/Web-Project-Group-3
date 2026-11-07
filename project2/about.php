<?php
require_once "functions.php";
require_once "settings.php";
require_once "db_functions.php";

$conn = connect_database($host, $user, $pwd, $sql_db);
create_about_table($conn);
$members = [];
$result = mysqli_query($conn, "SELECT * FROM about ORDER BY display_order");
while ($row = mysqli_fetch_assoc($result)) {
    $members[] = $row;
}
mysqli_close($conn);

$page_title = "Careers at Apple - About Group 3";
$page_description = "Meet Group 3, the COS10026 students who built the Apple Careers recruitment website: class details, contributions, quotes, group photo and fun facts.";
$page_keywords = "Group 3, COS10026, Swinburne, team members, student IDs, contributions, fun facts";
$page_css = "about.css";
$current_page = "about";
include "header.inc";
?>
  <main id="main-content" tabindex="-1">
    <div class="container">

      <h1>About Group 3</h1>
      <p>
        We are the COS10026 Web Technology Project team that designed and built this
        Apple Careers website, first with HTML5 and CSS3 and then with PHP and MySQL.
      </p>

      <section id="group-details" aria-labelledby="group-heading">
        <h2 id="group-heading">Group and class details</h2>
        <ul>
          <li>Group name: <strong>Group 3</strong>
            <ul>
              <li>Unit: COS10026 Web Technology Project</li>
              <li>Company for this project: Apple (Apple Online Store web team)</li>
            </ul>
          </li>
          <li>Class
            <ul>
              <li>Day: Wednesday</li>
              <li>Time: 09:00 to 12:00</li>
              <li>Tutor: Thomas Harrison</li>
            </ul>
          </li>
        </ul>
      </section>

      <section id="project-brief" aria-labelledby="brief-heading">
        <h2 id="brief-heading">Selected project brief</h2>
        <p>
          For Assessment 2: Applied Web Project, Group 3 selected Apple as the company for a recruitment
          website. Part 1 built the static site; Part 2 turns it into a database-driven application.
        </p>
        <ul>
          <li><strong>Company and team:</strong> Apple, Apple Online Store web team in Sydney.</li>
          <li><strong>Advertised roles:</strong> loaded from the jobs table and searchable on the Jobs page.</li>
          <li><strong>Website pages:</strong> Home, Jobs, Apply, About, and a protected HR manager area.</li>
          <li><strong>Technology and delivery:</strong> PHP and MySQL on a local XAMPP server, with server-side
            validation, prepared statements and hashed passwords. No JavaScript.</li>
        </ul>
        <p>
          This is an educational project. The vacancies and salaries are fictional, the site is not
          affiliated with Apple, and applications should only contain made-up test data.
        </p>
      </section>

      <section id="members" aria-labelledby="members-heading">
        <h2 id="members-heading">Members and contributions</h2>
        <dl class="members">
<?php foreach ($members as $member) { ?>
          <dt><?php echo escape_html($member["member_name"]); ?> <span class="student-id"><?php echo escape_html($member["student_id"]); ?></span></dt>
          <dd><strong>Project Part 1:</strong> <?php echo escape_html($member["part1_contribution"]); ?></dd>
          <dd><strong>Project Part 2:</strong> <?php echo escape_html($member["part2_contribution"]); ?></dd>
          <dd class="quote"><span lang="vi">&quot;<?php echo escape_html($member["quote_vietnamese"]); ?>&quot;</span> (Vietnamese)</dd>
          <dd>English translation: <?php echo escape_html($member["quote_english"]); ?></dd>
<?php } ?>
        </dl>
      </section>

      <section id="photo" aria-labelledby="photo-heading">
        <h2 id="photo-heading">Our group</h2>
        <figure id="group-photo">
          <!-- Coordinator-supplied deterministic collage of the four original portraits; faces unchanged. -->
          <img src="images/group-collage.jpg" alt="Four Group 3 member portraits arranged in two rows" width="1200" height="1320">
          <figcaption>Group 3 member portrait collage. Top row: Tran Vo Nhat Minh and Bui Dang Minh. Bottom row: Le Ho Hoang Lan and Nguyen Quang Thang.</figcaption>
        </figure>
      </section>

      <section id="fun-facts" aria-labelledby="facts-heading">
        <h2 id="facts-heading">Fun facts</h2>
        <div class="table-wrapper">
          <table>
            <caption>Fun facts about the members of Group 3</caption>
            <thead>
              <tr>
                <th>Member</th>
                <th>Dream job</th>
                <th>Coding snack</th>
                <th>Hometown</th>
                <th>Favourite Apple product</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Bui Dang Minh</td>
                <td>Data scientist</td>
                <td>Matcha latte</td>
                <td>Hanoi, Vietnam</td>
                <td>MacBook Air</td>
              </tr>
              <tr>
                <td>Le Ho Hoang Lan</td>
                <td>Software engineer</td>
                <td>Iced coffee</td>
                <td>Hanoi, Vietnam</td>
                <td>MacBook Pro</td>
              </tr>
              <tr>
                <td>Nguyen Quang Thang</td>
                <td>Full-stack developer</td>
                <td>Potato chips</td>
                <td>Hanoi, Vietnam</td>
                <td>iPhone</td>
              </tr>
              <tr>
                <td>Tran Vo Nhat Minh</td>
                <td>UI/UX designer</td>
                <td>Milk tea</td>
                <td>Hanoi, Vietnam</td>
                <td>iPad Pro</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <section id="why-apple" aria-labelledby="why-heading">
        <h2 id="why-heading">Why we chose Apple</h2>
        <p>
          Apple is known for clean design, attention to detail and a strong focus on accessibility and privacy.
          Building a careers site in that style pushed us to keep the layout simple, use plenty of white space,
          write in plain language and check every page with the W3C validators and an accessibility checker.
        </p>
      </section>

    </div>
  </main>

<?php include "footer.inc"; ?>
