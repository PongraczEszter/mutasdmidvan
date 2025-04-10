let hozzavalok = [];
function hozzadHozzavalo() 
{
    const hozzavalo = document.getElementById("hozzavalo").value;
    const mennyiseg = document.getElementById("mennyiseg").value;
    const mertekegyseg = document.getElementById("mertekegyseg").value;
    const lista = document.getElementById("hozzavalo-lista");

    if (hozzavalo && mennyiseg && mertekegyseg) 
    {
        const li = document.createElement("li");
        li.textContent = `${mennyiseg} ${mertekegyseg} ${hozzavalo}`;
        lista.appendChild(li);
        hozzavalok.push({
            mennyiseg,
            mertekegyseg,
            hozzavalo
        })

        document.getElementById("hozzavalo").value = "";
        document.getElementById("mennyiseg").value = "";
        document.getElementById("mertekegyseg").value = "";
    }
}

function mentesRecept() {
    const elkeszites = document.getElementById("elkeszites-text").value;
    const hozzavaloLista = document.querySelectorAll("#hozzavalo-lista li");
    
    if (!elkeszites || hozzavaloLista.length === 0) {
        alert("Töltsd ki az összes mezőt!");
        return;
    }

    let allergenek = Array.from(document.querySelectorAll("input[type=checkbox]")).reduce((array, item) => {
        if(item.checked)
        {
            array.push(item.value);
        }
        return array;
    }, []);

    let formData = {
        nev: document.getElementById('nev').value,
        elkeszites,
        hozzavalok,
        allergenek
    }

    console.log(formData);
    fetch("../api/receptek_feltoltese.php/feltoltes", {
        method: "POST",
        body: JSON.stringify(formData)
    })
    .then(response => response.text())
    .then(data => {
        alert(data); 
        document.getElementById("elkeszites-text").value = "";
        document.getElementById("hozzavalo-lista").innerHTML = "";
        hozzavalok = [];
        setTimeout(() => {
            window.location.href = "../client/fooldal.php";
        }, 1000);
    })
    .catch(error => console.error("Hiba történt:", error));
}
