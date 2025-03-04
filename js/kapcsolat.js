const form = document.getElementById('form');

form.addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(form);
    const object = Object.fromEntries(formData);
    const json = JSON.stringify(object);

    Swal.fire({
        title: "Kérlek, várj...",
        text: "Az üzeneted küldése folyamatban van.",
        icon: "info",
        showConfirmButton: false,
        allowOutsideClick: false
    });

    fetch('https://api.web3forms.com/submit', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: json
    })
    .then(async (response) => {
        let json = await response.json();
        if (response.status == 200) {
            Swal.fire({
                title: "Siker!",
                text: "Az üzeneted sikeresen elküldve! Néhány másodperc múlva visszairányítunk a főoldalra.",
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => {
                window.location.href = "fooldal.php"; 
            });
        } else {
            Swal.fire({
                title: "Hiba!",
                text: json.message || "Ismeretlen hiba történt!",
                icon: "error",
                confirmButtonText: "OK"
            });
        }
    })
    .catch(error => {
        console.log(error);
        Swal.fire({
            title: "Hiba!",
            text: "Valami hiba történt, próbáld újra később!",
            icon: "error",
            confirmButtonText: "OK"
        });
    });
});
