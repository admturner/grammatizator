# GRAMMATIZATOR CHANGE LOG & HISTORY

This theme is built on/around/in/through Eddie Machado's eminently solid Bones starter theme. See [Bones Change Log & History](#bones-change-log--history) below.

Grammatizator is a theme specially built and designed for the group-run, multi-authored public history website *Nursing Clio*. Learn more about it at: http://nursingclio.org/. For more information about Grammatizator visit: http://adamturner.org/.

Author: Adam Turner
URL: https://github.com/admturner/grammatizator

<!-- 
Changelog formatting (http://semver.org/): 

## Major.MinorAddorDeprec.Bugfix YYYY-MM-DD

### Todo (for upcoming changes)
### Security (in case of fixed vulnerabilities)
### Fixed (for any bug fixes)
### Changed (for changes in existing functionality)
### Added (for new features)
### Deprecated (for once-stable features removed in upcoming releases)
### Removed (for deprecated features removed in this release)
-->

---

## 1.5 Unreleased

### To Do

- Decide what kind of commenting system we want to use for the long haul.
- Decide whether JetPack is really what we want

---

## 1.0 release! Unreleased

### To Do

- Replace hard-coded Contributors list on Meet the Team page with dynamic list (and correctly assign contributor authors to posts currently attributed to Nursing Clio user).
- Finish updating readme.md
- Replace our jquery library with the one from the Google CDN
- Replace hard-coded Topics list with a function to call categories dynamically (including description).
- Get makefile working better
- Add Autoprefixer added to makefile workflow (just in case)

---

## 0.7 update Unreleased

### To Do

- Add Google Analytics
- Run validator assessments
- Determine feature image size and/or aspect ratio.
- Probably reintroduce WP Likes button (see functions.php to dos)

---

## 0.5 update Unreleased

### To Do

- Check all files for needed updates (the 404 page, for example).

---

## 0.4 initial 2015-05-30

### Changed

- General and widespread reformatting and restyling
- Replaced breakpoints with figures based on the site content + modular grid steps
- Converted breakpoint sizes to ems
- Replaced "nothing.gif" with a default comments avatar to use with placeholder script for mobile devices.
- Renamed the "top nav" to "global nav" and moved its HTML to the end of the content, rather than the header (now in footer.php) to use the footer-anchor method + JS menu toggle
- Wide-ranging style change to Grammatizator appearance
- Updated favicon image files to NC icons in /library/images/
- Updated readme.md to reflect new theme
- Formatting: trying to do better job of using [PHPDoc](https://make.wordpress.org/core/handbook/inline-documentation-standards/php-documentation-standards/) standards in PHP markup.
- Switched from using unset() to using the WordPress API and remove_meta_box() to deactivate selected widgets on the WordPress Dashboard in /library/admin.php
- Added correct Google Fonts call via functions.php
- Activated admin.php in functions.php by require() to customize Admin area
- Updated favicon.ico and favicon.png to a Nursing Clio (NC) icon in root dir
- Moving over from Bones defaults to Grammatizator

### Added

- Function in shortcodes.php to call wp_list_categories() for use in post/page content
- Function in functions.php to provide a more robust alternative to WordPress's list_users function; along with a shortcode in library/shortcodes.php to call it.
- front-page.php to main theme directory as uber-template for the home page.
- Script to scripts.js in /library/js to create mobile toggle menu nav
- A file shortcodes.php in /library to serve shortcodes to use in the content editor
- Directory /library/assets for things like illustrator SVG files and the like
- Added a 192x192 icon targeted at Android devices in /library/images/ (along with handful of other icon files with different resolutions).
- Function in admin.php to generate a "Welcome" message on the dashboard for users who haven't completed their Profiles in /library/admin.php
- Functions in functions.php to add fields to the user profile. A Gravatar helper, a User Title field (editable for editors and up), and a Twitter handle.

### Removed

- searchform.php in favor of the WP HTML5 built in search form.
- Ruby configuration file config.rb because I'm not using Compass. (Using GMU Make for compiling instead.)

*******************************************************************

# BONES CHANGE LOG & HISTORY

This theme is meant to make development easier & take
advantage of modern web development & design techniques.
For more information, please visit:

http://themble.com/bones/

Author: Eddie Machado

*******************************************************************

/* 1.71 update */
- added spacing to the password fields (thx @murtaugh)
- fixed calc percentage function
- removed chrome frame support


/* 1.(I've lost track so I'm starting at)7 update */
- reworked Sass files and broke them into partials
- setup Sass syntax and new mixins / functions
- added a ton of pull requests (thanks everyone)
- developed a bro crush on everyone who's helped contribute, thanks guys
- also lady crush since I don't want to leave out the helpful women
- animal crush? Who knows, just thanks everyone
- added pull paths for the includes in functions.php ( get_template_directory() )
- renamed clearfix to cf (just cuz i feel like it)
- removed custom search form since WordPress now supports HTML5 search form
- moving bones ahoy function to main functions file
- added content width and replaced css w/ the new markup for oembeds
- put the nav link functions directly in the templates, no need for extra functions
- removed navigation fallbacks, because really you never use those anyway
- removed the_author_posts_link() for a better more native function
- moved all the extra reset stuff to normalize, I mean these styles aren't changing so it's cool
- added wp_link_pages for people who are evil and break articles up into multiple pages
- worked out Theme Check issues

/* 1.5 update */
- sorted out new scss structure and cleaned up files
- more pull requests and language translations
- added some default form styles
- added a bunch of new style options and variables

/* 1.4 update */
- updated Modernizr to 2.6.2
- merged a ton of pull requests (thanks guys and gals!)
- added windows 8 tile support
- put LESS back in (too many requests)

**v1.3 update**
- removed version number from scripts & styles (thanks James)
- removed LESS (it's over Johnny, It's OVER!)
- changed post-content to entry-content
- added other changes to better align with Readability standards: http://www.readability.com/developers/guidelines (thanks @ChrisSki)
- added comment gravatar variable
- added fix for author name not showing in archive.php
- removed unused css files (that were mistakingly compiled)
- BORDER BOX ALL THE THINGS (http://paulirish.com/2012/box-sizing-border-box-ftw/)

**v1.25 update**
- updated custom post type page for translation
- added => to responsive jquery
- cleaned up theme tags (which make NO sense, but are best practice, go figure)
- updated html element to match hb5
- fixed echo problem on admin.php
- updated normalize (LESS also had some missing styles so I added them)
- GetComputedStyle fix for IE (for responsive js)
- cleaned up mixins (border radius)
- added translations! (Chinese, Spanish)

**v1.2 HUGE update**
- merge responsive version with classic
- remove post title from read more link (it's way too long)
- removed readme.txt (it was pointless)
- organized info for each file called in on the functions page
- added custom gravatar call in comments
- i'm leaving jQuery to a plugin (that way I'm not providing dated jQuery)
- added translation folder
- put everything inside stuff so it's easier to be translated
- added an identifier in each 404 area so you know what template is showing
- remove custom walker. I think that's better left for you guys to do
- fixed some spelling errors
- added some translation options in the comments file
- added role=navigation to footer links
- deleted image.php (who really uses that anyway)
- added sidebar to search.php
- added class to custom post type title
- added link to custom meta box
- removed selectivizr
- updated html elements with new classes for IE
- added new mobile meta tags
- removed pinned site meta tag for IE9
- merged base.css into style.css for one less call in the header
- added styleguide page and styles (oh yea!)
- added nav class to both menus
- removed "Powered by Wordpress & Bones" from footer, because let's face it: we all delete this anyway.
- added button class to submit comment button
- removed html5 placeholder fallback (you should be using Gravity Forms)
- added slug and rewrite to custom post type for easier urls
- renamed the border radius mixins so they were easer to remember
- removed duplicate box shadow mixin
- deleted the plugins.php file
- facebook og:meta can be better handled by a plugin (or Yoast's SEO plugin)
- rel=me can also be handled by SEO plugin or another plugin
- removed author.php (you can use archive.php or add it yourself)

**v1.09 more updates**
- updated admin.php to include custom widget examples, admin login styles, and admin footer
- login.css added for custom login styles
- custom login logo included

**v1.09 updates**
- added snippet to remove < p > from imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
- added custom admin functions file
- updated normalize
- added site description < p > to the header
- added page-ancestor class for nav to css
- added facebook open graph and google+ meta info (plugins.php)
- added a font-face example to stylesheet
- removed extra < div > around search function
- added role=article to article element
- added tag & category examples to custom post type


**v1.08 release (hellz yea!)**
- replaced default.css with normalize.css
- added responsive.css
- completely revamped styles & stylesheets
- moved most design related styles to style.css
- newer, cleaner default comment styles
- refined grid system
- added pubdate and time microformat to all templates
- changed page navi from div to nav and from ul to ol
- added Read More filter to replace the [...]
- removed default "Bones" text in footer if you don't have a menu
- updated modernizr to 2.0.6 & added FULL support (respond, load, ect)
- updated jQuery to 1.6.2
- added IE6 meta to remove toolbar
- added IE9 meta for pinned sites
- added viewport meta to help responsive designs
- removed PNG fixes for IE6...(fuck 'em)
- added prompt for IE6 users to install Google Chrome Frame
- removed respond.js since it's called in modernizr
- removed DOMAssistant for ancient IE users
- removed flowplayer folder (lighten the load)
- remove ie folder for IE scripts that are now gone
- moved translation function to bones.php
- removed overflow: hidden from some comment styles
- cleaned up head with more removals
- moved related posts & page navi plugin to bones.php
- removing wp version from rss feed
- removing useless wordpress dashboard widgets
- organizing bones & functions for simplicity
- removed analytics
- added auto hyphens to normalize.css (http://blog.fontdeck.com/post/9037028497/hyphens)
- removed the custom header image support
- removed all the favicons & icons
- added proper title tag
- added google+ link to profile
- added rel=me thanks to yoast's tutorial
- added author.php template
- removed html5 video shortcode


**v1.07 more changes**
- updated selectivizr
- compressed images

**v1.07 changes**
- added modernizr 2.0 custom build
- added IE=edge,chrome=1 for older, shitty browsers
- removed iphone stuff ( you can add later if you want it )
- changed h1 in the header to a p
- removed *font-size: small; from default.css
- removed empty selectors on default.css stylesheet
- fixed errors on style.css (mostly removing example using parenthesis)
- added jquery 1.6.1

**v1.07 w00t!**
- changed clear to clearfix across the board
- added 320 & Up Boilerplate Extension by Andy Clarke
- renamed modernizr to the current version file
- added all the different sized images & icons
- updated DOMAssistant to newest version


**v1.06 More Updates**
- added theme translation to all files
- removed categories form page meta info
- fixed confusing copyright issues
- removed the unneeded author / tag / ect archive title from taxonomy-custom-cat.php


**v1.06 Updates**
- changed name of default stylesheet to default so it's easier to
	debug. (having two stylesheets named style is confusing)
- added clearing class to #inner-header and #inner-footer
- added bones body class depending on what browser
- changed the_author to the_author_posts_link in single.php and archive.php
- changed the_author to the_author_posts_link in single-custom_type.php
- added custom taxonomy template
- added browser classes to style.css
- removed lazy load (sorry, it sucked)
- added twitter and facebook user profiles
- added post formats to bones.php core
- fixed menu system (thanks to Dom & Mattias)
- added categories & tag info for custom post types
- adding standard categories & tags to custom post type example


**v1.06**
- added custom post type and taxonomies file
- created custom post type template
- added readme.txt file (really for no reason at all)
- fixed the margin on the comments title
- removed duplicate text-align calls in css **Thanks Dom**
- added add_theme_support( 'automatic-feed-links' ) replacing
	the deprecated automatic_feed_links();
- added the language_attributes(); to the html tag
- replaced attribute_escape with esc_attr() in search.php
- bloginfo('url') in header replaced with echo home_url()
- using get_template_directory_uri() instead of bloginfo('template_directory')
- using get_the_author_meta('display_name') instead of deprecated function
- fixed error in bones.php for menu fallback **thanks Mark**
- creating thumbnail fallback functions
- added header.js and moved modernizr & imgsizer in that file
- added lazy load jquery plugin
- moved dd_belatedpng.js inside the ie folder in the libs folder
- changed class of main menu to .menu from .nav
- added more css for menu
- added additional selectors to the style.css in the root
- removed the top margin of the footer menu


**v1.05**
- fixed typos in style.css file & logs
- updated selectivizr to latest version
- added "embed, ruby, output" to the reset stylesheet based on
	Eric Meyer's recent reset styles.
- removed duplicate styles in reset & default stylesheet
- fixed col460 and changed it to col480
- added text-align styles to default stylesheet


**v1.04 Quick Fix**
- fixed error with script call that was deprecated.


**v1.04**
- moved the custom script call and pngfix to the footer
	from the bones file so it's easier to see what's being
	called.
- moved apple-touch-icon.png to the library/images folder so
	file locations are consistent.
- added a log file to keep track of changes
- fixed html5 video functionality & fallback (w00t!)
- moved stylesheet call below the wp_head as an experiment.
- added wp_titletag to the header
- added pingback function to the header
- fixed bug where page navi would show up even on pages
	with only one page of results.
- changed the way page navi is called in the archives, search,
	and index pages.


**v1.03**
- public release!
- added html5 video to plugins
- added page navi to plugins
- general fixes and optimization


**v1.02**
- html5 updates and semantic layout corrected
- added search css & custom functions
- added functionality from the html5boilerplate


**v1.01**
- added related posts functions
- general css fixes


**v1.00**
- i thought "there must be a better way"
- did something about it