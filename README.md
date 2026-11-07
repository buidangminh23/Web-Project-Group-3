# Apple Careers - recruitment website

COS10026 Web Technology Project
**Assessment 2: Applied Web Project** - Group 3

**Part 2** is in [`project2/`](project2/): the same site as a PHP and MySQL application that runs on
XAMPP from `project2/index.php`. Setup, requirements and test results are in
[`docs/part2-checklist.md`](docs/part2-checklist.md). The rest of this README describes Part 1.

**Part 1** (group component, 70 marks) is a static recruitment website for **Apple** (the Apple Online Store web team in Sydney),
built with HTML5 and CSS3 only. No JavaScript, no frameworks, no build step.

- Live site: https://dangminh232006.github.io/Web-Project-Group-3/
- Repository: https://github.com/dangminh232006/Web-Project-Group-3
- Jira board: https://cos10026-group3.atlassian.net/jira/software/projects/WWTP/summary

> This is a student project. It is **not affiliated with, authorised or endorsed by Apple Inc.**
> Both vacancies, the salaries and the hiring process are coursework content, not real job ads.
> Apple and the Apple logo are trademarks of Apple Inc. The application form only sends data to
> the Swinburne test script (`formtest.php`).

---

## Pages

| Page | What it contains |
|---|---|
| `index.html` | Logo, company name, slogan, description and image; CSS background graphic; search box with button; hiring-process table with merged cells (`rowspan`, `colspan`); Acknowledgement of Country and inclusive hiring statement; footer with Jira, GitHub and email links |
| `jobs.html` | Two job descriptions (`AFE26` Front-End Web Developer, `AUX26` Accessibility and UX Designer), each a `<section>` with salary, reporting line, responsibilities, essential (`<ol>`) and preferable (`<ul>`) requirements; `<aside>` floated right at 25% |
| `apply.html` | Job application form, `method="post"` to `https://mercury.swin.edu.au/it000000/formtest.php`, HTML5 validation with `pattern`, `maxlength`, `required`, `type="email"`; layout with CSS Grid |
| `about.html` | Group name and class details (nested list), selected project brief, members, contributions and quotes (definition list), a named member portrait collage in a bordered `<figure>`; acceptance as the required group photograph remains unverified |
| `styles.css` | Shared base, navigation, footer, responsive and print styles |
| `index.css`, `jobs.css`, `apply.css`, `about.css` | CSS specific to each matching HTML page |

The shared footer lists all four student contacts and embeds a Google Map of Apple Park beside the Pages links. Application results open in a new tab, preserving the original form and its answers.

Every page has the four meta tags taught in Week 1 (charset, description, keywords, author), the
viewport meta tag (Week 5), the shared navigation and footer, one embedded `<style>` example and one
inline `style` example (brief requirement).

## Project structure

```
applied-web-project-part1/
├── index.html
├── jobs.html
├── apply.html
├── about.html
├── styles.css
├── index.css
├── jobs.css
├── apply.css
├── about.css
├── images/
│   ├── logo.png             Apple logo glyph, 48 x 48 (source comment in index.html)
│   ├── hero-workplace.jpg   Hero illustration, 640 x 400
│   ├── bg-hero.jpg          Background graphic for the home page hero (CSS)
│   ├── group-portrait-1.png First supplied portrait, unchanged (1280 x 1280)
│   ├── group-portrait-2.png Second supplied portrait, unchanged (256 x 256)
│   ├── group-portrait-3.png Third supplied portrait, unchanged (960 x 1280)
│   ├── group-portrait-4.png Fourth supplied portrait, unchanged (245 x 324)
│   └── group-collage.jpg   Four original portraits and names, 1200 x 1320, 299185 bytes
├── docs/                    Supporting documentation (see below)
└── README.md
```

## Submission status (23 October 2026)

The four page owners, their student IDs and translated quotes are recorded. The live site works,
and Jira contains epics, stories, tasks and two Part 1 sprints. The coordinator confirmed on
23 October that the tutor approved the Apple topic and Zalo participation evidence, and that Peer
and Self Evaluation is not required for this submission. The portrait collage is below 300 KB;
it is not a photograph of the group together, and tutor acceptance of that substitute is unverified.
Other remaining items are personal confirmation of three members' coordinator-selected fun facts
and confirmation that the tutor can log in to Jira. The Access table lists the tutor with the Viewer role; actual tutor login remains unobserved.
The group and individual Canvas submissions have not yet been uploaded.

The current Canvas deadline for both Part 1 submissions is **1 November 2026, 23:59 Vietnam time**
(2 November, 03:59 Melbourne time).

The complete status, evidence and remaining submission steps are maintained in
[`docs/release-checklist.md`](docs/release-checklist.md).

## Running locally

Double-click `index.html`, or serve the parent folder to test it the way GitHub Pages serves it:

```bash
npx --yes http-server -p 8777 -a 127.0.0.1
```

Then open `http://127.0.0.1:8777/applied-web-project-part1/index.html`.

## Verification

| Check | Result |
|---|---|
| W3C Nu HTML Checker, all four deployed pages (23 October) | 0 errors, 0 warnings |
| W3C CSS Validator, all five deployed CSS files (23 October, CSS level 3 + SVG) | 0 errors |
| WAVE screenshots, all four pages (23 October) | 0 errors, 0 contrast errors; alerts reviewed |
| Published keyboard checks (23 October) | All four skip links visible on first Tab; Enter focuses main content; form control spot-check passed |
| Chrome responsive checks, four pages at 320, 375, 768, 1024 and 1280 px (20 October) | 20/20 without page overflow |
| Form pattern tests (7 October) | 28 of 28 as expected |
| POST to Mercury `formtest.php` (7 and 20 October) | All 13 field names echoed; result opens separately |

Details: `docs/test-report.md`.

## Acknowledgements

- External sources (Devicon logo glyph, Apple company information, Google Maps embed, City of Sydney)
  are acknowledged in adjacent HTML/CSS source comments. The concise AI acknowledgement,
  general use and translated prompt summary are in `index.html`.
