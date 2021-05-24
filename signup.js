function CheckUsername(json)
{
  if(json.username==="in_uso")
  {
    const input = document.querySelector('#username');
    input.classList.add('error');
  }
  else
  {
    const input = document.querySelector('#username');
    input.classList.add('valid');
  }
}


function onResponse(response)
{
  return response.json();
}


function Username(event)
{
  const input = event.currentTarget;
  if(input.value.length>0){
  fetch("username.php?q="+encodeURIComponent(input.value)).then(onResponse).then(CheckUsername);
  }
  else
  {
    input.classList.add("error");
    alert("Username già in uso");
  }
}
const username_input = document.querySelector('#username');
username_input.addEventListener('blur', Username);


function Password(event)
{
  const input=event.currentTarget;
  const password = event.currentTarget.value;
  
  if(/[A-Z]/.test(password) && /[a-z]/.test(password) && /[0-9]/.test(password)
        && (/[?]/.test(password) || /[@]/.test(password) || /[_]/.test(password) || /[%]/.test(password)))
  {
    input.classList.add("valid");
  }
  else
  {
    input.classList.add("error");
    alert("La password deve contenere almeno un carattere minuscolo, almeno un carattere maiuscolo, almeno un numero ed almeno un carattere speciale (Ammessi: _ , % , @ , ? ).")
  }

}
const password_input = document.querySelector('#password');
password_input.addEventListener('blur', Password);


function ConfirmTest(event)
{
  const test_input = event.currentTarget;
  const password = document.querySelector('#password').value;
  if(test_input.value.length>0 && test_input.value===password)
  {
    test_input.classList.add("valid");
  }
  else
  {
    test_input.classList.add("error");
  }
}
const confirm_test_input = document.querySelector('#test');
confirm_test_input.addEventListener('blur', ConfirmTest);

function CheckLength(event)
{
  console.log("Funzione Partita");
  const input = event.currentTarget;
  if(input.value.length>0)
  {
    input.classList.add("valid");
  }
  else
  {
    input.classList.add("error");
  }
}
const nome = document.querySelector('#name');
const indirizzo = document.querySelector('#indirizzo');
const tel = document.querySelector('#tel');
nome.addEventListener('blur', CheckLength);
indirizzo.addEventListener('blur', CheckLength);
tel.addEventListener('blur', CheckLength);