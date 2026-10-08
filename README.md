# Lessonlark

A WordPress block theme for tutoring and education businesses. Full site editing, custom design tokens in `theme.json`, and ready-made patterns for a marketing front page.

## Structure

- `theme.json` — design system: colors, typography (fluid), spacing scale, layout widths, block/element styles
- `templates/` — page templates (front page, blog index, single post, page, archive, search, 404)
- `parts/` — header and footer template parts
- `patterns/` — Hero, Services, How It Works, Testimonials, Call to Action
- `functions.php` — stylesheet enqueue and pattern category registration

## Local development

Requires Docker and Node.

```sh
npm install
npm run start
```

Then open http://localhost:8888 (admin at http://localhost:8888/wp-admin, user `admin`, password `password`). The theme is mounted from this directory — edits show up on refresh. Activate it under Appearance → Themes if it isn't already active.

Stop the environment with `npm run stop`.

## Customizing

- Colors and fonts live in `theme.json` under `settings` (available in the editor) and `styles` (defaults applied site-wide).
- The front page (`templates/front-page.html`) is assembled from the patterns in `patterns/` — edit those files, or redesign visually in the Site Editor and export.
