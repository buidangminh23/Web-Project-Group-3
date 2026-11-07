<?php
/*
 GenAI acknowledgement: Claude (model Opus 5.5, Claude Code).
 Use: drafted the Part 2 conversion of the Part 1 site to PHP and MySQL (pages, SQL, CSS changes)
 and ran local tests. Members must review, understand and adapt the code they present.
 Prompt (translated from Vietnamese): Complete Applied Web Project Part 2 (Group Submission) for us.
*/
$page_title = "Careers at Apple - Home";
$page_description = "Careers at Apple: join the team that builds the Apple Online Store. Read about our hiring process and search open roles.";
$page_keywords = "Apple, careers, jobs, Apple Online Store, web developer, UX designer, Sydney";
$page_css = "index.css";
$current_page = "index";
include "header.inc";
?>
  <!-- Company background: Apple Inc., Apple (Australia), https://www.apple.com/au/; wording adapted for fictional coursework roles. -->
  <section id="hero" aria-labelledby="company-name">
    <div class="container">
      <div class="hero-text">

        <h1 id="company-name">Apple</h1>
        <p class="slogan">Think different.</p>
        <p>
          Apple designs the iPhone, iPad, Mac, Apple Watch and the services that connect them.
          Millions of people choose, compare and buy those products through the
          <strong>Apple Online Store</strong>, so every page has to be fast, clear and
          usable by everyone.
        </p>

        <p class="hero-lead">
          Our Sydney web team is growing. We are looking for people who care about
          accessible design and well-built websites to help us shape the store experience
          for customers across Australia.
        </p>
        <p class="hero-actions">
          <a class="button" href="jobs.php">See open roles</a>
          <a class="button secondary" href="apply.php">Apply now</a>
        </p>
      </div>

      <!-- Original AI-assisted artwork; acknowledgement: index.html. -->
      <figure class="hero-figure">
        <img src="images/hero-workplace.jpg"
             alt="Illustration of a laptop showing an Apple Careers web page next to a phone showing an application form"
             width="640" height="400">
      </figure>
    </div>
  </section>

  <main id="main-content" tabindex="-1">
    <div class="container">

      <section id="search" aria-labelledby="search-heading">
        <h2 id="search-heading">Search open roles</h2>
        <form action="search.php" method="get">
          <div class="search-row">
            <label for="keywords">Job title or keyword</label>
            <input type="search" id="keywords" name="keywords" placeholder="e.g. front-end developer">
            <button type="submit">Search</button>
          </div>
        </form>
      </section>

      <section id="team" aria-labelledby="team-heading">
        <h2 id="team-heading">Who we are</h2>
        <p>
          The <strong>Apple Online Store web team</strong> builds the pages where customers explore
          products, compare models, check delivery and pickup options, and apply for trade-in and
          financing. Designers, front-end developers and accessibility specialists work together
          in small teams, and every change is tested with real users before it goes live.
        </p>
        <h3>What we value</h3>
        <ul>
          <li><strong>Accessibility:</strong> our products are designed for everyone, and so are our web pages.</li>
          <li><strong>Privacy:</strong> we only ask for the information we really need.</li>
          <li><strong>Simplicity:</strong> clear words and clean layouts beat clever tricks.</li>
          <li><strong>Craft:</strong> we validate our code and sweat the small details.</li>
        </ul>
      </section>

      <section id="process" aria-labelledby="process-heading">
        <h2 id="process-heading">How hiring works</h2>
        <p>Every applicant goes through the same steps, so nothing comes as a surprise.</p>
        <div class="table-wrapper">
          <table>
            <caption>Apple Online Store web team: hiring process</caption>
            <thead>
              <tr>
                <th rowspan="2">Stage</th>
                <th rowspan="2">Step</th>
                <th colspan="2">What to expect</th>
              </tr>
              <tr>
                <th>What happens</th>
                <th>Typical timing</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th rowspan="2">Apply</th>
                <td>1. Online application</td>
                <td>You complete the application form using the reference number of the role.</td>
                <td>Any time before the closing date</td>
              </tr>
              <tr>
                <td>2. Application review</td>
                <td>Two members of the team read your application against the essential requirements. You can ask for feedback at this and every later step.</td>
                <td>Within 5 working days</td>
              </tr>
              <tr>
                <th rowspan="2">Interview</th>
                <td>3. Phone conversation</td>
                <td>A 30 minute call with a recruiter about your experience and the role.</td>
                <td>Week 1 after review</td>
              </tr>
              <tr>
                <td>4. Team interview</td>
                <td>You talk through work you are proud of (from a job, study or community project) and meet the people you would work with. You can bring a support person.</td>
                <td>Week 2 after review</td>
              </tr>
              <tr>
                <th>Offer</th>
                <td>5. Decision</td>
                <td>We call you with our decision either way and give feedback if you ask for it.</td>
                <td>Within 5 working days of the interview</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3">Total time from application to decision</td>
                <td>About 4 weeks</td>
              </tr>
            </tfoot>
          </table>
        </div>
      </section>

      <!-- Wording follows Swinburne COS10026 Canvas, Acknowledgement of Country; Sydney custodians: City of Sydney, Aboriginal and Torres Strait Islander, https://www.cityofsydney.nsw.gov.au/ -->
      <section id="acknowledgement" aria-labelledby="ack-heading">
        <h2 id="ack-heading">Acknowledgement of Country</h2>

        <p>
          We acknowledge the <strong>Gadigal people of the Eora Nation</strong>, the Traditional Custodians
          of the land in Sydney where the roles on this site are based, and pay our respects to their
          Elders past and present. We also acknowledge the Traditional Owners of lands across Australia
          and recognise their continuing connection to land, waters, culture and community.
        </p>

        <h3>Our commitment to inclusive hiring</h3>
        <p>
          We warmly encourage applications from <strong>Aboriginal and Torres Strait Islander peoples</strong>
          for every role on this site. A careers page is where an employer's words are put to the test,
          so we have built three commitments into the hiring process described above:
        </p>
        <ol>
          <li>You can share work, study or community experience instead of a formal portfolio.</li>
          <li>You can ask for a support person or a culturally safe contact at any stage of the process.</li>
          <li>You can ask for feedback at every step, not only after a final decision.</li>
        </ol>
        <p>
          <strong>Why this is here:</strong> websites like this one are built on land that has been cared for by
          First Nations peoples for more than 60,000 years. Recognising that, and making the hiring process
          genuinely open, is part of building a fair and inclusive workplace.
        </p>
      </section>

    </div>
  </main>

<?php include "footer.inc"; ?>
