document.addEventListener("DOMContentLoaded", () => {
    let form = document.querySelector("form");
    let emailInput = document.getElementById("email");
    let jelszoInput = document.getElementById("jelszo");
    let loginBtn = document.getElementById("bejelentkezes"); // Helyes ID

    form.addEventListener("submit", (event) => {
        event.preventDefault(); // Ne küldje el az űrlapot

        let email = emailInput.value.trim();
        let password = jelszoInput.value.trim();

        if (!email || !password) {
            Swal.fire({
                title: "Hiba!",
                text: "Kérjük, töltsd ki az összes mezőt!",
                icon: "error",
                confirmButtonText: "OK"
            });
            emailInput.classList.add("error");
            jelszoInput.classList.add("error");
            return;
        }

        if (email !== "admin@admin.hu" || password !== "admin") {
            Swal.fire({
                title: "Hiba!",
                text: "Hibás e-mail vagy jelszó!",
                icon: "error",
                confirmButtonText: "OK"
            });
            emailInput.classList.add("error");
            jelszoInput.classList.add("error");
            return;
        }

        Swal.fire({
            title: "Siker!",
            text: "Sikeres bejelentkezés!",
            icon: "success",
            confirmButtonText: "OK"
        }).then(() => {
            window.location.href = "fooldal.php"; 
        });

        emailInput.classList.remove("error");
        jelszoInput.classList.remove("error");
    });
});
