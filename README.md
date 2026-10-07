# Apple Careers - recruitment website

COS10026 Web Technology Project
**Assessment 2: Applied Web Project - Part 1** (group component, 70 marks) - Group 3

A static recruitment website for **Apple** (the Apple Online Store web team in Sydney),
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
| `jobs.html` | Two job descriptions (`AFE26` Front-End Web Developer, `AUX26` Accessibility and UX Designer), each a `<section>` with salary, reporting line, responsibilities, essential (`<ol>`) and preferable (`<ul>`) requirements; `<aside>` floated right at 25%; embedded Google Map of Apple headquarters (Apple Park) |
| `apply.html` | Job application form, `method="post"` to `https://mercury.swin.edu.au/it000000/formtest.php`, HTML5 validation with `pattern`, `maxlength`, `required`, `type="email"`; layout with CSS Grid |
| `about.html` | Group name and class details (nested list), members, contributions and quotes (definition list), group photo in a bordered `<figure>`, fun facts table with hover effect |
| `styles.css` | The single external stylesheet, 10 commented sections including responsive media queries and print styles |

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
├── images/
│   ├── logo.png             Apple logo glyph, 48 x 48 (see docs/references.md)
│   ├── hero-workplace.jpg   Hero illustration, 640 x 400
│   ├── bg-hero.jpg          Background graphic for the home page hero (CSS)
│   └── group-photo.jpg      PLACEHOLDER - replace with the real group photo (< 300 KB)
├── docs/                    Supporting documentation (see below)
└── README.md
```

## Before submission (team to do)

Search for the yellow placeholders and replace each one with real details:

```bash
grep -n 'class="placeholder"' about.html
```

1. Class day, time and tutor name.
2. Page owned, other work, quote in Vietnamese + English translation for Le Ho Hoang Lan, Nguyen Quang Thang
   and Tran Vo Nhat Minh (names and student IDs are already filled in).
3. Fun facts for members 2 to 4.
4. Replace `images/group-photo.jpg` with a real group photo (JPEG, under 300 KB, keep 800 x 450 or update
   `width`/`height` in `about.html`), then delete the "Before submission" box at the top of `about.html`.
5. Check the Jira board has epics, user stories, tasks and two sprints, and that the tutor has access.
6. Make sure GitHub Pages is switched on and the live link works (the repository must allow Pages).

Full list: `docs/release-checklist.md`.

## Running locally

Double-click `index.html`, or serve the parent folder to test it the way GitHub Pages serves it:

```bash
python3 -m http.server 8777
```

Then open `http://127.0.0.1:8777/applied-web-project-part1/index.html`.

## Verification (07/10/2026)

| Check | Result |
|---|---|
| W3C Nu HTML Checker, all four pages | 0 errors, 0 warnings |
| W3C CSS Validator (CSS level 3 + SVG) | 0 errors |
| No horizontal page scroll at 320, 375, 768, 1024 and 1280 px | Pass |
| Form pattern tests (valid and invalid values for every rule) | 28 of 28 as expected |
| POST to Mercury `formtest.php` | HTTP 200, all 13 field names echoed |

Details: `docs/test-report.md`.

## Acknowledgements

- Generative AI: Claude (Anthropic, Claude Opus 5.5, October 2026) was used for code suggestions,
  page wording and the two illustrations. Each file says how it was used and includes the prompt,
  as required by the unit.
- External sources: Apple logo glyph from Devicon (MIT); everything else is original.
  See `docs/references.md`.
