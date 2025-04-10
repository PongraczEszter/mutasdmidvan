window.addEventListener("load", async () => {
    const email = document.getElementById('email');
    const password = document.getElementById('jelszo');
    const firstName = document.getElementById('vezeteknev');
    const lastName = document.getElementById('keresztnev');
    const birthdate = document.getElementById('szuletesidatum');
    const phone = document.getElementById('telefonszam');

    let response = await fetch("../api/profil.php/sajat");
    let data = (await response.json())[0];

    var date = new Date(Date.parse(data.szuletesiido));
    var day = ("0" + date.getDate()).slice(-2);
    var month = ("0" + (date.getMonth() + 1)).slice(-2);
    var dateString = date.getFullYear()+"-"+(month)+"-"+(day);

    email.value = data.email;
    password.value = data.jelszo;    
    firstName.value = data.vezeteknev;    
    lastName.value = data.keresztnev;    
    birthdate.value = dateString;    
    phone.value = data.telefonszam;   
});

document.getElementById("modositas_gomb").addEventListener("click", async () => {
    const email = document.getElementById('email').value;
    const password = document.getElementById('jelszo').value;
    const firstName = document.getElementById('vezeteknev').value;
    const lastName = document.getElementById('keresztnev').value;
    const birthdate = document.getElementById('szuletesidatum').value;
    const phone = document.getElementById('telefonszam').value;

    const response = await fetch(`../api/profil.php/sajat_modositas`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            email,
            password,
            firstName,
            lastName,
            birthdate,
            phone
        })
    });

    if (response.ok) {
        alert("Felhasználó módosítva.");
        setTimeout(() => {
            window.location.href = "../client/profil.php";
        }, 1000);
    }
})