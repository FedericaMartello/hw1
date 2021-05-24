const url=
[   'https://www.ilgiornaledelcibo.it/ricetta/pizza-margherita/',
    'https://www.ilgiornaledelcibo.it/ricetta/penne-alla-delizia-di-scampi-e-gamberi/',
    'https://www.ilgiornaledelcibo.it/ricetta/calamari-ripieni-in-padella/',
    'https://www.ilgiornaledelcibo.it/ricetta/risotto-con-gli-asparagi-selvatici/',
    'https://www.ilgiornaledelcibo.it/ricetta/spaghetti-alla-carbonara/',
    'https://www.ilgiornaledelcibo.it/ricetta/arrosto-di-vitello/'
];

function ChiudiRicetta(event)
{
    event.currentTarget.classList.add('hidden');
    event.currentTarget.innerHTML="";
    document.body.classList.remove("no-scroll");
}
document.querySelector("#show-recipe").addEventListener("click", ChiudiRicetta);


function ApriRicetta(event)
{   
    const input=event.currentTarget;

    const background = document.querySelector("#show-recipe");
    background.classList.remove("hidden");
    background.style.top=window.pageYOffset + "px";
    document.body.classList.add("no-scroll");

    const paper=document.createElement("div");
    paper.id="paper";
    background.appendChild(paper);

    const name=document.createElement("h3");
    name.textContent=input.firstChild.textContent;
    paper.appendChild(name);

    
    const preview=document.createElement('div');
    preview.classList.add('preview-recipe');
    paper.appendChild(preview);

    const photo=document.createElement('img');
    photo.classList.add('foto-ricetta');
    photo.src=input.firstChild.nextSibling.firstChild.src;
    preview.appendChild(photo);

    
    const list_of_ingredients=document.createElement('div');
    list_of_ingredients.classList.add('list');
    preview.appendChild(list_of_ingredients);

    const paragrafo=input.firstChild.nextSibling.firstChild.nextSibling;
    const span=paragrafo.querySelectorAll("span");

    for(let i=0; i<span.length; i++)
    {
        const ingred=document.createElement('span');
        ingred.classList.add('ingrediente');
        ingred.textContent=i+1+'. '+span[i].textContent;
        list_of_ingredients.appendChild(ingred);
    }
    
    const procedimento_box=document.createElement('div');
    procedimento_box.classList.add('procedimento');
    paper.appendChild(procedimento_box);
    const istruzioni=document.createElement("p");
    istruzioni.classList.add("istruzioni");
    istruzioni.textContent=input.firstChild.nextSibling.firstChild.nextSibling.nextSibling.textContent;
    procedimento_box.appendChild(istruzioni);
}

function onJson(json)
{
    const page=document.querySelector('#album-ricette');

    const main_box=document.createElement('div');
    const title=document.createElement('h3');
    title.classList.add('recipe-name');
    title.textContent=json[0].nome;
    page.appendChild(main_box);
    main_box.appendChild(title);
    main_box.addEventListener('click', ApriRicetta);
    
    const recipe_box=document.createElement('div');
    recipe_box.classList.add('hidden');
    main_box.appendChild(recipe_box);

    const photo=document.createElement('img');
    photo.src=json[0].foto;
    recipe_box.appendChild(photo);
    
    const paragraph=document.createElement("p");
    recipe_box.appendChild(paragraph);
    const ingredienti=json[0].ingredienti;
    for (let i=0; i<ingredienti.length; i++)
    {
        const ingrediente=document.createElement('span');
        ingrediente.textContent=ingredienti[i].original;
        paragraph.appendChild(ingrediente);
    }

 
    const instructions=document.createElement('span');
    instructions.textContent=json[0].istruzioni;
    recipe_box.appendChild(instructions);
}

function onResponse(response)
{
    return response.json();
}

function search()
{
    for(let i=0; i<url.length; i++)
    {
        fetch("fetch_ricette.php?url="+url[i]).then(onResponse).then(onJson);
    }
}

search();



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