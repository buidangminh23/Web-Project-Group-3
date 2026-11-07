# Project workflow and Jira record

COS10026 Applied Web Project - Part 1, Group 3. Checked 23 October 2026.

The live project is [WWTP](https://cos10026-group3.atlassian.net/jira/software/projects/WWTP/summary).
The board contains 41 work items: 8 epics, 11 stories and 22 tasks, with real assignees, priorities
and the `applied-web-part1` label. The Jira Access table lists the tutor with the Viewer role on 23 October 2026;
actual tutor login remains unobserved. No private tutor contact is published here.

## 1. Part 1 sprints

| Sprint | Recorded dates | Goal |
|---|---|---|
| AWP Part 1 Sprint 1 | 7-14 October 2026 | Review shared shell, Home, Jobs and governance |
| AWP Part 1 Sprint 2 | 15 October-1 November 2026 | Finish Apply, About, accessibility and submission |

Both Part 1 sprints are visible in the Jira reports selector. Sprint 2 is active. An older sprint
named WWTP Sprint 1 also exists and must not be confused with the two Part 1 sprints above.
Jira records were updated after some code work: the Sprint 1 activity includes items added on
18 October. Planned sprint dates do not prove that every item was entered or completed within
those dates. No stand-up, review or retrospective attendance is inferred from the board.

## 2. Backlog and status evidence

The live Jira board is authoritative for issue keys, parents, assignees, sprint membership and
current status. `jira-backlog.csv` is the original planning/import draft, not a live Jira export.
Its `PROJ-n` references, `TBC` assignees and suggested estimates must not be presented as the
current WWTP records or imported again over the live project.

Evidence should accompany a status change: a code commit, validator result, browser check or
submission receipt. A task with multiple acceptance criteria stays open until all are met.
For example, generating a ZIP does not complete a task that also requires Canvas submission.
The current portrait collage is below 300 KB and has a caption naming all four members. It does
not establish that the members were photographed together; tutor acceptance remains unverified.

WWTP-21 now has an Apply-specific title consistent with its existing Apply epic, description and
assignee. Its old About evidence comment was corrected to the authored Apply changes. WWTP-33
is Done following verification of both complete vacancy descriptions. WWTP-43 is Done after
the accessibility guideline/contrast review and published image/skip-link checks. WWTP-42 remains
In Progress in the last verified Jira snapshot. New local browser checks are recorded in
`test-report.md` section 9; no live Jira status change is inferred from this documentation update.

WWTP-27 remains In Progress: Minh's Group Agreement receipt is verified, and the other members'
receipts are not. WWTP-47 remains In Progress for the group: Minh confirmed completing his
interview, while other members' attendance remains unverified. WWTP-25 and WWTP-46 are In
Progress for final ZIP preparation and Canvas submission; generating the final archive does not
establish submission. WWTP-44 records the final deployment run and verified commit after the documentation update.

The canonical remaining requirements and their issue links are in `release-checklist.md`.
This workflow document does not duplicate live status totals, which change as work is completed.

## 3. Ownership and integration

| Member | Page | Page stylesheet |
|---|---|---|
| Bui Dang Minh (105716425) | `index.html` | `index.css`; shared `styles.css` |
| Le Ho Hoang Lan (106229050) | `jobs.html` | `jobs.css` |
| Nguyen Quang Thang (106202475) | `apply.html` | `apply.css` |
| Tran Vo Nhat Minh (106233462) | `about.html` | `about.css` |

`contributions.md` links this ownership to the actual author records in Git. Each member's page
work is distinct from the repository owner's merge and integration work. Shared stylesheet
changes require checks on all four pages.

## 4. Working conventions

- Coordinate file ownership before editing shared files, and preserve concurrent work.
- Keep commits focused and descriptive; retain the actual author's identity.
- Fetch and inspect the latest branch before integration, then validate changed pages and styles.
- Update Jira with the work that was actually verified. Keep missing personal details, tutor
  access and submission receipts open until they are supplied or observed.
- Use the existing interview guide to rehearse explanations and live changes; preparation is
  separate from attendance or an assessed interview outcome. Minh confirmed on 23 October that
  his interview was completed in class; no grade is recorded here.
