let hozzavalok = [];

function hozzadHozzavalo() {
    const hozzavalo = document.getElementById("hozzavalo").value;
    const mennyiseg = document.getElementById("mennyiseg").value;
    const mertekegyseg = document.getElementById("mertekegyseg").value;
    const lista = document.getElementById("hozzavalo-lista");

    if (hozzavalo && mennyiseg && mertekegyseg) {
        const li = document.createElement("li");
        li.textContent = `${mennyiseg} ${mertekegyseg} ${hozzavalo}`;
        lista.appendChild(li);
        hozzavalok.push({ mennyiseg, mertekegyseg, hozzavalo });

        document.getElementById("hozzavalo").value = "";
        document.getElementById("mennyiseg").value = "";
        document.getElementById("mertekegyseg").value = "";
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Hiányzó mezők!',
            text: 'Kérlek, töltsd ki az összes hozzávaló mezőt!',
            confirmButtonColor: '#FF5733'
        });
    }
}

function mentesRecept() {
    const elkeszites = document.getElementById("elkeszites-text").value;
    const hozzavaloLista = document.querySelectorAll("#hozzavalo-lista li");

    if (!elkeszites || hozzavaloLista.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Hiányos adat!',
            text: 'Töltsd ki az elkészítést és adj meg legalább egy hozzávalót!',
            confirmButtonColor: '#FF5733'
        });
        return;
    }

    let allergenek = Array.from(document.querySelectorAll("input[type=checkbox]")).reduce((array, item) => {
        if (item.checked) array.push(item.value);
        return array;
    }, []);

    let formData = {
        nev: document.getElementById('nev').value,
        elkeszites,
        hozzavalok,
        allergenek
    };

    fetch("../api/receptek_feltoltese.php/feltoltes", {
        method: "POST",
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.valasz) {
            Swal.fire({
                icon: 'success',
                title: 'Siker!',
                text: data.valasz,
                confirmButtonColor: '#FF5733'
            }).then(() => {
                document.getElementById("elkeszites-text").value = "";
                document.getElementById("hozzavalo-lista").innerHTML = "";
                hozzavalok = [];
                window.location.href = "../client/fooldal.php";
            });
        } else if (data.hibak) {
            Swal.fire({
                icon: 'error',
                title: 'Hiba!',
                text: data.hibak.join(", "),
                confirmButtonColor: '#FF5733'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Hoppá!',
                text: 'Ismeretlen hiba történt.',
                confirmButtonColor: '#FF5733'
            });
        }
    })
    .catch(error => {
        console.error("Hiba történt:", error);
        Swal.fire({
            icon: 'error',
            title: 'Hálózati hiba',
            text: 'Nem sikerült kapcsolódni a szerverhez!',
            confirmButtonColor: '#FF5733'
        });
    });
}