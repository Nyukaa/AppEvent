# 🔌 Tour Catalog Plugin

A custom WordPress plugin to manage and display guided mushroom tours. Provides **shortcode** and **widget** functionality, making it easy to showcase tours anywhere on your site.

---

## ✅ Features

- **Custom Post Type:** `tourcatalog_tour`
  - Stores tours with details: **price**, **duration**, **date**, and **place**.
  - Featured image and full description supported.
- **Custom Meta Fields:**
  - **Price** — numeric value in €
  - **Duration** — in hours
  - **Time / Date** — date of the tour
  - **Place** — location of the tour
- **Custom Taxonomy:** `tourcatalog_tour_category` — categorize tours (e.g., Forest, Mushroom Picking, Seasonal).
- **Shortcode:** `[tour-catalog category="all"]`
  - Responsive grid of tour cards with metadata, image, content.
  - Single **“Book a Tour” button** at the bottom.
- **Widget:** Tour Catalog Widget
  - Displays **nearest upcoming tour** (tomorrow or later) in sidebar or footer.
  - Shows featured image, title, price, duration, date, and place.
- Fully responsive and styled to match the theme.

---

## 🔹 Plugin File Structure

´´´
catalog/
│
├─ tour-catalog.php ← Main plugin loader
├─ css/
│ └─ tourcatalog.css ← Styles for catalog grid, cards, icons, button
├─ includes/
│ ├─ tour-catalog-post-type.php ← Registers CPT, meta boxes, taxonomy
│ ├─ tour-catalog-shortcode.php ← Shortcode logic, outputs grid
│ └─ tour-catalog-widget.php ← Widget class for nearest upcoming tour
´´´

---

## 📋 Installation

1. Upload the `catalog` folder to your WordPress `wp-content/plugins/` directory.
2. Activate the plugin via **WordPress Admin → Plugins**.
3. Add `[tour-catalog]` shortcode to any page to display tours.
4. Add **Tour Catalog Widget** to any widget area (sidebar/footer) to show nearest upcoming tour.

---

## 👤 Author

- Portfolio: [Anna](https://nyukaa.github.io/BCNew/Portfolio/index.html)

---

## 🆘 Support

For issues or feature requests, contact the author via [GitHub](https://github.com/Nyukaa).
