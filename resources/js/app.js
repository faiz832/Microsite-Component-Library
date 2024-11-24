import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

// Dark mode handling
let theme = localStorage.getItem("theme") || "system";
if (theme === "system") {
    if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
        document.documentElement.classList.add("dark");
    }
} else if (theme === "dark") {
    document.documentElement.classList.add("dark");
}

Alpine.start();
