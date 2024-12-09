document.addEventListener("DOMContentLoaded", () => 
    {
        let form = document.querySelector("form");
        let emailInput = document.getElementById("email");
        let jelszoInput = document.getElementById("jelszo");
    
        form.addEventListener("submit", (event) => {
            event.preventDefault();
    
            let email = emailInput.value.trim();
            let password = jelszoInput.value.trim();
    
            if (!email || !password) {
                alert("Kérjük, töltsd ki az összes mezőt!");
                emailInput.classList.add("error");
                jelszoInput.classList.add("error");
                return;
            }
            
            if (email !== "admin@admin.hu" || password !== "admin") {
                alert("Hibás e-mail cím vagy jelszó!");
                emailInput.classList.add("error");
                jelszoInput.classList.add("error");
                return;
            }
    
            alert("Sikeres bejelentkezés!");
            emailInput.classList.remove("error");
            jelszoInput.classList.remove("error");
        });
    });