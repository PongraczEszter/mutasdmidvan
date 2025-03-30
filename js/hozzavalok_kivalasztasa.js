async function openModal(id, leiras) {
    let modal = document.getElementById('modal');
    let hozzavalokUl = modal.getElementsByTagName("ul")[0]; 
    let elkeszitesParagraph = modal.getElementsByTagName("p")[0];

    elkeszitesParagraph.innerText = leiras;
    let hozzavalok = await getHozzavalok(id);
    hozzavalokUl.innerHTML = "";
    hozzavalok.forEach(element => {
        let li = document.createElement("li");
        li.innerText = `${element.mennyiseg} ${element.mertekegyseg} ${element.hozzavalonev}`;
        hozzavalokUl.appendChild(li);
    });

    modal.style.display = 'flex';
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
}

async function getRecipes()
{ 
    let link = "../api/hozzavalok_kivalasztasa.php/hozzavalok_kivalasztasa";
    let input = document.getElementById("ingredient-input");

    let allergenek = Array.from(document.querySelectorAll("input[type=checkbox]")).reduce((array, item) => {
        if(item.checked)
        {
            array.push(item.value);
        }
        return array;
    }, []).join("+");
    
    if (allergenek != "")
    {
        link += "?allergenek=" + allergenek;
    }
    
    let response = await fetch(link, {
        method: "POST",
        body: JSON.stringify({
            hozzavalok: input.value
        })
    });
    let data = await response.json();

    let output = document.getElementById("keresesEredmenye");
    output.innerHTML = "";
    data.forEach(element => {
        let div = document.createElement("div");
        div.setAttribute("class", "card");
        
        let img = document.createElement("img");
        img.setAttribute("src", `../kepek/etelek/${element.kep}`);    
        img.setAttribute("alt", "Kép");
        img.setAttribute("class", "card-img");

        let h3 = document.createElement("h3");
        h3.setAttribute("class", "card-title");
        h3.innerText = element.etelnev;

        let btn = document.createElement("button");
        btn.setAttribute("class", "card-btn");
        btn.addEventListener("click", () => {
            openModal(element.id, element.elkeszitese);
        });
        btn.innerText = "Hozzávalók, elkészítés";

        div.appendChild(img);
        div.appendChild(h3);
        div.appendChild(btn);
        output.appendChild(div);
    });
}

async function getHozzavalok(id)
{
    let link = "../api/sql_fuggvenyek_veletlen_recept.php/hozzavalokLekerdezese?id="+id;
    let response = await fetch(link);
    let data = await response.json();
    return data;
}