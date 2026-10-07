# Release checklist

COS10026 Applied Web Project - Part 1, Group 3. Work through this list before the ZIP is uploaded
to Canvas. Code-side items are done; the open items need information or actions that only the
group or the tutor can provide.

## 1. Open items (group to do)

| # | Item | Where | Who |
|---|---|---|---|
| B-01 | Class day, class time and tutor name | `about.html` `#group-details` | Group |
| ~~B-02~~ | ~~Name and student ID of members 2 to 4~~ **Done 07/10/2026:** Le Ho Hoang Lan (106229050), Nguyen Quang Thang (106202475), Tran Vo Nhat Minh (106233462) | `about.html` | - |
| B-03 | Page owned and other work for members 2 to 4 (each student must build at least one page and its CSS) | `about.html`, `docs/contributions.md` | Each member |
| B-04 | Quote in each member's first language plus English translation; add `lang="xx"` on the quote's `<span>` | `about.html` `dd.quote` | Each member |
| B-05 | Fun facts for members 2 to 4 | `about.html` `#fun-facts` | Each member |
| B-06 | Real group photo (not individual photos), JPEG under 300 KB, saved as `images/group-photo.jpg` | `images/` | Group |
| B-07 | Delete the "Before submission" box at the top of `about.html` once B-01 to B-06 are done | `about.html` | Group |
| B-08 | Jira board has epics, user stories, tasks and at least two sprints, and the tutor has access | Jira | Group |
| ~~B-09~~ | ~~GitHub Pages switched on~~ **Done 07/10/2026:** repository public, Pages served from `main` `/` | GitHub settings | - |
| B-10 | Group Agreement submitted on Canvas by every member | Canvas | Each member |

Check that nothing is left:

```bash
grep -n 'class="placeholder"' *.html
```

must print nothing.

## 2. Done

| Item | Evidence |
|---|---|
| Four pages with shared navigation and footer | `index.html`, `jobs.html`, `apply.html`, `about.html` |
| Footer: Jira, GitHub repository, live site and email links | footer of every page |
| HTML and CSS validate | `docs/test-report.md` section 1 |
| Responsive, no horizontal page scroll | `docs/test-report.md` section 2 |
| Form validation and POST to `formtest.php` | `docs/test-report.md` section 3 |
| Aboriginal and Torres Strait Islander element with explanation | `index.html` `#acknowledgement` |
| GenAI acknowledgement with prompt in every file | top comment of each page and of `styles.css` |
| External sources acknowledged | `docs/references.md`, comments above the logo |

## 3. After the open items are done

1. Re-validate the changed pages at https://validator.w3.org/nu/ and `styles.css` at https://jigsaw.w3.org/css-validator/.
2. Run the WAVE extension on each live page and fix anything red.
3. Commit and push to `main`, wait about a minute, then open the live site and check every page and image.
4. Make the ZIP from the same commit: the four pages, `styles.css`, `images/` (and `docs/` if wanted).
5. Upload the ZIP to Canvas and paste the live site and repository links in the submission.
