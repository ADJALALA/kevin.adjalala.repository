const menuBtn = document.getElementById("menuBtn");
const mobileMenu = document.getElementById("mobileMenu");

const reveals = document.querySelectorAll(".reveal");

menuBtn.addEventListener("click", () => {
  mobileMenu.classList.toggle("hidden");
});
function revealOnScroll() {
  reveals.forEach(el => {
    const windowHeight = window.innerHeight;
    const elementTop = el.getBoundingClientRect().top;

    if (elementTop < windowHeight - 100) {
      el.classList.add("opacity-100", "translate-y-0");
    }
  });
}

window.addEventListener("scroll", revealOnScroll);
