# WPdoodlez, Polls, Quizz and Crossword

### WPDoodlez
plan and vote to find a common appointment date with participiants for an event. It adds a custom post type "wpdoodlez".

Shortcode: ```[wpdoodlez_sc id=post-ID chart=true]``` set post ID to integrate Doodlez or Poll in other pages, set chart to false if you do not want pie graph

### Poll
uses same technology and custom post type like WPDoodlez
create classic polls to let visitors vote about a question

Shortcode: ```[wpdoodlez_stats]``` show stats of all polls in a list

### Quizzz
Play a quiz game with one or four answers and hangman (galgenmännchen) option for finding the solution
Quizzz supports categories images and integrates them in single and header if used in theme. It adds a custom post type "question"
see readme.txt for more details.
Add Shortcode ```[random-question]``` to any post, page or html-widget

### Crossword (Keuzwort)
display a crossword game built on the quizzz words
can be invoked from the menu in each quizfrage post or in the random question widget shortcode

### word puzzle (Wortpuzzle)
display a word puzzle from selected answers from quiz. On dragging over the correct words the question will be displayed
can be invoked from the menu in each quizfrage post or in the random question widget shortcode


## Why this fork?
the main project was not updated for years now. I needed some features and added them to the project.
Completed the german and german formal translations. Added method to use structure for polls (only one answer allowed)
Added quiz custom post type "question" to make a 4 answers and single answer quiz with results certificate. questions can be played as hangman, when answer ist suitable

## GDPR (DSGVO) notice
Participiants do net need to enter their full name (a nick name would do).
A cookie "wpdoodlez-hashofthevote" with the given nic name is stored on the local computer to
notice that one has voted already - so you should opt-in cookies and place a note on your GDPR statement.

If Using penguin-mod theme cookies will only be set after visitor allows comfort cookies (stated by hidecookiebannerx=2 cookie-setting).

WPDoodlez (posts or posts with wpd shortcode) can be password protected (with builtin wordpress logic) to prevent others seeing the content
Archives, Post Content, Post-Thumbnail, Categories and Tags have been enabled to provide full integration like a normal post.

Quizzz game has a shortcode for random questions and a custom post type "question" for quiz. It can display a certificate to print
and stores your ranking in a personal cookie. personal rankings are only stored in your browser, not the web server and only if you allow comfort cookies

## Highlights for WPDoodlez
* WPDoodlez can handle classic polls and doodle like appointment planning
* If custom fields are named vote1...vote10, a poll is created, just displaying the vote summaries
if custom fields are dates e.g  name: 12.12.2020    value: ja<br>
then a doodlez is created where visitors can set their name or shortcut and vote for all given event dates

User parameter /admin=1 to display alternate votes display (more features when logged in as admin)

* link to WPdoodlez is public, but post can have password
* A WPdoodlez can be in a review and be published at given time
* A WPdoodlez can have own URL (in scope of custom post type)
* Poll users do not need to be valid logged in wordpress users
* Users with "delete published post" rights can delete votes
* Users shortname will be stored in a cookie for 30 days (user can change only his own vote, but on the same computer)
* Every custom field set in a WPdoodle is a possible answer
* The first value of the custom field will be displayed in the row as users answer
* The last row in the table contains total votes count

## Details
Based on Wordpress custom types. Rich text, media, comments and categories can 
be a part of every polling. Voting options comes from custom fields (in post 
editor under the text editing field) and the first value of every given custom 
field will be shown as user answer. (Multiple answers are possible)
For example: Custom field name is *Monday*, the value *I like mondays*. The 
column name will be "Monday" and every person voted on monday have in the row
unter *Monday* *I like mondays*. If not voted on Monday the cell will be empty.

Every person can vote once. Used name will be stored in a cookie for 30 days. 
Every person can change only own voting if the cookie is still in the browser.

Administrators and editors can delete every vote (but not the cookie on the 
browser).
