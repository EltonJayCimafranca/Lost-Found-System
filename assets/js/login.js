window.addEventListener("load", () => {
    const login = document.getElementById("loginForm");

    if (login) {
        login.scrollIntoView({
            behavior: "smooth",
            block: "center"
        });
    }
});