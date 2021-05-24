function ChiudiModale(event)
{
    const m=event.currentTarget;
    m.classList.add('hidden');
    m.innerHTML='';
    document.body.classList.remove('no-scroll');
}

const modale=document.querySelector('#modale');
modale.addEventListener('click', ChiudiModale);

function ApriModale(event)
{
    modale.classList.remove('hidden');
    const selected_photo=document.createElement('img');
    modale.style.top = window.pageYOffset + 'px';
    selected_photo.id='selected';
    selected_photo.src=event.currentTarget.src;
    modale.appendChild(selected_photo);
    document.body.classList.add('no-scroll');
}

function onJson(json)
{
    console.log("onjson partita");
    console.log(json);

    const photo_gallery = document.querySelector('#album-foto');
    photo_gallery.innerHTML='';

    for (let i=0; i<json.length; i++)
    {
        const photo=document.createElement('img');
        photo.src=json[i].image;
        photo.addEventListener('click', ApriModale);

        photo_gallery.appendChild(photo);
    }
}


function onResponse(response)
{
    console.log("OnResponse partita");
    return response.json();
}



function search(event)
{
    event.preventDefault();    
    const form = document.querySelector("form");
    const food = form.food.value;
    console.log("fetch_unsplash.php?type="+food);
    fetch("fetch_unsplash.php?type="+food).then(onResponse).then(onJson);

}

const form=document.querySelector("form");
form.addEventListener("submit", search);





function NoMenu(event)
{
    const m=event.currentTarget;
    m.classList.add("hidden");
    m.innerHTML="";
    
    const form=document.querySelector("form");
    form.classList.remove("back");
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

    const form=document.querySelector("form");
    form.classList.add("back");
}

const menu_mobile = document.querySelector("#menu-mobile");
menu_mobile.addEventListener("click", Menu);