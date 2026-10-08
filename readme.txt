=== Lessonlark ===
Contributors: mathiswp
Requires at least: 6.6
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 0.2.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A warm, modern block theme for tutoring and education businesses.

== Description ==

Lessonlark is a full site editing theme for tutors, tutoring centers, and education businesses. It ships with a complete landing page: hero with preview cards, stats, subject cards, how-it-works steps, testimonials, FAQ, and a call to action. Every section is a pattern you can edit or rearrange in the Site Editor.

Also included: bundled Fraunces and Figtree fonts, a sticky header, a card-grid blog, "Card" and "Eyebrow" block styles, and three color variations (Default, Meadow, Berry).

The theme comes with the free Lessonlark Booking plugin, which powers the "Book a session" form (requests are emailed to you and saved under Bookings) and an optional Cal.com / Calendly calendar.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click Add New Theme.
2. Click Upload Theme, choose the theme zip file, and click Install Now.
3. Click Activate.
4. On the Dashboard, click "Install & activate" in the Lessonlark notice to turn on the booking form.
5. Go to Appearance > Editor to customize templates, colors, and fonts.

== Frequently Asked Questions ==

= How do I change the colors and fonts? =

Go to Appearance > Editor > Styles. Changes there apply site-wide.

= Where are the landing page sections? =

Open the block inserter, choose Patterns, and look in the "Lessonlark" category.

= How do I change the phone number and email shown on the site? =

Go to Appearance > Contact details and fill in your phone, email, and hours. They replace the sample details everywhere the theme shows them, including the call and email links.

= Where do booking requests go? =

To the site admin email by default (change it in the Booking form block's settings), and every request is also saved under Bookings in wp-admin. If emails don't arrive, your host probably needs an SMTP plugin; the requests are still saved.

= How do I use Cal.com or Calendly instead of the form? =

Insert the "Book a session (calendar)" pattern and paste your booking link into the Scheduler block.

= The "Install & activate" button didn't work =

Some hosts don't let WordPress write files directly. Zip the plugins/lessonlark-booking folder from inside the theme and upload it under Plugins > Add New > Upload Plugin.

== Changelog ==

= 0.2.1 =
* Contact details (phone, email, hours) are set once under Appearance → Contact details and fill in the footer, the booking section, and the call and email buttons, text and links together.
* The site now speaks as one tutor ("I", "me") throughout, instead of mixing "we" on the homepage with "I" on the About page; the "match you with the right tutor" wording is gone. The booking form and its emails use neutral wording ("You’ll hear back…") so the plugin suits a solo tutor or a center.

= 0.2.0 =
* Renamed from Tutor Theme to Lessonlark (to avoid confusion with Tutor LMS).
* Sample content now describes the service (grades, subjects, reply time) instead of making ratings or results claims; the testimonials are marked as samples to replace.
* Phone layout: shorter hero badge, stats in a 2×2 grid, decorative circles hidden where they would sit behind text.
* Secondary text on dark sections now follows the active color variation.
* New patterns: About the tutor (photo + bio), How I teach, Hero with photo, and an About page starter that appears when you create a new page. Photo spots use a placeholder image you replace with your own.
* New "Page without title" template for About and landing pages that bring their own headings.
* Booking buttons in the hero, CTA, and FAQ link to the booking form on the homepage, so they work from any page.
* Automatic update notifications from GitHub releases (MathisWP/lessonlark).
* Redesign: new palette, bundled Fraunces and Figtree fonts, shadows, pill buttons.
* New patterns: Stats, FAQ, Header, redesigned Hero, Services, How It Works, Testimonials, Call to Action, Footer.
* Sticky header with call-to-action button; multi-column footer.
* Blog and archive templates use a card grid.
* Added Meadow and Berry style variations.
* Added Card (group) and Eyebrow (paragraph) block styles.
* New "Book a session" and "Book a session (calendar)" patterns, powered by the bundled Lessonlark Booking plugin (form, or Cal.com / Calendly). Without the plugin they show email and phone buttons.
* Bundled Lessonlark Booking plugin with one-click install, activate, and update from the Dashboard.
* Page and post content can now use full-width blocks.

= 0.1.0 =
* Initial release.

== Copyright ==

Lessonlark WordPress Theme, (C) 2026 MathisWP
Lessonlark is distributed under the terms of the GNU GPL (see the LICENSE file).

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

== Resources ==

Fraunces
Copyright 2018 The Fraunces Project Authors (https://github.com/undercasetype/Fraunces)
License: SIL Open Font License, Version 1.1 (https://openfontlicense.org)
Source: https://fonts.google.com/specimen/Fraunces
License file: assets/fonts/OFL-Fraunces.txt

Figtree
Copyright 2022 The Figtree Project Authors (https://github.com/erikdkennedy/figtree)
License: SIL Open Font License, Version 1.1 (https://openfontlicense.org)
Source: https://fonts.google.com/specimen/Figtree
License file: assets/fonts/OFL-Figtree.txt

Screenshot
Created by MathisWP from this theme's own patterns. License: GPLv2 or later.

Plugin Update Checker 5.7
Copyright (c) 2023 Jānis Elsts
License: MIT (inc/vendor/plugin-update-checker/license.txt)
Source: https://github.com/YahnisElsts/plugin-update-checker

This theme bundles no third-party images.
