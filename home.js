function FromDatabase()
{
fetch("fetch_products.php").then(onResponse).then(ShowProducts);
}

FromDatabase();

function onResponse(response)
{
    return response.json();
}

function ShowProducts(json)
{
    const mb = document.querySelector('#main_block');
    for(let i=0; i<json.length; i++)
    {
        const box = document.createElement('div');
        const foto = document.createElement("img");
        const nome = document.createElement("span");
        const prezzo = document.createElement("span");
        const description = document.createElement("span");
        const more = document.createElement("span");
        const cart = document.createElement("img");

        box.dataset.idprodottoadd=json[i].id;
        foto.src = json[i].image;
        nome.textContent = json[i].name;
        prezzo.textContent = json[i].prezzo;
        description.textContent = json[i].descr;
        more.textContent = 'Dettagli';
        cart.src = 'foto_progetto/add-to-cart.png';

        box.classList.add("contenitore_prodotto");
        foto.classList.add("foto_prodotto");
        nome.classList.add("nome_prodotto");
        prezzo.classList.add("prices");
        description.classList.add('hidden');
        more.classList.add('showmore');
        cart.classList.add("add-to-cart");


        mb.appendChild(box);
        box.appendChild(foto);
        box.appendChild(nome);
        box.appendChild(prezzo);
        box.appendChild(description);
        box.appendChild(more);
        box.appendChild(cart);

        more.addEventListener('click', ShowDescription);
        cart.addEventListener('click',AddToCart);
    }
}

//Funzione Mostra dettagli
function ShowDescription(event)
{
    event.currentTarget.textContent="Mostra Meno";    
    let paragrafo=event.currentTarget.parentNode.querySelector('span.hidden');
    paragrafo.classList.remove('hidden');
    paragrafo.classList.add('descrizione');
    
    event.currentTarget.removeEventListener("click", ShowDescription);
    event.currentTarget.addEventListener("click", ShowLess);
    
}

//Funzione Nascondi dettagli
    
function ShowLess(event)
{
    event.currentTarget.textContent='Dettagli';
    let box=event.currentTarget.parentNode;
    let paragrafo=box.firstChild.nextSibling.nextSibling.nextSibling;
    console.log(paragrafo);
    paragrafo.classList.add('hidden');
    paragrafo.classList.remove('descrizione');
    
    event.currentTarget.removeEventListener("click", ShowLess);
    event.currentTarget.addEventListener("click", ShowDescription);
}


// Funzione aggiungi al carrello 
const nel_carrello = [];
function AddToCart(event)
{
    const clicked_cart = event.currentTarget;
    const product_in_cart = clicked_cart.parentNode;
    const id = product_in_cart.dataset.idprodottoadd;
    const products = document.querySelectorAll(".contenitore_prodotto");

    nel_carrello.push(id);
    
    for(let bought of products)
    {    
        if(bought.dataset.idprodottoadd === id)
        {
            const blocco_carrello = document.querySelector('#in-the-cart');
                           
            const cart_div = document.createElement('div');
            cart_div.dataset.idprodottoadd=id;
            const foto=document.createElement('img');
            const nome_prodotto=document.createElement('span');
            const rimuovi=document.createElement('img');
            const price = document.createElement('span');
            const label = document.createElement('label');
            label.textContent="Quantità: ";
            const quantity=document.createElement('input');
            quantity.type="number";
            quantity.value=1;
            quantity.min=1;
            quantity.max=10;

            blocco_carrello.appendChild(cart_div); 
            cart_div.appendChild(foto);
            cart_div.appendChild(nome_prodotto);
            cart_div.appendChild(price);
            cart_div.appendChild(label);  
            label.appendChild(quantity);
            cart_div.appendChild(rimuovi);
        
            cart_div.classList.add('contenitore_carrello');
            foto.classList.add('foto_prodotto');
            nome_prodotto.classList.add('nome_prodotto');
            rimuovi.classList.add('remove-from-cart');
            quantity.classList.add('quantity');
            price.classList.add("prices");

            foto.src=bought.querySelector('.foto_prodotto').src;
            nome_prodotto.textContent=bought.querySelector('.nome_prodotto').textContent;
            price.textContent=bought.querySelector(".prices").textContent;
            rimuovi.src='foto_progetto/rimuovi.png';

            rimuovi.addEventListener("click", Rimuovi);
        }
    } 

    clicked_cart.removeEventListener("click", AddToCart);
}

//Funzione rimuovi   
function Rimuovi(event)
{
    const selected_product = event.currentTarget.parentNode;
    const id = selected_product.dataset.idprodottoadd;
    selected_product.remove();
    event.currentTarget.removeEventListener("click", Rimuovi);

    for( let i = 0; i < nel_carrello.length; i++){ 
        if ( nel_carrello[i] === id) {
          nel_carrello.splice(i, 1); 
        }
    }

    const products = document.querySelectorAll(".contenitore_prodotto");
    for(let bought of products)
    {
        if(bought.dataset.idprodottoadd === id)
        {
            const cart = bought.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling;
            cart.addEventListener("click", AddToCart);
        }
    }

}


function CreateOrder(event)
{
    event.preventDefault();
    const form = document.querySelector("form");

    
    const data_input= form.d;
    let today = new Date();
    let dd = String(today.getDate()).padStart(2, '0');
    let mm = String(today.getMonth() + 1).padStart(2, '0');
    let yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    data_input.min=today;
    const data = form.d.value;
    if(data<today)
    {
        alert("Data non valida");
    }

    const ora_input=form.t;
    const min="11:00:00";
    const max="23:00:00";
    ora_input.min=min;
    ora_input.max=max;
    const ora = form.t.value;
    if(ora<min || ora>max)
    {
        alert("Selezionare un'ora tra le 11:00 e le 23:00");
    }



    if(nel_carrello.length>0)
    {
        console.log("create_order.php?d="+data+"&t="+ora);
        fetch("create_order.php?d="+data+"&t="+ora).then(onResponse).then(complete_order).then(ViewTot);
    }
    else if(nel_carrello.length=0)
    {
        alert("Selezionare almeno un prodotto");
    }
}

const button = document.querySelector("#buy");
button.addEventListener("click", CreateOrder);

function complete_order(json)
{
    const id_ordine = json[0].id_ordine;
    
    if(id_ordine!=="null")
    {
        const input = document.querySelectorAll(".contenitore_carrello input");

        for(let i=0; i<nel_carrello.length; i++)
        {
            for(let j=0; j<input.length; j++)
            {
                if(nel_carrello[i] === input[j].parentNode.parentNode.dataset.idprodottoadd)
                {
                    console.log("complete_order.php?o="+id_ordine+"&p="+nel_carrello[i]+"&q="+input[j].value);
                    fetch("complete_order.php?o="+id_ordine+"&p="+nel_carrello[i]+"&q="+input[j].value);
                }
            }
        }
        console.log(id_ordine);
        fetch("get_order_information.php?o="+id_ordine).then(onResponse).then(Tot);
    }
}

function Tot(json)
{
    console.log(json);
    const scontrino = document.querySelector("#ticket");

    const title = document.createElement("h1");
    title.textContent="Riepiologo Ordine";
    scontrino.appendChild(title);

    const data = document.createElement("span");
    data.textContent = "Data prevista: " + json[0].date;
    scontrino.appendChild(data);

    const ora = document.createElement("span");
    ora.textContent="Ora prevista: " + json[0].time;
    scontrino.appendChild(ora);

    const address = document.createElement("span");
    address.textContent="Indirizzo di consegna: " + json[0].address;
    scontrino.appendChild(address);

    
    const details = document.createElement("span");
    details.textContent = "Pagamento alla consegna ✔";
    scontrino.appendChild(details);

    for(let y=0; y<json.length; y++)
    {
        const prodotto = document.createElement("span");
        prodotto.textContent=json[y].prodotto + " " + json[y].n + " x "+json[y].price + "€";
        prodotto.classList.add("details-ticket");
        scontrino.appendChild(prodotto);

    }

    const tot = document.createElement("span");
    tot.id="tot";
    tot.textContent="Totale: "+json[0].tot+"€";
    scontrino.appendChild(tot);

    const ok = document.createElement("input");
    ok.id="close";
    ok.type="submit";
    ok.value = "Chiudi";
    scontrino.appendChild(ok);

    const link = document.createElement("a");
    link.textContent="I tuoi ordini";
    link.href="ordini.php";
    scontrino.appendChild(link);

    ok.addEventListener("submit",NoTicket);
}

function ViewTot()
{
    const ticket = document.querySelector("#ticket-background");
    ticket.classList.remove("hidden");
    const t = document.createElement("div");
    t.id="ticket";
    ticket.style.top = window.pageYOffset + "px";
    ticket.appendChild(t);
    document.body.classList.add("no-scroll");
}

function NoTicket(event)
{
    const t=event.currentTarget;
    t.classList.add("hidden");
    t.innerHTML='';
    document.body.classList.remove("no-scroll");

    const carrello = document.querySelector("#in-the-cart");
    carrello.innerHTML="";

    const form = document.querySelector("form");
    form.d.value="";
    form.t.value="";
}

const scontrino = document.querySelector("#ticket-background");
scontrino.addEventListener("click", NoTicket);


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