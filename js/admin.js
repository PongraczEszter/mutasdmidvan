document.addEventListener("DOMContentLoaded", () => {
    const editModal = document.getElementById('edit-modal');
    const deleteModal = document.getElementById('delete-modal');
    const closeBtns = document.querySelectorAll('.close-btn');
    const confirmDeleteBtn = document.getElementById('confirm-delete');
    const cancelDeleteBtn = document.getElementById('cancel-delete');
    const tableBody = document.getElementById('user-table-body');

    let currentUserId = null;

    const users = [
        { id: 1, email: 'user1@example.com', password: 'password1', first_name: 'János', last_name: 'Kovács', birthdate: '1990-01-01', phone: '123456789', admin: 1 },
        { id: 2, email: 'user2@example.com', password: 'password2', first_name: 'Anna', last_name: 'Szabó', birthdate: '1992-02-02', phone: '987654321', admin: 0 }
    ];

    confirmDeleteBtn.addEventListener('click', async () => {
        const response = await fetch(`../api/profil.php/torles?id=${currentUserId}`, {
            method: 'DELETE',
        });
        if (response.ok) {
            alert("Felhasználó törölve.");
            loadUsers();
        }
        deleteModal.style.display = "none";
    });

    cancelDeleteBtn.addEventListener('click', () => {
        deleteModal.style.display = "none";
    });

    // Módosítás form kezelése
    document.getElementById('edit-form').addEventListener('submit', async (e) => {
        e.preventDefault();

        const email = document.getElementById('edit-email').value;
        const password = document.getElementById('edit-password').value;
        const firstName = document.getElementById('edit-first-name').value;
        const lastName = document.getElementById('edit-last-name').value;
        const birthdate = document.getElementById('edit-birthdate').value;
        const phone = document.getElementById('edit-phone').value;
        const admin = document.getElementById('edit-admin').checked;

        const response = await fetch(`../api/profil.php/modositas`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: currentUserId,
                email,
                password,
                firstName,
                lastName,
                birthdate,
                phone,
                admin: admin ? 1 : 0
            })
        });

        if (response.ok) {
            alert("Felhasználó módosítva.");
            loadUsers();
        }

        editModal.style.display = "none";
    });

    const loadUsers = async () => {
        let response = await fetch("../api/profil.php/osszes");
        let data = await response.json();

        tableBody.innerHTML = '';

        data.forEach(user => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${user.id}</td>
                <td>${user.email}</td>
                <td>${user.jelszo}</td>
                <td>${user.vezeteknev}</td>
                <td>${user.keresztnev}</td>
                <td>${user.szuletesiido}</td>
                <td>${user.telefonszam}</td>
                <td>${user.admin == 1 ? "Igen" : "Nem"}</td>
                <td><button class="edit-btn" data-id="${user.id}">Módosítás</button></td>
                <td><button class="delete-btn" data-id="${user.id}">Törlés</button></td>
            `;
            tableBody.appendChild(row);
        });

        const editBtns = document.querySelectorAll('.edit-btn');
        editBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                currentUserId = e.target.dataset.id;
                const userRow = e.target.closest('tr');
                document.getElementById('edit-email').value = userRow.cells[1].innerText;
                document.getElementById('edit-password').value = userRow.cells[2].innerText;
                document.getElementById('edit-first-name').value = userRow.cells[3].innerText;
                document.getElementById('edit-last-name').value = userRow.cells[4].innerText;
                var date = new Date(Date.parse(userRow.cells[5].innerText));
                var day = ("0" + date.getDate()).slice(-2);
                var month = ("0" + (date.getMonth() + 1)).slice(-2);
                var dateString = date.getFullYear()+"-"+(month)+"-"+(day);
                document.getElementById('edit-birthdate').value = dateString;
                document.getElementById('edit-phone').value = userRow.cells[6].innerText;
                document.getElementById('edit-admin').checked = userRow.cells[7].innerText == "Igen";
                editModal.style.display = "block";
            });
        });

        const deleteBtns = document.querySelectorAll('.delete-btn');
        deleteBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                currentUserId = e.target.dataset.id;
                deleteModal.style.display = "block";
            });
        });
    };

    loadUsers();

    closeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            editModal.style.display = "none";
            deleteModal.style.display = "none";
        });
    });

    window.addEventListener('click', (event) => {
        if (event.target === editModal || event.target === deleteModal) {
            editModal.style.display = "none";
            deleteModal.style.display = "none";
        }
    });
});
