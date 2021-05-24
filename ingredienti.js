function Ingredients()
{
    fetch("fetch_ingredients.php").then(onResponse).then(ShowIngredients);
}

Ingredients();

function onResponse(response)
{
    return response.json();
}

function ShowIngredients(json)
{
    const form = document.querySelector("form");

    for(let i=0; i<json.length; i++)
    {
        const label = document.createElement("label");
        const checkbox = document.createElement("input");
        const newline=document.createElement("br");
        checkbox.type="checkbox";
        checkbox.value=json[i].id;
        label.textContent=json[i].name;

        form.appendChild(checkbox);
        form.appendChild(label);
        form.appendChild(newline);

        checkbox.addEventListener("change", inArray);
    }

    const search = document.createElement("input");
    search.type="submit";
    search.value="Trova i prodotti";
    form.appendChild(search);
    form.addEventListener("submit", SearchFood);
}


let ingredienti=[];
let count=0;
function inArray(event)
{
    const checkbox = event.currentTarget;
    const value = checkbox.value;
    
    if(checkbox.checked)
    {
        if(count<3)
        {
            ingredienti.push(value);
            count++;
        }
        else
        {
            alert("Selezionare al max 3 ingredienti");
            checkbox.checked=false;
        }
    }
    else
    {
        for( let i = 0; i < ingredienti.length; i++)
        { 
            if ( ingredienti[i] === value)
            {
              ingredienti.splice(i, 1);
              count--;
            }
        }
    }
}

function SearchFood(event)
{
    event.preventDefault();
    console.log("Funzione SearchFood partita");
    console.log("Array: ");
    for(let j=0; j<ingredienti.length; j++)
    {
        console.log(ingredienti[j]);
    }

    if(count===3)
    {
        fetch("whats_inside.php?count="+count+"&i1="+ingredienti[0]+"&i2="+ingredienti[1]+"&i3="+ingredienti[2]).then(onResponse).then(ShowProducts);
    }
    else if (count==2)
    {        
        fetch("whats_inside.php?count="+count+"&i1="+ingredienti[0]+"&i2="+ingredienti[1]).then(onResponse).then(ShowProducts);
    }
    else
    {
        fetch("whats_inside.php?count="+count+"&i1="+ingredienti[0]).then(onResponse).then(ShowProducts);
    }
}



function ShowProducts(json)
{
    console.log(json);
    const box = document.querySelector("#contents");
    box.innerHTML='';
    
    if(json.length===0)
    {
        const p=document.createElement("p");
        p.textContent="Non ci sono prodotti corrispondenti alla tua ricerca.";
        p.id="no-results";

        const gif=document.createElement("img");
        gif.src="https://media.tenor.com/images/ddb0afaa85b9df59d5ccedc4a8a8f8d9/tenor.gif";
        gif.id="gif";

        box.appendChild(p);
        box.appendChild(gif);
    }
    else
    {
        for(let x=0; x<json.length; x++)
        {
            const container = document.createElement("div");
            const image = document.createElement("img");
            const name = document.createElement("span");
            const price = document.createElement("span");

            image.src=json[x].image;
            name.textContent=json[x].nome;
            price.textContent=json[x].prezzo;

            container.classList.add("container");
            image.classList.add("foto");

            container.appendChild(image);
            container.appendChild(name);
            container.appendChild(price);
            box.appendChild(container);
        }
    }
}




function NoMenu(event)
{
    const m=event.currentTarget;
    m.classList.add("hidden");
    m.innerHTML="";
}
document.querySelector("#mm").addEventListener("click", NoMenu);



function Menu()
{
    const sfondo=document.querySelector("#mm");
    sfondo.classList.remove("hidden");

    const m=document.createElement("div");
    m.id="mobile-links";
    m.style.top = window.pageYOffset + "px";
    sfondo.appendChild(m);

    const link1=document.createElement("a");
    const link2=document.createElement("a");
    const link3=document.createElement("a");
    const link4=document.createElement("a");
    const link5=document.createElement("a");
    const link6=document.createElement("a");

    link1.textContent="Home";
    link1.href="home.php";
    link2.textContent="Ricette";
    link2.href="ricette.php";
    link3.textContent="Foto";
    link3.href="foto.php";
    link4.textContent="Ordini";
    link4.href="ordini.php";
    link5.textContent="Scopri";
    link5.href="ingredienti.php";
    link6.textContent="Logout";
    link6.href="logout.php";

    link1.classList.add("links-m");
    link2.classList.add("links-m");
    link3.classList.add("links-m");
    link4.classList.add("links-m");
    link5.classList.add("links-m");
    link6.classList.add("links-m");

    m.appendChild(link1);
    m.appendChild(link2);
    m.appendChild(link3);
    m.appendChild(link4);
    m.appendChild(link5);
    m.appendChild(link6);
}

const menu_mobile = document.querySelector("#menu-mobile");
menu_mobile.addEventListener("click", Menu);


