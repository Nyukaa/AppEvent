# Find Your Community – WordPress Theme & React Filters

A custom WordPress prototype website for discovering communities and events, combining educational content, filtered listings, and detailed presentation pages for communities and events. Fully responsive, bilingual (English & Finnish), and interactive thanks to a React-based filter interface.

🌐 Live demo: _[insert link if deployed]_  
💻 GitHub Repository: _[insert link]_

---

## ✅ Features

### WordPress / PHP Part

- **Custom Post Types & Taxonomies:**
  - `tourcatalog_tour` post type for both communities and events.
  - Taxonomy `tourcatalog_tour_category` for categories and subcategories.
- **Custom Meta Fields:**
  - `time`, `place`, `forwhom`, `language` for tours/events.
- **Shortcodes:**
  - `[tour-catalog category="event"]` or `[tour-catalog category="community"]` to display filtered content.
  - Dynamic output includes category, subcategory, and meta fields for each community/event.
- **Single Pages:**
  - Each community/event links to its dedicated page with full content and media.
- **Admin Interface:**
  - Custom meta boxes for time, place, target audience, and language.
- **Responsive Design:**
  - Frontend layout adapts to desktop, tablet, and mobile.

### React Part (Frontend Filters)

- Filters implemented with React reading `data-` attributes from cards:
  - Category
  - Subcategory
  - Place
  - For whom (target audience)
  - Language
  - Time (shown conditionally if category is "event")
- Filters dynamically hide/show tour cards based on selection.
- Options sorted alphabetically, with "All" always first.
- Console logging available for debugging filtered values.

---

## 🔹 Site Structure

### Homepage

- Hero section: “Find your community – grow your network!”
- Clear link to “What does networking mean” page.
- Featured categories and events.
- Introduction to site functionality and language selection.

### Category View

- Tours/communities shown by category with interactive React filters.
- Subcategories displayed below the title if available.
- Dynamic filtering hides irrelevant content.

### Presentation Page for a Community

- Name, location, target audience.
- Image/video placeholder.
- Short introduction.
- Join link.

### Presentation Page for an Event

- Name, location, date, target audience.
- Image/video placeholder.
- Short introduction.
- Link to event organizer.

### “What does networking mean” Page

- Placeholder content (lorem ipsum) until finalized.
- Content available in both English and Finnish.

---

## 🔧 Implementation Notes / Challenges

- React reads dynamic WordPress output using `data-` attributes to avoid extra API requests.
- Filter logic updates card visibility without reloading the page.
- Custom post types and meta fields allow content managers to easily add new communities/events in WordPress.
- Deployment considerations:
  - Migrating media files required re-uploading.
  - Plugins and shortcodes needed careful configuration on live server.
  - Ensuring React filters work seamlessly with WordPress output.

---

## 🛠 Technologies Used

- **PHP** — WordPress templates, loops, custom post types, meta fields, shortcodes.
- **HTML5 / CSS3** — Structure and responsive design.
- **JavaScript / React** — Interactive filters for tours/events.
- **WordPress API** — Custom loops, taxonomies, template hierarchy.
- **Weglot (optional)** — Multilingual support EN/FI.

---

## 👤 Author
