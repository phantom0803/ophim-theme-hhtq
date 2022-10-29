$(document).ready(function () {
    var psNavbar,
        navbar = getElement("nav"),
        navbarToggle = getElement("#navbar-toggle");
    (navbarLeft = getElement("#navbar-left")),
        (floatingAction = getElement(".floating-action"));

    var onKeyTimeout,
        navbarHasSub = getAllElements(".navbar-menu-has-sub");
    for (i = 0; i < navbarHasSub.length; i++) showSubMenu(navbarHasSub[i]);

    function showSubMenu(e) {
        e.onclick = function () {
            this.classList.toggle("activated");
        };
    }

    function getElement(e) {
        return document.querySelector(e);
    }

    function getAllElements(e) {
        return document.querySelectorAll(e);
    }

    function activeNavbarLeft() {
        navbarLeft.classList.add("activated"), (navbar.style.zIndex = "8888");
    }

    $("#navbar-toggle").on("click", function () {
        activeNavbarLeft();
    });

    navbarLeft.querySelector(".navbar-close").onclick = function () {
        navbarLeft.classList.remove("activated"), (navbar.style.zIndex = "");
    };

    function closeNavbar(e) {
        var t = 0,
            n = e.target;
        "ok" != n.className &&
            (navbarLeft.contains(n) ||
                navbarToggle.contains(n) ||
                (navbarLeft.classList.remove("activated"), t++),
            t > 1 && (navbar.style.zIndex = ""));
    }

    window.addEventListener("click", function (e) {
        closeNavbar(e);
    });
});
