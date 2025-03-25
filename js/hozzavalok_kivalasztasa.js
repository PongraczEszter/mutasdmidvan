let currentPage = 1;

function fetchRecipes() {
    const ingredientInput = document.getElementById("ingredient-input").value.trim();
    const ingredientIDs = ingredientInput ? ingredientInput.split(',').map(id => id.trim()) : [];

    fetch(`get_recipes.php?page=${currentPage}&ingredients=${ingredientIDs.join(',')}`)
        .then(response => response.json())
        .then(data => {
            displayRecipes(data.recipes);
        })
        .catch(error => console.error("Hiba történt: ", error));
}

function displayRecipes(recipes) {
    const recipesDiv = document.getElementById("recipes");
    recipesDiv.innerHTML = ""; // Előző tartalom törlése

    if (recipes.length === 0) {
        recipesDiv.innerHTML = "<p>Nincs találat a megadott hozzávalókra! 😔</p>";
        return;
    }

    recipes.forEach(recipe => {
        const recipeCard = document.createElement("div");
        recipeCard.classList.add("recipe");

        recipeCard.innerHTML = `
            <img src="${recipe.kep_url}" alt="${recipe.nev}">
            <h3>${recipe.nev}</h3>
        `;

        recipesDiv.appendChild(recipeCard);
    });
}

function nextPage() {
    currentPage++;
    fetchRecipes();
}

function prevPage() {
    if (currentPage > 1) {
        currentPage--;
        fetchRecipes();
    }
}

document.querySelector("button").addEventListener("click", fetchRecipes);
document.querySelector(".pagination button:first-child").addEventListener("click", prevPage);
document.querySelector(".pagination button:last-child").addEventListener("click", nextPage);
