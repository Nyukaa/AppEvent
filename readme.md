# 🌍 Find Your Community – WordPress Theme, Plugin & React Filters

A custom WordPress prototype website for discovering **communities and events**, combining educational content, filtered listings, and detailed presentation pages.  
Fully responsive, bilingual (English & Finnish), and interactive with a React-based filtering interface.

🌐 **Live demo:** [findcommunity](https://findcommunity.great-site.net/)  
💻 **GitHub Repository:** [github](https://github.com/Nyukaa/AppEvent)

---

## 👩‍💻 Authors

- [@Kopiika](https://github.com/Kopiika)
- [@mashalink](https://github.com/mashalink)
- [@Nyukaa](https://github.com/Nyukaa)

---

## 🛠 Technologies Used

<p align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" title="PHP — WordPress templates, CPTs, meta fields, shortcodes" />
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5" title="HTML5 / CSS3 — responsive structure and layout" />
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3" />
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript" title="JavaScript / React — dynamic filtering system" />
  <img src="https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB" alt="React" />
  <img src="https://img.shields.io/badge/WordPress-21759B?style=for-the-badge&logo=wordpress&logoColor=white" alt="WordPress" title="WordPress API — content rendering and taxonomy logic" />
  <img src="https://img.shields.io/badge/Weglot-0D0D0D?style=for-the-badge&logo=weglet&logoColor=white" alt="Weglot" title="Weglot — bilingual support EN/FI" />
</p>

---

## ✅ Features

### 🔹 WordPress / PHP Part

- **Custom Post Types & Taxonomies**

  - `tourcatalog_tour` — used for both communities and events.
  - `tourcatalog_tour_category` — for categories and subcategories.

- **Custom Meta Fields**

  - `time`, `place`, `forwhom`, `language`.

- **Shortcodes**

  - `[tour-catalog category="event"]` — show all events.
  - `[tour-catalog category="community"]` — show all communities.

- **Single Pages**

  - Each community/event has its own detailed page with text and media.

- **Admin Interface**

  - Custom meta boxes for: time, place, audience, and language.

- **Responsive Design**
  - Works on desktop, tablet, and mobile.

---

### ⚛️ React Filters

- Filters read `data-*` attributes from each card:
  - Category, Subcategory, Place, Audience, Language, Time (for events).
- Dynamic filtering (no page reload).
- Options sorted alphabetically; “All” always appears first.
- Console logging enabled for debugging selected filters.

---

## 🔹 Site Structure

### 🏠 Home Page

- Hero section: **“Find your community – grow your network!”**
- Two buttons:
  - 🟢 **To Communities** → leads to the communities page
  - 🔵 **To Events** → leads to the events page
- Link to the **“What does networking mean”** page.
- Sections with latest:
  - Articles
  - Communities
  - Events
- Language switcher (EN/FI).

---

### 👥 Communities Page

- Displays all communities using `[tour-catalog category="community"]`.
- React filters by place, language, and audience.
- Subcategories appear under the title (if available).
- Cards are dynamically shown/hidden without reload.

---

### 📅 Events Page

- Displays all events using `[tour-catalog category="event"]`.
- React filters by date, place, audience, and language.
- Uses the same filtering logic as the community page.

---

### 📰 Articles Page

- Displays standard WordPress posts.
- Example: **“What does networking mean”** article.

---

## 🔧 Implementation Notes

- React reads data directly from WordPress markup via `data-*` attributes.
- No API calls — filtering happens on the client side.
- Custom post types and meta fields allow easy content management.
- React bundle must be located at  
  `wp-content/plugins/catalog/react/dist/`.

---

## ▶️ Setup Instructions

### 1. Theme

Activate **EventApp-theme** in:  
`WP Admin → Appearance → Themes → Activate EventApp-theme`

### 2. Plugin

Activate **Catalog Plugin** in:  
`WP Admin → Plugins → Activate`

### 3. Build React (if not yet built)

Path:  
`wp-content/plugins/catalog/react/filtr`

Run:

```bash
npm install
npm run build
```

### 📦 Copy React Build

After building your React project, copy the generated files to:

```
wp-content/plugins/catalog/react/dist/
```

---

## 📝 Create Pages

| **Page Name**                 | **Content**                           | **Purpose**                  |
| ----------------------------- | ------------------------------------- | ---------------------------- |
| **Communities**               | `[tour-catalog category="community"]` | Shows community list         |
| **Events**                    | `[tour-catalog category="event"]`     | Shows event list             |
| **Articles**                  | Regular WP posts                      | Blog and informational posts |
| **What does networking mean** | Informational text                    | Educational content          |

---

## ❓ Troubleshooting

| **Problem**               | **Solution**                                                          |
| ------------------------- | --------------------------------------------------------------------- |
| React filters not visible | Ensure `<div id="tour-filter-root" data-category="..."></div>` exists |
| Cards not showing         | Add posts to the CPT “Tours” and assign categories                    |
| React bundle missing      | Check that `dist/assets/index-*.js` and `.css` are built and loaded   |
| Layout or styling issues  | Clear your browser or CDN cache                                       |

---

## 📁 Project Structure

```
wp-content/
├── themes/
│ └── eventapp-theme/
│ ├── page-templates/
│ ├── style.css
│ └── functions.php
└── plugins/
└── catalog/
├── react/
│ ├── filtr/ ← React source files
│ └── dist/ ← Built React app
├── catalog.php
└── shortcodes.php
```

---
