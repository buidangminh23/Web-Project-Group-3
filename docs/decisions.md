# Design decisions

COS10026 Applied Web Project - Part 1, Group 3. Short record of choices the tutor may ask about
in the interview, with the reason for each.

| ID | Decision | Reason |
|---|---|---|
| D-01 | The company is **Apple**, presented as the Apple Online Store web team in Sydney | Chosen by the group. Framing the roles around the online store keeps the jobs web-related (front-end development and accessible UX design) and realistic for a recruitment site. |
| D-02 | A disclaimer on every page: student project, not affiliated with Apple Inc., vacancies are fictional | Apple is a real company. Week 6 web ethics (transparency): visitors must not be misled into thinking these are real job ads. |
| D-03 | The footer email is `info@apple-careers.example`, plus the student contact address | The brief asks for an email link such as `info@companyname.com`. A real Apple address would send coursework mail to a real company, so a reserved `.example` domain is used for the company address. |
| D-04 | Skills: the "HTML and CSS" check box is the required one | The brief says every field except the textarea must be required. HTML cannot require "at least one box in a group" without JavaScript, and making every box required would force applicants to claim skills they do not have. HTML and CSS are essential for both roles, so that box is the required one and the page says why. |
| D-05 | Names accept only letters A to Z (`[A-Za-z]{1,20}`) | The brief says "max 20 alpha characters". Names with hyphens or apostrophes are therefore rejected; this is the brief's rule applied literally. |
| D-06 | Date of birth is a text field with the pattern `(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[0-2])/[0-9]{4}` | The brief asks for `dd/mm/yyyy`, which `type="date"` cannot guarantee. The pattern checks the format and ranges but not the calendar (31/02 passes). |
| D-07 | Gender has four options, including "Non-binary" and "Prefer not to say" | Week 6 inclusive design: do not force people into options that do not describe them. |
| D-08 | The search box opens `jobs.html` and does not filter | Filtering needs server-side code, which is not allowed in Part 1. A visible note tells the user, so the button is not a dark pattern. |
| D-09 | Acknowledgement of Country names the **Gadigal people of the Eora Nation** | The advertised roles are in Sydney's CBD, which is Gadigal Country. The Swinburne Canvas page models naming the Traditional Owners of the place where you are. It is combined with an inclusive hiring statement and an explanation of why it is on the page, as the brief requires. |
| D-10 | Images are PNG and JPEG, resized to their display size | The course teaches PNG, JPEG and GIF, and says to resize images in an editor rather than scale them with `width`/`height` (Lecture 2). |
| D-11 | Current page in the menu is marked with `class="current"` and a coloured underline | Week 4 usability notes: indicate the current location in the navigation bar. |
| D-12 | Only one inline and one embedded CSS example per page | The brief requires at least one of each on every page but warns that overuse reduces marks. Each one has a comment explaining why it is not in `styles.css`. |
| D-13 | Layout uses float (jobs aside), Flexbox (header, hero, footer, check boxes) and Grid (form) | Float is required for the aside; the brief asks for Flexbox or Grid on the form. Both are from Week 5 (layout page, Flexbox Froggy and Grid Garden). |
| D-14 | `box-sizing: border-box` on all elements | Lecture 6 (CSS3 box model). It keeps the 25% aside at 25% after padding and border are added. |
| D-15 | `jobs.html` embeds a Google Map of Apple headquarters (Apple Park, One Apple Park Way, Cupertino, CA 95014) with `<iframe>` | Requested by the group. It is plain HTML, so the "no JavaScript" rule is kept, and it validates. `<iframe>` is **not in the Week 1 to 6 slides**: it displays another web page inside ours. It has a `title` for screen readers, `loading="lazy"`, a responsive CSS width, a source comment, a cookie notice (Week 6 privacy) and a plain link to Google Maps as a fallback. |
