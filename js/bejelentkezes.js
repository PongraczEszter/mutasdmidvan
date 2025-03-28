document.addEventListener("DOMContentLoaded", () => {
    let form = document.querySelector("form");
    let emailInput = document.getElementById("email");
    let jelszoInput = document.getElementById("jelszo");
    let loginBtn = document.getElementById("bejelentkezes"); // Helyes ID
    let jelszoLathatosag = document.getElementById("jelszo-lathatosag");

    jelszoLathatosag.addEventListener("click", () => {
        if (jelszoInput.type === "password") {
            jelszoInput.type = "text";
            jelszoLathatosag.textContent = "🙄";
        } else {
            jelszoInput.type = "password";
            jelszoLathatosag.textContent = "👁️";
        }
    });

    form.addEventListener("submit", async (event) => {
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

        /*if (email !== "admin@admin.hu" || password !== "admin") {
            Swal.fire({
                title: "Hiba!",
                text: "Hibás e-mail vagy jelszó!",
                icon: "error",
                confirmButtonText: "OK"
            });
            emailInput.classList.add("error");
            jelszoInput.classList.add("error");
            return;
        }*/

            let response = await fetch("../api/bejelentkezes.php/bejelentkezes", {
                method: "POST",
                body: JSON.stringify({
                    "email": email,
                    "jelszo": password,
                }),
                credentials: "same-origin"
            });
            let data = await response.json();
            if(response.ok)
            {
                Swal.fire({
                    title: "Siker!",
                    text: data.valasz,
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    console.log("Redirecting...");
                    setTimeout(() => {
                        window.location.href = "../client/fooldal.php";
                    }, 1000);
                });
            }
    });
});
