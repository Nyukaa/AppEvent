import { useState, useEffect } from "react";

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
    // <div id="tour-filter-root" data-category="event"></div>
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
      style={{ display: "flex", gap: "1rem", flexWrap: "wrap" }}
    >
      {filters.category === "event" && (
        <label>
          Time:
          <select
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
        </label>
      )}

      {/* Place */}
      <label>
        Place:
        <select
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
      </label>

      {/* Subcategory */}
      <label>
        Theme:
        <select
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
      </label>

      {/* For whom */}
      <label>
        For whom:
        <select
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
      </label>

      {/* Language */}
      <label>
        Language:
        <select
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
      </label>
    </div>
  );
}
// import { useState, useEffect } from "react";

// export default function App() {
//   console.log("Hello");
//   const [tours, setTours] = useState([]);
//   const [categories, setCategories] = useState([]);
//   const [subcategories, setSubcategories] = useState([]);
//   const [places, setPlaces] = useState([]);
//   const [forwhoms, setForwhoms] = useState([]);
//   const [languages, setLanguages] = useState([]);
//   const [times, setTimes] = useState([]); // 🕓 добавлено

//   const [filters, setFilters] = useState({
//     category: "all",
//     subcategory: "all",
//     place: "all",
//     forwhom: "all",
//     language: "all",
//     time: "all", // 🕓 добавлено
//   });

//   // 1️⃣ Читаем все туры из DOM
//   useEffect(() => {
//     const tourElements = document.querySelectorAll(".tour");

//     const tourData = Array.from(tourElements).map((el) => ({
//       element: el,
//       category: el.dataset.category,
//       subcategory: el.dataset.subcategory,
//       place: el.dataset.place,
//       forwhom: el.dataset.forwhom,
//       language: el.dataset.language,
//       time: el.dataset.time, // 🕓 добавлено
//     }));

//     setTours(tourData);

//     // helper: сортируем + добавляем "all" в начало
//     const sortedUnique = (arr) => [
//       "all",
//       ...Array.from(new Set(arr))
//         .filter(Boolean)
//         .sort((a, b) => a.localeCompare(b)),
//     ];

//     setCategories(sortedUnique(tourData.map((t) => t.category)));
//     setSubcategories(sortedUnique(tourData.map((t) => t.subcategory)));
//     setPlaces(sortedUnique(tourData.map((t) => t.place)));
//     setForwhoms(sortedUnique(tourData.map((t) => t.forwhom)));
//     setLanguages(sortedUnique(tourData.map((t) => t.language)));
//     setTimes(sortedUnique(tourData.map((t) => t.time))); // 🕓 добавлено
//   }, []);

//   // 2️⃣ Логика фильтрации
//   useEffect(() => {
//     tours.forEach((t) => {
//       const matchCategory =
//         filters.category === "all" || t.category === filters.category;
//       const matchSubcategory =
//         filters.subcategory === "all" || t.subcategory === filters.subcategory;
//       const matchPlace = filters.place === "all" || t.place === filters.place;
//       const matchForwhom =
//         filters.forwhom === "all" || t.forwhom === filters.forwhom;
//       const matchLanguage =
//         filters.language === "all" || t.language === filters.language;
//       const matchTime = filters.time === "all" || t.time === filters.time; // 🕓 добавлено

//       // если категория = event, тогда фильтруем по времени тоже
//       const isVisible =
//         matchCategory &&
//         matchSubcategory &&
//         matchPlace &&
//         matchForwhom &&
//         matchLanguage &&
//         (filters.category === "event" ? matchTime : true);

//       t.element.style.display = isVisible ? "block" : "none";
//     });
//   }, [filters, tours]);

//   return (
//     <div
//       className="tour-filters"
//       style={{ display: "flex", gap: "1rem", flexWrap: "wrap" }}
//     >
//       {/* Category */}
//       <label>
//         Category:
//         <select
//           onChange={(e) => {
//             setFilters((prev) => ({ ...prev, category: e.target.value }));
//             console.log("🔍 Category changed to:", categories);
//           }}
//         >
//           {categories.map((cat) => (
//             <option key={cat} value={cat}>
//               {cat === "all" ? "All" : cat}
//             </option>
//           ))}
//         </select>
//       </label>
//       {/* Subcategory */}
//       <label>
//         Subcategory:
//         <select
//           onChange={(e) =>
//             setFilters((prev) => ({ ...prev, subcategory: e.target.value }))
//           }
//         >
//           {subcategories.map((sub) => (
//             <option key={sub} value={sub}>
//               {sub === "all" ? "All" : sub}
//             </option>
//           ))}
//         </select>
//       </label>
//       {/* Place */}
//       <label>
//         Place:
//         <select
//           onChange={(e) =>
//             setFilters((prev) => ({ ...prev, place: e.target.value }))
//           }
//         >
//           {places.map((place) => (
//             <option key={place} value={place}>
//               {place === "all" ? "All" : place}
//             </option>
//           ))}
//         </select>
//       </label>
//       {/* For whom */}
//       <label>
//         For whom:
//         <select
//           onChange={(e) =>
//             setFilters((prev) => ({ ...prev, forwhom: e.target.value }))
//           }
//         >
//           {forwhoms.map((fw) => (
//             <option key={fw} value={fw}>
//               {fw === "all" ? "All" : fw}
//             </option>
//           ))}
//         </select>
//       </label>
//       {/* Language */ console.log("Hell")}
//       <label>
//         Language:
//         <select
//           onChange={(e) =>
//             setFilters((prev) => ({ ...prev, language: e.target.value }))
//           }
//         >
//           {languages.map((lang) => (
//             <option key={lang} value={lang}>
//               {lang === "all" ? "All" : lang}
//             </option>
//           ))}
//         </select>
//       </label>
//       {
//         /* 🕓 Time — показываем только если категория = event */ console.log(
//           filters.category
//         )
//       }
//       {filters.category === "event" && (
//         <label>
//           Time:
//           <select
//             onChange={(e) =>
//               setFilters((prev) => ({ ...prev, time: e.target.value }))
//             }
//           >
//             {times.map((t) => (
//               <option key={t} value={t}>
//                 {t === "all" ? "All" : t}
//               </option>
//             ))}
//           </select>
//         </label>
//       )}
//     </div>
//   );
// }
