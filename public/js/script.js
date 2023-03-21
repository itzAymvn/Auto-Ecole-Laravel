// Define the variables
const spinner = document.querySelector("#spinner");
const stickyNav = document.querySelector(".sticky-top");
const backToTop = document.querySelector(".back-to-top");
const backToTopButton = document.querySelector(".back-to-top");

// Spinner
window.addEventListener("load", function () {
    spinner.classList.remove("show");
});

// Sticky Navbar
window.addEventListener("scroll", function () {
    if (window.pageYOffset > 300) {
        stickyNav.classList.add("shadow-sm");
        stickyNav.style.top = "0px";
    } else {
        stickyNav.classList.remove("shadow-sm");
        stickyNav.style.top = "-100px";
    }
});

// Back to top button
window.addEventListener("scroll", function () {
    if (window.pageYOffset > 300) {
        backToTop.style.display = "block";
    } else {
        backToTop.style.display = "none";
    }
});

backToTopButton.addEventListener("click", function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
});
