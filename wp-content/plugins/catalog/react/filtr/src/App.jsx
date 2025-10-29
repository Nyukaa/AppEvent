import { useState, useEffect } from "react";
import "./App.css";

export default function App() {
  // Категория приходит извне: event | community
  const [category, setCategory] = useState("event");

  const [tours, setTours] = useState([]);
  const [places, setPlaces] = useState([]);
  const [forwhoms, setForwhoms] = useState([]);
  const [languages, setLanguages] = useState([]);
  const [subcategories, setSubcategories] = useState([]);
  const [sortOrder, setSortOrder] = useState("asc"); // asc = ближайшие раньше

  // фильтры БЕЗ category и time
  const [filters, setFilters] = useState({
    place: "all",
    forwhom: "all",
    language: "all",
    subcategory: "all",
  });

  // читаем корневую категорию и карточки
  useEffect(() => {
    const root = document.getElementById("tour-filter-root");
    const initialCategory = root?.dataset?.category?.toLowerCase();
    setCategory(initialCategory === "community" ? "community" : "event");

    const tourElements = document.querySelectorAll(".tour");
    const tourData = Array.from(tourElements).map((el) => ({
      element: el,
      category: (el.dataset.category || "").toLowerCase(),
      place: el.dataset.place ?? "all",
      forwhom: el.dataset.forwhom ?? "all",
      language: el.dataset.language ?? "all",
      time: el.dataset.time ?? "",
      subcategory: el.dataset.subcategory ?? "all",
    }));

    setTours(tourData);
  }, []);

  // пересобираем варианты для текущей категории
  useEffect(() => {
    const fromCurrent = tours.filter((t) => t.category === category);
    const sortedUnique = (arr) => [
      "all",
      ...Array.from(new Set(arr.filter(Boolean))).sort((a, b) =>
        String(a).localeCompare(String(b))
      ),
    ];
    setPlaces(sortedUnique(fromCurrent.map((t) => t.place)));
    setForwhoms(sortedUnique(fromCurrent.map((t) => t.forwhom)));
    setLanguages(sortedUnique(fromCurrent.map((t) => t.language)));
    setSubcategories(sortedUnique(fromCurrent.map((t) => t.subcategory)));

    // если выбранное значение отсутствует в новой категории — сброс на all
    setFilters((prev) => ({
      place: fromCurrent.some((t) => t.place === prev.place)
        ? prev.place
        : "all",
      forwhom: fromCurrent.some((t) => t.forwhom === prev.forwhom)
        ? prev.forwhom
        : "all",
      language: fromCurrent.some((t) => t.language === prev.language)
        ? prev.language
        : "all",
      subcategory: fromCurrent.some((t) => t.subcategory === prev.subcategory)
        ? prev.subcategory
        : "all",
    }));
  }, [tours, category]);

  // утилита сопоставления с учётом фиксированной category
  const matches = (t, f) =>
    t.category === category &&
    (f.place === "all" || t.place === f.place) &&
    (f.forwhom === "all" || t.forwhom === f.forwhom) &&
    (f.language === "all" || t.language === f.language) &&
    (f.subcategory === "all" || t.subcategory === f.subcategory);

  // утилита парсинга даты
  const parseTime = (value) => {
    const d = new Date(value);
    return isNaN(d.getTime()) ? NaN : d.getTime();
  };

  // Грей-аут: сколько карточек будет, если выбрать value для key
  const countFor = (key, value) => {
    const next = { ...filters, [key]: value };
    return tours.filter((t) => matches(t, next)).length;
  };

  // применяем видимость и сортировку
  useEffect(() => {
    // видимость
    tours.forEach((t) => {
      const visible = matches(t, filters);
      t.element.classList.toggle("is-hidden", !visible);
    });

    // сортировка только для event
    if (category === "event") {
      const container =
        tours[0]?.element?.parentElement || document.querySelector(".tours");
      if (!container) return;

      const now = Date.now();
      const visible = tours
        .filter(
          (t) =>
            t.category === category &&
            !t.element.classList.contains("is-hidden")
        )
        .map((t) => {
          const ts = parseTime(t.time);
          const isBad = Number.isNaN(ts);
          const isPast = !isBad && ts < now;
          const isFuture = !isBad && ts >= now;
          return { ...t, ts, isBad, isPast, isFuture };
        });

      const future = visible.filter((x) => x.isFuture);
      const past = visible.filter((x) => x.isPast);
      const bad = visible.filter((x) => x.isBad);

      const cmp = (a, b) => (sortOrder === "asc" ? a.ts - b.ts : b.ts - a.ts);
      future.sort(cmp);
      past.sort(cmp);

      const ordered = [...future, ...past, ...bad];
      ordered.forEach((t) => container.appendChild(t.element));
    }
  }, [filters, tours, sortOrder, category]);

  const handleFilterChange = (e) => {
    const { name, value } = e.target;
    setFilters((prev) => ({ ...prev, [name]: value }));
  };

  // Рендер option с дизейблом, если выбор приведёт к 0
  const renderOption = (key, v) => {
    const disabled = v !== "all" && countFor(key, v) === 0;
    const label = v === "all" ? "All" : v;
    return (
      <option key={v} value={v} disabled={disabled}>
        {label}
      </option>
    );
  };

  return (
    <div className="tour-filters">
      {/* Subcategory */}
      <div className="filter-group">
        <label htmlFor="subcategory" className="filter-subcategory">
          Subcategory:
        </label>
        <select
          id="subcategory"
          name="subcategory"
          value={filters.subcategory}
          onChange={handleFilterChange}
        >
          {subcategories.map((s) => renderOption("subcategory", s))}
        </select>
      </div>

      {/* For whom */}
      <div className="filter-group">
        <label htmlFor="forwhom" className="filter-forwhom">
          For whom:
        </label>
        <select
          id="forwhom"
          name="forwhom"
          value={filters.forwhom}
          onChange={handleFilterChange}
        >
          {forwhoms.map((f) => renderOption("forwhom", f))}
        </select>
      </div>

      {/* Place */}
      <div className="filter-group">
        <label htmlFor="place" className="filter-place">
          Place:
        </label>
        <select
          id="place"
          name="place"
          value={filters.place}
          onChange={handleFilterChange}
        >
          {places.map((p) => renderOption("place", p))}
        </select>
      </div>

      {/* Language */}
      <div className="filter-group">
        <label htmlFor="language" className="filter-language">
          Language:
        </label>
        <select
          id="language"
          name="language"
          value={filters.language}
          onChange={handleFilterChange}
        >
          {languages.map((l) => renderOption("language", l))}
        </select>
      </div>

      {/* Sort by date: только для event */}
      {category === "event" && (
        <div className="filter-group">
          <label htmlFor="sortOrder" className="filter-time">
            Sort by date:
          </label>
          <select
            id="sortOrder"
            name="sortOrder"
            value={sortOrder}
            onChange={(e) => setSortOrder(e.target.value)}
          >
            <option value="asc">Nearest first</option>
            <option value="desc">Farthest first</option>
          </select>
        </div>
      )}
    </div>
  );
}
