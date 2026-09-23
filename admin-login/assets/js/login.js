document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");

    if (!passwordInput || !togglePassword) {
        return;
    }

    togglePassword.addEventListener("click", function () {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            togglePassword.textContent = "🙈";
            togglePassword.setAttribute("aria-label", "Sembunyikan password");
        } else {
            passwordInput.type = "password";
            togglePassword.textContent = "👁";
            togglePassword.setAttribute("aria-label", "Tampilkan password");
        }
    });
});
