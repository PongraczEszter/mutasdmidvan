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

        document.getElementById("hozzavalo").value = "";
        document.getElementById("mennyiseg").value = "";
        document.getElementById("mertekegyseg").value = "";
    }
}

function mentesRecept() 
{
    const elkeszites = document.getElementById("elkeszites-text").value;
    const hozzavaloLista = document.querySelectorAll("#hozzavalo-lista li");
    
    if (!elkeszites || hozzavaloLista.length === 0)
    {
        alert("Töltsd ki az összes mezőt!");
        return;
    }

    let hozzavalok = [];
    hozzavaloLista.forEach(li => {
        hozzavalok.push(li.textContent);
    });

    let formData = new FormData();
    formData.append("elkeszites", elkeszites);
    formData.append("hozzavalok", JSON.stringify(hozzavalok));

    fetch("mentes_recept.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); 
        document.getElementById("elkeszites-text").value = "";
        document.getElementById("hozzavalo-lista").innerHTML = "";
    })
    .catch(error => console.error("Hiba történt:", error));
}
