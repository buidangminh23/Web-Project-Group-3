# Project Part 2 requirements checklist

COS10026 Applied Web Project Part 2, Group 3. Checked 7 November 2026 on XAMPP 8.2.12
(Apache, PHP 8.2.12, MariaDB 10.4.32). The Part 1 site stays at the repository root so that its
GitHub Pages deployment keeps working; Part 2 is the `project2/` folder.

## How to run

1. Copy `project2/` into `htdocs` and start Apache and MySQL in XAMPP.
2. Import `project2/project2.sql` in phpMyAdmin. If you skip this, the site creates the database
   `cos10026_group3` and its tables on first use, without the sample applications.
3. Open `project2/index.php`. HR manager login: `admin` / `admin`.

## Specified requirements

| Requirement | Where | Verified by |
|---|---|---|
| Shared HTML moved to `.inc` files; pages are `.php` | `header.inc`, `nav.inc`, `footer.inc` | All pages load with W3C Nu 0 errors, 0 warnings |
| `settings.php` with host, user, password and database name; no password | `settings.php` | Used by every connection; `$pwd` is empty |
| `eoi` table with a field for every apply variable, plus status | `db_functions.php`, `create_eoi_table` | Column type read back: `enum('New','Current','Final')` default `New` |
| Form posts to `process_eoi.php` | `apply.php` | Form attributes checked |
| Table created in code if missing | `process_eoi.php` | Table dropped, then created by the first submission |
| Confirmation with the auto-generated EOInumber | `process_eoi.php` | Number matched the stored row |
| Direct URL access blocked | `process_eoi.php` | GET and POST without fields redirect to `apply.php` |
| Trim, strip slashes, escape HTML, check formats | `sanitise_input`, `escape_html`, `process_eoi.php` | 23 invalid inputs rejected, no rows added; script text shown escaped |
| Client-side validation disabled | `apply.php` | `novalidate`, no `required`, `pattern`, `maxlength`, `type="email"` or `type="tel"` |
| `jobs` table matching the Part 1 jobs page | `create_jobs_table` | Changing a row changed `jobs.php` |
| Everything on the jobs page rendered from the database | `jobs.php`, `job_functions.php` | Titles, details, lists and benefits come from table fields |
| Search bar that reads the database | `jobs.php`, `index.php`, `search.php` | Hit, single hit, no hit, injection text and script text tested |
| `users` table, login page, `admin` / `admin` | `create_users_table`, `login.php` | Password stored as a bcrypt hash; `manage.php` redirects when logged out |
| List all EOIs | `manage.php` | Tested |
| List by job reference | `manage.php` | Tested |
| List by first name, last name or both | `manage.php` | Tested each and both |
| Delete all EOIs by job reference | `manage.php` | Only that job removed; needs a confirmation tick and a login |
| Change an EOI status | `manage.php` | Saved; invalid status refused |
| Choose a sort field | `manage.php` | Ascending and descending tested; invalid field falls back |
| `about` table loaded into the about page, Parts 1 and 2 | `create_about_table`, `about.php` | Changing a row changed the page; Vietnamese text intact |
| Folder structure and relative links | `project2/` | `images/`, `styles/`, `styles/images/`; crawl found no broken local link |
| No JavaScript | all pages | No `script` tag in any rendered page |

## Security beyond the minimum

Prepared statements for all user input, `password_hash` and `password_verify`, `session_regenerate_id(true)`
after login, HttpOnly and SameSite=Lax session cookie, the same message for unknown users and wrong
passwords, a 5-minute lock after 5 failed logins, whitelisted sort fields, and output escaping.

## Design decisions

| ID | Decision | Reason |
|---|---|---|
| D-17 | HTML is escaped when output, not when stored | Storing escaped text would double-encode names such as O'Brien when shown again. Prepared statements protect the database; `escape_html` protects every page. |
| D-18 | Lists in the jobs table are one text field per list, one item per line | The rubric asks for job content loaded from different fields of one table. A separate items table would meet 1NF more strictly but adds a join. |
| D-19 | The closing date moved to 31 January 2027 | The Part 1 date of 30 November 2026 passes before marking. |
| D-20 | Part 2 sits in `project2/` beside the Part 1 files | The brief names the folder, and Part 1 is not yet marked. |
| D-21 | `ENUM` and `LIKE` are used although the lecture notes do not name them | The brief requires three predefined status values and a working search. |

## Results

| Check | Result |
|---|---|
| End-to-end test script against Apache and MariaDB | 114 of 114 passed |
| W3C Nu checker: 6 public pages and 5 logged-in or error states | 0 errors, 0 warnings |
| Page overflow at 320, 768 and 1280 px | None; the applications table scrolls inside its wrapper |
| `project2.sql` dropped and re-imported | 2 jobs, 4 sample EOIs, 1 user, 4 members; Vietnamese text and hash intact |

## Still open

- The W3C CSS validator could not be reached from the command line, so the new CSS is not yet validated. Run `project2/styles/` through it before submitting.
- Part 2 contributions in the `about` table are the proposed allocation. Each member must confirm or correct their row.
- The Part 1 marker comments are not released yet. The rubric deducts up to 30 marks if they are not addressed.
- The Week 11 interview, Week 12 presentation, Peer and Self Evaluation and Canvas submission are done by the members.
