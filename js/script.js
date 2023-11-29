window.onload = function(){
    let cep=document.getElementById("cep")
    
    cep.addEventListener("blur",searchData)
    }
    
function searchData()
    {
    
        const options = { method:'GET',
                           mode:'cors',
                            cache:'default'}
    
        fetch('https://viacep.com.br/ws/'+this.value+'/json',options)
    
        .then(function(response){
            if(response.ok)
                return response.json()
            else
                console.log("erro");
    
        })
        .then(function(data){
    
            document.getElementById("street").value=data.logradouro
            document.getElementById("city").value=data.localidade
            document.getElementById("state").value=data.uf
            document.getElementById("country").value="Brasil"
    
         })
        .catch(function(e) {
            console.log("Erro: "+e)
        })
    
    }

function filterByBadge(){
    const forms = document.getElementById('search-filter');
    const time = forms.time.value;
    const date = forms.date.value;
    const filter = forms.filter.value;

    const url = `data.php?time=${time}&date=${date}&filter=${filter}`;

    
    fetch(url)
    
        .then(function(response){
            if(response.ok)
                return response.json()
            else
                console.log("erro");
    
        })
        .then(function(data){
    
           console.log(data);
    
         })
        .catch(function(e) {
            console.log("Erro: "+e)
        })
    

}


function valida_form() {
    const form = document.forms[0];
    const campos = form.elements;
    let valido = true;

    Array.from(campos).forEach((element) => {
        const tipo = element.getAttribute('type');
        const tag = element.tagName;
        const valor = element.value;

        if(tag === 'INPUT' && tipo !== 'file' && valor === '') {
            element.classList.add('error');
            valido = false;
        }else{
            element.classList.remove('error');
        }
        
    });

    return valido;
}

const toggle = document.getElementById('theme-btn');
const theme = window.localStorage.getItem('theme');

if(theme === "dark") document.body.classList.add("dark");

toggle.addEventListener("click", () => {
    document.body.classList.toggle("dark");
    if(theme === "dark"){
        window.localStorage.setItem("theme", "light");
    }else{
        window.localStorage.setItem("theme", "dark");
    }
});


// const inputCPF = document.getElementById("cpf");

// const inputTEL = document.getElementById("telefone");

// inputCPF.addEventListener("keypress", mascaraCPF);
// inputTEL.addEventListener("keypress", mascaraTEL);

// function mascaraCPF(e){
//     if(e.keyCode < 48 || e.keyCode > 57){
//         e.preventDefault();
//     }

//     if(this.value.length == 3){
//         this.value = this.value + ".";
//     }
//     if(this.value.length == 7){
//         this.value = this.value + ".";
//     }
//     if(this.value.length == 11){
//         this.value = this.value + "-";
//     }
// }

// function mascaraTEL(e){
//     if(e.keyCode < 48 || e.keyCode > 57){
//         e.preventDefault();
//     }

//     if(this.value.length == 0){
//         this.value = this.value + "(";
//     }
//     if(this.value.length == 3){
//         this.value = this.value + ") ";
//     }
//     if(this.value.length == 10){
//         this.value = this.value + "-";
//     }
// }