import { useState, useEffect } from "react";
import "./App.css";
export default function App() {
  const [tours, setTours] = useState([]);
  const [places, setPlaces] = useState([]);
  const [forwhoms, setForwhoms] = useState([]);
  const [languages, setLanguages] = useState([]);
  const [times, setTimes] = useState([]);
  const [subcategories, setSubcategories] = useState([]);

  // начальный фильтр
  const [filters, setFilters] = useState({
    category: "all",
    place: "all",
    forwhom: "all",
    language: "all",
    time: "all",
    subcategory: "all",
  });

  useEffect(() => {
    // Попробуем получить категорию из обёртки шорткода, например:
    // <div id="tour-filter-root" data-category="community"></div>
    const root = document.getElementById("tour-filter-root");
    const initialCategory = root?.dataset?.category || "all";
    setFilters((prev) => ({ ...prev, category: initialCategory }));

    // Чтение туров с DOM
    const tourElements = document.querySelectorAll(".tour");
    const tourData = Array.from(tourElements).map((el) => ({
      element: el,
      category: el.dataset.category,
      place: el.dataset.place,
      forwhom: el.dataset.forwhom,
      language: el.dataset.language,
      time: el.dataset.time,
      subcategory: el.dataset.subcategory,
    }));

    setTours(tourData);

    const sortedUnique = (arr) => [
      "all",
      ...Array.from(new Set(arr))
        .filter(Boolean)
        .sort((a, b) => a.localeCompare(b)),
    ];

    setPlaces(sortedUnique(tourData.map((t) => t.place)));
    setForwhoms(sortedUnique(tourData.map((t) => t.forwhom)));
    setLanguages(sortedUnique(tourData.map((t) => t.language)));
    setTimes(sortedUnique(tourData.map((t) => t.time)));
    setSubcategories(sortedUnique(tourData.map((t) => t.subcategory)));
  }, []);

  useEffect(() => {
    tours.forEach((t) => {
      const matchCategory =
        filters.category === "all" || t.category === filters.category;
      const matchPlace = filters.place === "all" || t.place === filters.place;
      const matchSubcategory =
        filters.subcategory === "all" || t.subcategory === filters.subcategory;
      const matchForwhom =
        filters.forwhom === "all" || t.forwhom === filters.forwhom;
      const matchLanguage =
        filters.language === "all" || t.language === filters.language;
      const matchTime = filters.time === "all" || t.time === filters.time;

      t.element.style.display =
        matchSubcategory &&
        matchCategory &&
        matchPlace &&
        matchForwhom &&
        matchLanguage &&
        matchTime
          ? "block"
          : "none";
    });
  }, [filters, tours]);

  return (
    <div
      className="tour-filters"
      // style={{ display: "flex", gap: "1rem", flexWrap: "wrap" }}
    >
      {/* Time (only for category = event) */}
      {filters.category === "event" && (
        <div className="filter-group">
          <label className="filter-time" htmlFor="time">
            Time:
          </label>
          <select
            id="time"
            onChange={(e) =>
              setFilters((prev) => ({ ...prev, time: e.target.value }))
            }
          >
            {times.map((t) => (
              <option key={t} value={t}>
                {t === "all" ? "All" : t}
              </option>
            ))}
          </select>
        </div>
      )}

      {/* Place */}
      <div className="filter-group ">
        <label className="filter-place" htmlFor="place">
          Place:
        </label>
        <select
          id="place"
          onChange={(e) =>
            setFilters((prev) => ({ ...prev, place: e.target.value }))
          }
        >
          {places.map((place) => (
            <option key={place} value={place}>
              {place === "all" ? "All" : place}
            </option>
          ))}
        </select>
      </div>

      {/* Subcategory */}
      <div className="filter-group">
        <label className="filter-subcategory" htmlFor="subcategory">
          Theme:
        </label>
        <select
          id="subcategory"
          onChange={(e) =>
            setFilters((prev) => ({ ...prev, subcategory: e.target.value }))
          }
        >
          {subcategories.map((sub) => (
            <option key={sub} value={sub}>
              {sub === "all" ? "All" : sub}
            </option>
          ))}
        </select>
      </div>

      {/* For whom */}
      <div className="filter-group">
        <label className="filter-forwhom" htmlFor="forwhom">
          Audience:
        </label>
        <select
          id="forwhom"
          onChange={(e) =>
            setFilters((prev) => ({ ...prev, forwhom: e.target.value }))
          }
        >
          {forwhoms.map((fw) => (
            <option key={fw} value={fw}>
              {fw === "all" ? "All" : fw}
            </option>
          ))}
        </select>
      </div>

      {/* Language */}
      <div className="filter-group">
        <label className="filter-language" htmlFor="language">
          Language:
        </label>
        <select
          id="language"
          onChange={(e) =>
            setFilters((prev) => ({ ...prev, language: e.target.value }))
          }
        >
          {languages.map((lang) => (
            <option key={lang} value={lang}>
              {lang === "all" ? "All" : lang}
            </option>
          ))}
        </select>
      </div>
    </div>
  );
}
