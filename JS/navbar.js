document.addEventListener("DOMContentLoaded", () => {
    const profile = document.querySelector(".profile");
    const dropdown = document.querySelector(".dropdown");
    const navbar = document.querySelector(".navbar");

    let lastScrollY = window.scrollY;
    
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
        const currentScrollY = window.scrollY;

        if (currentScrollY > lastScrollY && currentScrollY > 64) {
            navbar.classList.add("scrolled");
        } 
        
        else if (currentScrollY < lastScrollY || currentScrollY < 64) {
            navbar.classList.remove("scrolled");
        }

        lastScrollY = currentScrollY;
    });
    
});