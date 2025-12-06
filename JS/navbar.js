document.addEventListener("DOMContentLoaded", () => {
    const profile = document.querySelector(".profile");
    const dropdown = document.querySelector(".dropdown");
    const navbar = document.querySelector(".navbar");

    profile.addEventListener("click", () => {
        dropdown.style.display =
            dropdown.style.display === "flex" ? "none" : "flex";
    });

    document.addEventListener("click", (e) => {
        if (!profile.closest(".profile-wrapper").contains(e.target)) {
            dropdown.style.display = "none";
        }
    });

    window.addEventListener("scroll", () => {
        if (window.scrollY > 10) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
    
});