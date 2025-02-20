const mobileMenu = document.getElementById('mobile-menu');
const navbar = document.querySelector('.navbar');
const navLinks = document.getElementById('nav-links');

mobileMenu.addEventListener('click', () => {
    navbar.classList.toggle('open');
    const isVisible = navLinks.getAttribute('data-visible') === "true";
    navLinks.setAttribute('data-visible', !isVisible);
});