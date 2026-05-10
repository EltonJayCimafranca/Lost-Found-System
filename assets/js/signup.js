window.addEventListener("load", () => {
    const signup = document.getElementById("signupForm");

    if (signup) {
        signup.scrollIntoView({
            behavior: "smooth",
            block: "center"
        });
    }
});