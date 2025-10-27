import React from "react";
import { createRoot } from "react-dom/client";
import App from "./App";

createRoot(document.getElementById("tour-filter-root")).render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);
// import React from "react";
// import { createRoot } from "react-dom/client";
// import FilterPanel from ".App/.jsx";
// //import "./filter/styles.css";

// function mountAll() {
//   const nodes = document.querySelectorAll("[data-event-filter]");
//   nodes.forEach((el) => {
//     const mode =
//       el.getAttribute("data-mode") === "community" ? "community" : "events";
//     const title = mode === "events" ? "Events" : "Community";
//     createRoot(el).render(
//       <React.StrictMode>
//         <FilterPanel
//           selector={mode === "events" ? ".event" : ".community"}
//           mode={mode}
//           title={title}
//         />
//       </React.StrictMode>
//     );
//   });
// }

// if (document.readyState === "loading") {
//   document.addEventListener("DOMContentLoaded", mountAll);
// } else {
//   mountAll();
// }
