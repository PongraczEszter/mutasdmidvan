document.addEventListener("DOMContentLoaded", () =>
    {
        let form = document.querySelector("form");
        let inputs = form.querySelectorAll("input");
        let jelszoInput = document.getElementById("password");
        let jelszoLathatosag = document.getElementById("jelszo-lathatosag");
    
        jelszoLathatosag.addEventListener("click", () => 
        {
            if (jelszoInput.type === "password")
            {
                jelszoInput.type = "text";
                jelszoLathatosag.textContent = "🙄";
            } 
            else
            {
                jelszoInput.type = "password";
                jelszoLathatosag.textContent = "👁️";
            }
        });
    
        form.addEventListener("submit", (event) => 
        {
            event.preventDefault(); 
    
            let mindenKitoltve = true;
    
            inputs.forEach((input) => 
            {
                if (!input.value.trim()) 
                {
                    mindenKitoltve = false;
                    input.classList.add("error"); 
                }
                else
                {
                    input.classList.remove("error");
                }
            });
    
            if (!mindenKitoltve) {
                alert("Kérjük, töltsd ki az összes mezőt!");
                return;
            }
    
            let jelszo = jelszoInput.value;
            let jelszoMinta = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*?_-]).{8,}$/;
    
            if (!jelszoMinta.test(jelszo))
                {
                alert("A jelszónak legalább 8 karakter hosszúnak kell lennie, tartalmaznia kell egy kisbetűt, egy nagybetűt, egy számot és egy speciális karaktert (!@#$%^&*?_-).");
                jelszoInput.classList.add("error");
                return;
            }
            else
            {
                jelszoInput.classList.remove("error");
            }
    
            alert("Sikeres regisztráció!");
        });
    });