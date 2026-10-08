=== Lessonlark Booking ===
Contributors: mathiswp
Tags: booking, contact form, tutoring, calendly, cal.com
Requires at least: 6.6
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 0.2.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A ready-to-use "Book a session" form for tutoring sites, plus a Cal.com / Calendly scheduler block.

== Description ==

Lessonlark Booking adds two blocks:

**Booking form** – a tutoring request form that works with zero setup. It collects parent name, email, phone, the student's grade, subjects, online or in-person, preferred times, and a message.

* Requests are emailed to the site admin (or any address you choose in the block settings).
* Every request is also saved under **Bookings** in wp-admin, so a lost email never means a lost lead.
* Mark each request as "Followed up" once you've contacted the family. The Bookings menu badge shows how many still need a reply.
* The visitor gets a short confirmation email (can be turned off).
* Spam protection without CAPTCHAs: honeypot field, minimum fill time, and per-IP rate limiting.
* Works without JavaScript; with JavaScript it submits in place with inline errors.
* Styled to match the Lessonlark theme, and uses your theme's colors and fonts in any block theme.

**Scheduler** – embed your Cal.com or Calendly booking page so visitors can pick an exact time.

Designed for the Lessonlark theme, which includes "Book a session" patterns using both blocks. Works with any theme.

== Frequently Asked Questions ==

= I'm not receiving the emails =

Many hosts can't send email reliably from WordPress. Requests are always saved under Bookings, so you can check there too. Install an SMTP plugin to fix delivery.

= Can I change the grade levels or session options? =

Yes, with the `lessonlark_booking_grades` and `lessonlark_booking_formats` filters. Subjects are editable in the block settings.

= Can I use a self-hosted Cal.com? =

Yes. Add your domain with the `lessonlark_booking_scheduler_hosts` filter.

= Can I do something after a booking is submitted? =

Use the `lessonlark_booking_submitted` action. It receives the booking ID and the submitted data.

== Privacy ==

Submitted details are stored as private posts in your database and emailed to the recipient you configure. Visitor IP addresses are never stored; a one-way hash is kept for up to 10 minutes for rate limiting. The Scheduler block loads content from Cal.com or Calendly and is subject to their privacy policies.

== Changelog ==

= 0.2.1 =
* Neutral wording in the form note, success message, error messages, and the visitor's confirmation email ("You'll hear back…"), signed with the site name, so it suits a solo tutor or a center.

= 0.2.0 =
* Replaced the "Reply by email" button with a "Followed up" flag: mark each request once you've contacted the family (by any channel). Bookings gets a Status column, "Needs follow-up" / "Followed up" filters, bulk actions, and the menu badge now counts requests still needing follow-up. Removed the Email column, and "Received" now shows the date the request came in.

= 0.1.1 =
* Renamed from Tutor Booking to Lessonlark Booking (to avoid confusion with Tutor LMS). Block names are now lessonlark/booking-form and lessonlark/scheduler.
* Fix: the booking form showed "Something went wrong" on every submit because the script posted to the wrong URL.
* "Reply by email" in Bookings now opens a message to just the email address, which works with more email apps and webmail.

= 0.1.0 =
* Initial release.
