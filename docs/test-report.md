# Test report

COS10026 Applied Web Project - Part 1, Group 3. Tested on 07/10/2026 on macOS (Google Chrome).

## 1. Validation

| Check | Tool | Result |
|---|---|---|
| `index.html` | W3C Nu HTML Checker (https://validator.w3.org/nu/) | 0 errors, 0 warnings |
| `jobs.html` | W3C Nu HTML Checker | 0 errors, 0 warnings |
| `apply.html` | W3C Nu HTML Checker | 0 errors, 0 warnings |
| `about.html` | W3C Nu HTML Checker | 0 errors, 0 warnings |
| `styles.css` | W3C CSS Validator (https://jigsaw.w3.org/css-validator/), profile CSS level 3 + SVG | 0 errors |

At the strictest warning level the CSS validator lists informational warnings only: "no
background-color set but you have set a color" (the background comes from a parent element) and
"Redefinition of width" (the media queries deliberately change a value set earlier in the file).
Neither is an error.

## 2. Responsive layout

Each page was loaded at five widths and the page width (`scrollWidth`) compared with the window width.

| Width | index | jobs | apply | about |
|---|---|---|---|---|
| 320 px | no page scroll | no page scroll | no page scroll | no page scroll |
| 375 px | no page scroll | no page scroll | no page scroll | no page scroll |
| 768 px | no page scroll | no page scroll | no page scroll | no page scroll |
| 1024 px | no page scroll | no page scroll | no page scroll | no page scroll |
| 1280 px | no page scroll | no page scroll | no page scroll | no page scroll |

At 320 and 375 px the two tables are wider than the screen; they scroll sideways inside their
`.table-wrapper` box (`overflow-x: auto`, Lecture 5) so the page itself never scrolls.

| Layout rule | Desktop | 768 px and below |
|---|---|---|
| `jobs.html` aside | `float: right; width: 25%` with margin, padding and border | stops floating, full width |
| Home hero | text and image side by side (Flexbox) | stacked |
| Application form | two-column Grid | one column |
| Footer | three columns (Flexbox) | one column |

## 3. Application form

Each rule was tested in Chrome with `checkValidity()`, setting one valid and several invalid values.

| Field | Value | Expected | Result |
|---|---|---|---|
| Job reference | `AFE26` | valid | valid |
| Job reference | `afe2` (4 characters) | invalid | invalid |
| Job reference | `AFE26X` (6 characters) | invalid | invalid |
| Job reference | `AF-26` (symbol) | invalid | invalid |
| First name | `Minh` | valid | valid |
| First name | `Anne-Marie` (hyphen) | invalid | invalid |
| First name | 20 letters | valid | valid |
| First name | 21 letters | invalid | invalid |
| First name | `Minh2` (digit) | invalid | invalid |
| Date of birth | `02/03/2006` | valid | valid |
| Date of birth | `2/3/2006` | invalid | invalid |
| Date of birth | `32/01/2000` (day 32) | invalid | invalid |
| Date of birth | `15/13/2000` (month 13) | invalid | invalid |
| Date of birth | `2006-03-02` | invalid | invalid |
| Postcode | `2000` | valid | valid |
| Postcode | `200`, `20000`, `20a0` | invalid | invalid |
| Phone | `0412345678` (10 digits) | valid | valid |
| Phone | `123456789012` (12 digits) | valid | valid |
| Phone | `1234567` (7), `1234567890123` (13) | invalid | invalid |
| Phone | `0412 345 678` (spaces) | invalid | invalid |
| Email | `a@b.com` | valid | valid |
| Email | `ab.com` | invalid | invalid |
| Street | empty | invalid | invalid |
| State | `Please select` (empty value) | invalid | invalid |
| State | `NSW` | valid | valid |

28 of 28 cases matched. Every input, select and textarea has a `<label>`; every field except the
"Other skills" textarea is required (the gender radio group through `required` on its first
button; the skills group through the required "HTML and CSS" box, see `decisions.md` D-04).

Known limit: the date pattern checks the format and the ranges 01-31 and 01-12, not the calendar,
so `31/02/2000` is accepted. HTML alone cannot check that; it will be checked server-side in Part 2.

### POST to the test script

The form was submitted to `https://mercury.swin.edu.au/it000000/formtest.php` with sample data.
The script returned HTTP 200 and echoed all 13 name/value pairs: `job_ref`, `first_name`,
`last_name`, `dob`, `gender`, `street`, `suburb`, `state`, `postcode`, `email`, `phone`,
`skills` (two values) and `other_skills`.

## 4. Links and images

All internal links (`index.html`, `jobs.html`, `apply.html`, `about.html`) and image paths are
relative, so the site works from the GitHub Pages sub-folder. All four images load and are under
40 KB each.

Google Map on `jobs.html`: the embed URL returns HTTP 200 with no `X-Frame-Options` header, and the
map renders in Chrome at desktop and phone widths.

## 5. Not tested

- Screen readers (VoiceOver) and browsers other than Chrome.
- The WAVE extension report: run it on the live site before submission and fix anything red.
