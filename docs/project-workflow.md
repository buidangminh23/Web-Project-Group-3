# Proposed project workflow

COS10026 Applied Web Project - Part 1.

> **Everything in this file is a proposal.** No Jira project exists, no sprint has
> been run, and no retrospective has happened. Nothing here may be presented as
> completed work. The rubric awards Jira marks for a real board the tutor can
> open, not for this document.

---

## 1. Why two sprints

The brief requires *"user stories, epics, tasks, and at least two sprints"*. The
backlog in `jira-backlog.csv` is split so that each sprint ends with something
demonstrable:

| Sprint | Theme | Ends with |
|---|---|---|
| **Sprint 1** | Foundations and content pages | Shared shell, stylesheet, Home and Jobs complete and validating |
| **Sprint 2** | Form, team page, quality and release | Apply and About complete, everything validated, site deployed |

Proposed load: Sprint 1 **37** story points, Sprint 2 **44**. Re-estimate these
with your own team - points are only useful if the team sets them.

Dependency order that matters: the shared shell (PROJ-13, PROJ-15) blocks every
page, so it goes first. The group code confirmation (PROJ-11) blocks all content
writing, so raise it in the first tutorial.

---

## 2. Backlog structure

`jira-backlog.csv` contains **41 issues**: 8 epics, 11 stories, 22 tasks.

| Column | Jira field it maps to |
|---|---|
| Issue Type | Work type (Epic / Story / Task) |
| Summary | Summary |
| Description | Description |
| Parent | Parent (for Story and Task) or Epic Link, depending on your Jira version |
| Priority | Priority |
| Labels | Labels - semicolon separated, change the separator if your importer wants commas |
| Sprint | Sprint |
| Story Points | Story point estimate (custom field) |
| Proposed Assignee | Assignee - currently `TBC`, fill in with real names |
| Acceptance Criteria | Usually a custom field; if you do not have one, append it to the Description |
| Depends On | Issue links of type *blocks* / *is blocked by* |

### Honest note on importing

This CSV is written as **valid RFC 4180 CSV** (fields containing commas are
quoted). It has **not** been tested against a Jira importer, because no Jira
instance was available. Jira's CSV import is version-specific and fussy:

- `Parent` vs `Epic Link` differs between Jira versions and between team-managed
  and company-managed projects.
- Story points and acceptance criteria are custom fields whose names differ per
  site.
- Sprint values must usually match an existing sprint name, or be created first.
- The `PROJ-n` keys used in `Parent` and `Depends On` are **placeholders**.
  Real keys are assigned at import time, so you will most likely have to re-link
  parents and dependencies by hand afterwards.

If the import fights you, creating 41 issues by hand is perfectly reasonable and
often faster. **Do not claim the CSV imported cleanly unless it did.**

---

## 3. Proposed ceremonies

| Ceremony | When | Purpose |
|---|---|---|
| Sprint planning | Start of each sprint | Pull issues into the sprint and confirm owners |
| Stand-up | Each class, 5-10 minutes | What is done, what is next, what is blocked |
| Sprint review | End of each sprint | Walk the working site, not the board |
| Retrospective | End of each sprint | One thing to keep, one thing to change |

Record real dates as they happen. Do not pre-fill them.

---

## 4. Ownership rule from the brief

> *"Each student should be responsible for developing at least one page,
> including its required CSS styling."*

Two consequences worth planning for:

1. **Page ownership must be real and visible in the Git history.** One person
   pushing everyone's work makes it look as though only one person worked. Each
   member should commit their own page under their own account.
2. **Shared CSS changes affect all pages.** Each page has its own stylesheet,
   while `styles.css` holds the common base, navigation, footer and responsive
   rules. Agree who changes shared rules before editing `styles.css`.

Suggested split for a group of four - **confirm with your own team, do not adopt
this silently:**

| Member | Page | Page stylesheet |
|---|---|---|
| 1 | `index.html` | `index.css`; coordinate shared rules with member 2 |
| 2 | `jobs.html` | `jobs.css`; coordinate shared rules with member 1 |
| 3 | `apply.html` | `apply.css` |
| 4 | `about.html` | `about.css` |

For a group of three, member 4's work is usually split between members 1 and 3.

---

## 5. Branch and commit conventions

A workable convention, since the brief does not prescribe one:

- One branch per page: `feature/jobs-page`, `feature/apply-form`.
- Small, described commits: `Add floated aside to jobs page` beats `update`.
- Pull `main` before starting each session, to keep stylesheet conflicts small.
- Never commit directly to `main` once more than one person is working.

If two people edit `styles.css` at once, review both changes and check all four
pages after resolving the conflict.
