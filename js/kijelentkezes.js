function confirmLogout() {
    Swal.fire({
        title: "Kijelentkezés!",
        text: "Biztosan ki akarsz jelentkezni?",
        icon: "question",
        showDenyButton: true,
        confirmButtonText: "Igen",
        denyButtonText: "Nem"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Sikeres kijelentkezés!",
                text: "Várunk vissza!",
                icon: "success",
                showConfirmButton: false,  
                timer: 2000 
            });
            console.log("Redirecting...");

            setTimeout(() => {
                window.location.href = "../api/kijelentkezes.php";
            }, 2000); 
        }
    });
}
