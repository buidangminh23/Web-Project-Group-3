# Requirements matrix

COS10026 Applied Web Project - Part 1, Group 3. Every requirement of the brief, where it is met,
and how to check it.

## General

| Requirement | Where | Status |
|---|---|---|
| Static site, HTML5 and CSS3 only, no JavaScript or Bootstrap | all files | Met |
| Pages `index.html`, `jobs.html`, `apply.html`, `about.html` | project root | Met |
| Common navigation menu on all pages | `<nav>` in each `<header>` | Met (identical four links, current page marked) |
| Validates as HTML5 | `docs/test-report.md` | Met, 0 errors |
| Semantic tags | `header`, `nav`, `main`, `section`, `aside`, `figure`, `figcaption`, `footer` | Met |
| Accessibility standards | labels, `alt`, heading order, `lang`, focus outline, contrast, `aria-labelledby` (Week 6) | Met |
| Aboriginal and Torres Strait Islander element, explained | `index.html` `#acknowledgement` | Met |
| Jira with epics, stories, tasks, two sprints | Jira board (`docs/jira-backlog.csv` is the import list) | Group to confirm (B-08) |
| Deployed on GitHub Pages | footer link | Repository owner to confirm (B-09) |

## index.html

| Requirement | Where |
|---|---|
| Company logo | `images/logo.png` in the header |
| Company name, slogan, description | `#hero` (`h1` "Apple", `.slogan` "Think different.", two paragraphs) |
| Image | `images/hero-workplace.jpg` in `.hero-figure` |
| Footer: Jira link, GitHub repository link, email link | `#site-footer` |
| Table with cell merging | `#process` table: `rowspan="2"` on Stage/Step headings and on Apply/Interview, `colspan="2"` on "What to expect", `colspan="3"` in `tfoot` |
| Search box with a button | `#search` form: `<input type="search">` + `<button type="submit">` |
| Background graphic using CSS | `styles.css` section 5: `#hero { background-image: url("images/bg-hero.jpg"); }` |

## jobs.html

| Requirement | Where |
|---|---|
| At least two job descriptions, semantic HTML | `section.job#job-afe26`, `section.job#job-aux26` |
| Reference number, exactly 5 alphanumeric | `AFE26`, `AUX26` |
| Title and short description | `h2` + first paragraph of each job |
| Salary and reporting line | `dl.job-facts` |
| Key responsibilities | `h3` "Key responsibilities" + `<ul>` |
| Essential and preferable requirements | `h4` "Essential" + `<ol>`, `h4` "Preferable" + `<ul>` |
| Headings with at least two levels | `h1`, `h2`, `h3`, `h4` |
| Multiple `<section>` elements | 2 job sections, each with 3 nested sections |
| One ordered list and one unordered list | `<ol>` essential, `<ul>` responsibilities and preferable |
| At least one `<aside>` | "Life at Apple" |
| `<aside>` floated right, 25% width, margin, padding, border | `styles.css` section 6 |

## apply.html

| Field | Rule in the brief | Implementation |
|---|---|---|
| Job reference number | exactly 5 alphanumeric | `pattern="[A-Za-z0-9]{5}"`, `maxlength="5"` |
| First name / Last name | max 20 alpha characters | `pattern="[A-Za-z]{1,20}"`, `maxlength="20"` |
| Date of birth | dd/mm/yyyy | text input, `pattern="(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[0-2])/[0-9]{4}"` |
| Gender | radio buttons in fieldset + legend | nested `<fieldset>` with `<legend>Gender</legend>` |
| Street address / Suburb | max 40 characters | `maxlength="40"` |
| State | dropdown of 8 states | `<select>` VIC, NSW, QLD, NT, WA, SA, TAS, ACT with empty first option |
| Postcode | exactly 4 digits | `pattern="[0-9]{4}"` |
| Email | valid format | `type="email"` |
| Phone | 8 to 12 digits | `type="tel"`, `pattern="[0-9]{8,12}"` |
| Skill list | check boxes | `name="skills[]"` |
| Other skills | textarea | `<textarea>`, the only optional field |
| Labels on all inputs | | `<label for>` or wrapping `<label>` on every control |
| All fields except textarea required | | `required` on each (see `decisions.md` D-04) |
| POST to formtest.php | | `method="post" action="https://mercury.swin.edu.au/it000000/formtest.php"` |
| Form layout using Flexbox or Grid | | `.form-grid` (Grid) and `.choices` (Flexbox) in `styles.css` section 7 |

## about.html

| Requirement | Where |
|---|---|
| Group name and class day/time, nested list | `#group-details` (placeholders for day/time, B-01) |
| Member contributions and quotes, definition list | `dl.members` |
| Quote in first language + English translation | `dd.quote` with `lang="vi"` for Bui Dang Minh (others B-04) |
| Group photo under 300 KB in `<figure>` with caption | `#group-photo` (placeholder image, B-06) |
| Fun facts table with caption | `#fun-facts` |
| Styled student IDs | `.student-id` |
| Bordered figure | `#group-photo { border: 4px solid #1d1d1f; }` |
| Table styled with hex colours and hover | `#fun-facts th`, `#fun-facts tbody tr:hover td` |

## CSS

| Requirement | Where |
|---|---|
| External stylesheet `styles.css` | linked from every page |
| At least one embedded CSS example on every page | `<style>` in each `<head>`, with a comment saying why |
| At least one inline CSS example on every page | one `style="..."` per page, with a comment saying why |
| Clear comments | header comment in the unit's format, section headings and a comment on every non-obvious rule |
| Wide range of selectors | universal `*`, element, class, id, `element.class`, descendant, child `>`, adjacent `+`, grouping, attribute `[type="submit"]`, `:hover`, `:visited`, `:focus`, `:first-child`, `:nth-child(even)` |
| Responsive layout | viewport meta tag + `@media` at 1024, 768 and 480 px; `max-width: 100%` images; `%` widths |
| Accessibility best practices | visible focus outline, underlined links, high-contrast colours, `em` font sizes, `line-height: 1.6`, no colour-only cues |

## Course scope

Everything used comes from the Week 1 to Week 6 material:

| Item | Week / source |
|---|---|
| Page template, meta charset/description/keywords/author, `lang` | Week 1, Lecture 1 |
| Headings, lists (incl. nested and `dl`), tables (`rowspan`, `colspan`, `thead`, `tbody`, `tfoot`, `caption`), images, `figure`, links, `mailto:`, entities | Week 2, Lecture 2 |
| Forms, input types, `pattern`, `required`, `maxlength`, `placeholder`, `fieldset`/`legend`, `section`, `aside`, `div`, `span` | Week 3, Lecture 3 |
| External, embedded and inline CSS, selectors, pseudo-classes, colours, fonts, background image, box model, borders | Week 4, Lecture 4 and Lab 4 |
| `float`/`clear`, `box-sizing`, `display`, Flexbox, Grid, `overflow-x`, viewport meta, `@media`, `@media print`, units | Week 5, Lectures 5 and 6, layout page, Flexbox Froggy, Grid Garden |
| Accessibility (labels, alt, headings, contrast, focus, `aria-labelledby`), web ethics, dark patterns | Week 6 |
| `<iframe>` (Google Map on `jobs.html`) | **Outside the Week 1 to 6 slides**; added at the group's request, explained in `decisions.md` D-15 |
