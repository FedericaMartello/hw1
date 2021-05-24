function onJson(json)
{
    console.log(json);
    const table = document.querySelector("tbody");
    for(let i=0; i<json.length; i++)
    {
        const row = document.createElement("tr");
        const c1 = document.createElement("td");
        const c2 = document.createElement("td");
        const c3 = document.createElement("td");
        const c4 = document.createElement("td");
        const c5 = document.createElement("td");

        c1.textContent = json[i].date;
        c2.textContent = json[i].time;
        c3.textContent = json[i].tot;
        c4.textContent = json[i].type;
        if(json[i].delivered===null)
        {
            c5.textContent="";
        }
        else
        {
            c5.textContent=json[i].delivered;
        }

        if(json[i].type==="Consegnato")
        {
            row.classList.add("delivered");
            console.log("Consegnato");
        }
        else
        {
            row.classList.add("not-delivered");
            console.log("Non consegnato");
        }

        table.appendChild(row);
        row.appendChild(c1);
        row.appendChild(c2);
        row.appendChild(c3);
        row.appendChild(c4);
        row.appendChild(c5);
         
    }
}

function onResponse(response)
{
    return response.json();
}


function FromDatabase(event)
{
    event.preventDefault();
    const tabella = document.querySelector("tbody");
    tabella.innerHTML="";
    const type = form.type.value;
    console.log("fetch_orders.php?type="+type);
    fetch("fetch_orders.php?type="+type).then(onResponse).then(onJson);
}

const form = document.querySelector("form");
form.addEventListener("submit", FromDatabase);


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