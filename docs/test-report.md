# Test report

COS10026 Applied Web Project - Part 1, Group 3. Updated 23 October 2026.
Section 10 records the final comment-only acknowledgement revision. Section 9 records the
collage and required-skills behaviour; earlier sections retain dated observations from previous
revisions and do not establish the current source-comment coverage.

## 1. Validation and deployed files (23 October 2026)

| Check | Tool | Result |
|---|---|---|
| `index.html`, `jobs.html`, `apply.html`, `about.html` | [W3C Nu HTML Checker](https://validator.w3.org/nu/) against each live URL | Each: 0 errors, 0 warnings |
| `styles.css`, `index.css`, `jobs.css`, `apply.css`, `about.css` | [W3C CSS Validator](https://jigsaw.w3.org/css-validator/), CSS level 3 + SVG profile | Each: valid, 0 errors |
| Four HTML pages, five CSS files and two portraits | HTTP retrieval of the GitHub Pages files and comparison with committed source | All eleven matched `4fb5bca`; the four updated HTML pages with versioned stylesheet URLs are live at `1c0dcd7` |
| Internal page links and local assets | Local path checks | All referenced files exist |

The CSS request suppressed warnings; the result establishes zero errors, not zero warnings.
Windows working-tree line endings differ from the deployed files; the comparison used committed
Git content so line-ending conversion did not produce a false mismatch. The final source check
after `1c0dcd7` returned an empty W3C Nu message list for each HTML page and valid/zero-error
results for all five stylesheets. The stylesheet URL version avoids stale browser caching.

Earlier checks: on 18 October, all five stylesheets passed a local syntax parse, and Chrome
computed styles and element positions matched the pre-split version on four pages at 320,
768 and 1280 px (12 cases). These are historical regression results.

## 2. Responsive layout

On 20 October 2026, each page was loaded in Chrome at five widths and the page width
(`scrollWidth`) compared with the window width (20 cases). These measurements predate the
23 October About content changes; a fresh responsive walkthrough is tracked in Jira WWTP-42. Keyboard observations from
23 October are recorded below.

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
| Footer (updated 20/10/2026) | four columns (Grid); two at 1024 px and below | two columns; one at 480 px and below |

## 3. Application form

On 7 October 2026, the rules were tested in Chrome with `checkValidity()`, setting valid and
invalid values. The 20 October end-to-end form check is recorded in section 6.

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

28 of 28 cases matched. Every input, select and textarea has a label. The text fields and state
selection were required; the gender radios formed a required group. These historical checks used
a combined HTML/CSS checkbox and optional additional checkboxes. Section 9 supersedes that
structure with two independently required HTML and CSS checkboxes and the optional textarea.

Known limit: the date pattern checks the format and the ranges 01-31 and 01-12, not the calendar,
so `31/02/2000` is accepted. Calendar validation remains a limitation of this implementation;
server-side validation belongs to the later project stage.

### POST to the test script

On 7 October, the form was submitted to `https://mercury.swin.edu.au/it000000/formtest.php` with sample data.
The script returned HTTP 200 and echoed all 13 name/value pairs: `job_ref`, `first_name`,
`last_name`, `dob`, `gender`, `street`, `suburb`, `state`, `postcode`, `email`, `phone`,
`skills` (two values) and `other_skills`.

## 4. Links and images

All internal links (`index.html`, `jobs.html`, `apply.html`, `about.html`) and image paths are
relative, so the site works from the GitHub Pages sub-folder. The current image set contains three
site graphics, four unchanged supplied portraits and the displayed portrait collage. The former
generated group-photo placeholder is no longer used.

The Google Map is in the shared footer of all four pages. Its rendering at desktop and phone
widths was checked on 20 October. Earlier About revisions displayed the separate supplied
portraits; sections 7 and 8 retain those historical checks. The current About figure displays
one 1200 x 1320 JPEG collage with an accessible caption. It is 299185 bytes, below 300 KB, but
it is not a photograph of the group together. Tutor acceptance remains unverified.

## 5. Accessibility evidence and limits

The retained WAVE screenshots dated 23 October in the individual submission record show:

| Page | Errors | Contrast errors | Alerts | AIM score |
|---|---|---|---|---|
| Home | 0 | 0 | 3 | 10 |
| Jobs | 0 | 0 | 3 | 10 |
| Apply | 0 | 0 | 1 | 10 |
| About | 0 | 0 | 1 | 10 |

The alerts include redundant links: the brand and Home navigation target the same page, and
Jobs also has repeated application destinations. These are manual review prompts, not proof of
an inaccessible page. They remain recorded rather than being hidden as zero alerts. WAVE
screenshots establish the state when captured; they are not a screen-reader test or a complete
accessibility certification.

On 23 October, a live keyboard check traversed the four navigation links in order, activated
About with Enter, traversed the Apply controls with visible 3 px focus outlines, and toggled a
skill checkbox with Space in both directions. After publication of `1c0dcd7`, the first Tab on
each of the four pages displayed Skip to main content with a visible orange 3 px outline;
Enter moved focus to `main-content`. This verifies the published skip link on all four pages.
That earlier revision used temporary portrait alternatives. The current collage alternative and
full member-name caption are checked in section 9.

Not yet verified: a screen-reader walkthrough and browsers other than Chrome. Earlier viewport
limitations were superseded by the connected Chrome checks in sections 7 to 9. WWTP-42 was In
Progress in the last verified Jira snapshot; these new checks do not change its live status.

### Review against the unit accessibility guideline (23 October)

The supplied *Accessibility in Microsoft Office & Webpages* by Armita Zarnegar was reviewed,
particularly PDF pages 3-5 (web, keyboard and vision guidance) and 10-12 (document checks).

| Guideline area | Source/evidence review | Remaining boundary |
|---|---|---|
| Accurate image alternatives | All displayed image elements have alt text; the collage caption names all four original portrait subjects | Real group photograph still needed |
| Heading structure and clear navigation | Semantic headings and consistent four-page navigation are present | Screen-reader navigation not tested |
| Form instructions and keyboard operation | Labels, fieldsets, legends, format hints and visible focus styles are present; native controls were traversed by keyboard | Changed-page responsive checks in section 9; screen-reader walkthrough pending |
| Readable type and spacing | Shared body uses Helvetica/Arial sans-serif, scalable em sizes and 1.6 line height | No claim of testing every assistive reading configuration |
| Colour and contrast | WAVE evidence shows zero contrast errors; representative CSS text pairs calculated below | Gradient/image backgrounds still require visual review |
| Consistent layout and non-colour cues | Shared navigation/footer, labelled controls, underlined body links and written status/hints | No full accessibility conformance claim |
| Media alternatives | No audio/video player is used by this project | The embedded map is external content with a title and fallback link |

Representative sRGB contrast calculations from the current CSS use relative luminance and
`(lighter + 0.05) / (darker + 0.05)`. They supplement the WAVE screenshots rather than replacing
rendered-page checks.

| Text / background | Use | Contrast ratio |
|---|---|---|
| `#1d1d1f` / `#ffffff` | Body text | 16.83:1 |
| `#424245` / `#f5f5f7` | Secondary/footer text | 9.20:1 |
| `#0066cc` / `#ffffff` | Body links | 5.57:1 |
| `#ffffff` / `#0071e3` | Buttons and About table headings | 4.70:1 |
| `#f5f5f7` / `#1d1d1f` | Header navigation | 15.46:1 |
| `#1d1d1f` / `#d6e9ff` | About table hover text | 13.59:1 |

WWTP-43 is Done following the guideline/contrast review and verification of the published image
alternatives and skip links. This completes that review task; it does not imply full accessibility
conformance or completion of WWTP-42's outstanding responsive verification.

## 6. Form and footer regression checks (20/10/2026)

- W3C Nu HTML Checker: all four updated pages returned zero messages (0 errors, 0 warnings). All four also passed a strict local HTML5 parse; all five CSS files passed a local syntax parse.

- Chrome through the connected browser extension: all four pages at 320, 375, 768, 1024 and 1280 CSS px had no horizontal page overflow (20/20 cases). Every case contained four student email links and one map in the footer. The map rendered beside Pages on desktop.
- First/last name, street/suburb, state/postcode and email/phone pairs share top coordinates on desktop; text inputs and the select measure 48 px high. Radio padding is 0 px. The form stacks below 768 px.
- State and territory labels show full Australian names. All eight submitted abbreviations and native validation attributes remain unchanged.
- Submitted made-up values in Chrome to Mercury. A separate result tab displayed all 13 field names, including `state=ACT`. Closing it left the original form populated with `Test`, `ACT` and `Test only`; Clear form reset the fields and selections.
- Mercury's own Back button remains unavailable: its referenced `https://mercury.swin.edu.au/it000000/formutil.js` returned HTTP 404. The HTML-only new-tab behaviour avoids relying on it and is explained before the form.

- Class details are Wednesday, 09:00 to 12:00, tutor Thomas Harrison, as confirmed by the coordinator. Current 23 October source contains all four translated quotes and the styled fun-facts table; the 12 cells for three members are now filled with coordinator-selected entries whose personal confirmation remains open.

- About now includes a Selected project brief section describing the chosen Apple recruitment site, both advertised roles, the four pages and the HTML5/CSS3-only Part 1 scope.

## 7. Additional portrait update (23 October, superseded image layout)

The coordinator supplied a third portrait and confirmed the image order: Tran Vo Nhat Minh, Bui Dang Minh, Le Ho Hoang Lan. The About page displays these full names below unchanged source images. Desktop CSS uses three columns; the rule at 600 px switches to one column. The source passed W3C HTML validation with zero errors and warnings. Publication evidence is recorded in WWTP-44; fresh narrow-viewport verification remains open in WWTP-42. The coordinator subsequently supplied Nguyen Quang Thang's fourth portrait (245 x 324). The original PNG is preserved unchanged, with its full name and an accurate alternative. The current desktop grid has two columns and two rows; the existing rule at 600 px retains a single column. The updated source passed W3C HTML validation with zero errors and warnings. Connected Chrome checks at 320, 375, 600, 601, 768 and 1280 px found no horizontal page overflow, confirmed all four original image dimensions, and verified `object-fit: contain`. The measured grid gap is 16 px; 600 px and below uses one column, while 601 px and above uses two. These remain individual portraits, not a complete group photograph.


## 8. About content and gallery alignment (23 October, superseded image layout)

The 12 previously empty fun-fact cells now contain coordinator-selected entries for Lan, Thang and Nhat Minh. All four rows have five populated cells, and Bui Dang Minh's existing row is unchanged. Personal confirmation of those three rows remains open in B-05. The webpage displays the completed table without a provisional label.

The outer gallery caption was removed; all four individual name captions and original portraits remain. Scoped About styles center the Our group heading and bordered figure. Connected Chrome checks at 320, 375, 600, 601, 768 and 1280 px measured a 0 px difference between the horizontal centers of the section and figure, no horizontal page overflow, and four loaded portraits. The existing two-column desktop and one-column mobile rules remain in place.

## 9. Collage and required-skills checks (23 October, before comment restoration)

This section supersedes the separate-portrait layouts and combined skill checkbox described in
sections 1 to 8. The source validation below was repeated on the final website changes.

- W3C Nu HTML Checker: all four HTML files returned zero messages (0 errors, 0 warnings).
- W3C CSS Validator: all five external stylesheets returned valid with 0 errors using the
  CSS level 3 + SVG profile. Warning suppression means no warning-count claim is made.
- Local source checks: 28 deliverable files, four HTML pages, five CSS files and 56 local
  HTML references; every local reference exists. All HTML/CSS files contain zero comments
  and no script elements. The four original portrait PNGs match revision 7d11a82 byte for byte.
- The displayed collage is the exact coordinator-supplied JPEG: 1200 x 1320, 299185 bytes,
  SHA-256 f3a1d8599fde583498c508b44564917eec90b4a325cacdd8421fb62a53f093c4.
  It uses the original portraits with names; faces were not regenerated. The single image
  retains its aspect ratio, and the real HTML caption names all four members in row order.
- Connected Chrome checks for About and Apply at 320, 375, 768 and 1280 CSS px, then back
  to 320 px, passed 10/10 cases without horizontal page overflow. The collage figure's
  horizontal center differed from its section center by 0 px in all five About cases.
  Its rendered width at 1280 px was 786.40625 px; the figure retained its 820 px maximum.
- With all other fields valid, neither skill, HTML only and CSS only each leave the form
  invalid. Both required skills with an empty Other skills textarea make it valid. The
  two checked controls supply skills[]=html and skills[]=css. Keyboard Space disables
  and re-enables HTML validation correctly; its focused outline is 3 px. Both checkbox
  labels are 48 px high at every tested width. No external test-server submission was
  performed for this revision; earlier POST results are historical.

The coordinator confirmed tutor approval of the Apple topic and Zalo participation evidence,
and exemption from Peer and Self Evaluation on 23 October. The Jira Access table lists
the tutor with the Viewer role; actual tutor login remains unobserved. The collage is below 300 KB but is not a
photograph of the group together, so acceptance as a substitute remains unverified. Personal
confirmation of the three coordinator-selected fun-fact rows remains open. Source comments were
absent at this revision; section 10 supersedes that acknowledgement/comment status.

The publication gate compares all 17 website HTML/CSS/image files against committed Git bytes
after a successful GitHub Pages run. The exact final main SHA and run URL are returned with the
publication result so the Windows report and ZIP can be rebuilt from that stable revision.

## 10. Minimal source comments and truthful acknowledgements (23 October)

This revision adds comments only to the four HTML files and five external stylesheets. Removing
only the inserted comment lines, including their introduced line whitespace, reproduces each
file at baseline a94110e exactly (9/9). All eight image assets remain byte-identical to that
baseline; no visible content, functional code, stylesheet URL or asset was changed.

- W3C Nu HTML Checker was rerun on all four final HTML sources: each returned zero messages
  (0 errors, 0 warnings).
- W3C CSS Validator was rerun on all five final external stylesheets: each was valid with
  0 errors using CSS level 3 + SVG. Warnings were suppressed; no warning-count claim is made.
- Concise explanatory comments cover meaningful CSS groups, including shared focus/base rules,
  navigation, sections, table overflow, footer columns, responsive layout and print behaviour.
- Source comments sit beside all four Devicon logo uses and Google Maps embeds, Home company
  information/Country wording, form guidance and state names. Hero image/background comments
  identify the original AI-assisted visual assets.
- AI comments identify tool names, general use and a translated prompt summary in
  index.html. Other HTML/CSS files refer
  to that acknowledgement. Only the translated summary remains in the current submission.
  It is not a verbatim prompt record; exact application builds and historical runtimes remain
  unverified. No detailed per-tool task list is included.
- The deterministic portrait collage is not labelled as an AI-generated face image. Its original
  sources and the outstanding tutor acceptance/member-confirmation items are unchanged.

No functional or responsive tests were repeated for this comment-only revision: the exact
comment-stripped baseline proof preserves the section 9 implementation and its dated results.
Those earlier checks remain historical evidence, not newly executed tests. The final publication
gate compares all 17 live website HTML/CSS/image files with committed bytes after a successful
Pages run; the stable main SHA, owner commits, PRs and run URL accompany the hand-off result.

## 11. Documentation-only cleanup (24 October)

The standalone references document was removed from the current tree. README and supporting
documents now point to the actual adjacent HTML/CSS source comments. The full original prompt
was not moved or duplicated; only the approved translated summary remains in index.html.
B-11 remains Partial because that summary is not verbatim and exact application builds and
historical runtimes remain unverified. After removing complete comment lines/blocks, including
their indentation and terminating newline, all nine HTML/CSS files are byte-identical to
baseline `a94110e`; all eight images are byte-identical without transformation.
Functional, responsive and validator results above retain their original dates; this cleanup
does not represent a rerun of those tests. Publication verification compares all 17 live files
with the final committed revision after its successful Pages run.
