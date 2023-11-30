window.onload = function(){
    let cep=document.getElementById("cep")
    
    if(cep) {
        cep.addEventListener("blur",searchData)
    }

    const inputCPF = document.getElementById("cpf");
    const inputCEP = document.getElementById("cep");
    const inputTEL = document.getElementById("telephone");
    const inputPrice = document.getElementById("price");
    const inputPassword = document.getElementById("password");
    const inputStrings = document.querySelector('.validateString');
    const inputNumbers= document.querySelector('.validateNumbers');
    const buttonSubmit = document.getElementById("btn-account");
    const toggle = document.getElementById('theme-btn');
    const theme = window.localStorage.getItem('theme');

    if(inputCPF){
        inputCPF.addEventListener("keypress", mascaraCPF);
    }
    if(inputCEP){
        inputCEP.addEventListener("keypress", mascaraCEP);
    }
    if(inputTEL){
        inputTEL.addEventListener("keypress", mascaraTEL);
    }
    if(inputPrice){
        inputPrice.addEventListener("keypress", mascaraPRICE);
    }
    if(inputPassword){
        inputPassword.addEventListener("keypress", limitPassword);
    }

    if(buttonSubmit){
        buttonSubmit.addEventListener("click", verifyPassword);
    }

    if(inputStrings){
        inputStrings.addEventListener("keypress", inputStringValidation);
    }

    if(inputNumbers){
        inputNumbers.addEventListener("keypress", inputNumberValidation);
    }

    if(theme === "dark"){
        document.body.classList.add("dark");
    }

        
    if(toggle){
        toggle.addEventListener("click", () => {
            document.body.classList.toggle("dark");
            if(theme === "dark"){
                window.localStorage.setItem("theme", "light");
            }else{
                window.localStorage.setItem("theme", "dark");
            }
        });
    }

    formStep();
}
    
function searchData(){

        const value = this.value.replace('-','');
    
        const options = { method:'GET',
                           mode:'cors',
                            cache:'default'}
    
        fetch('https://viacep.com.br/ws/'+value+'/json',options)
    
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

function mascaraCPF(e){
    if(e.keyCode < 48 || e.keyCode > 57 || this.value.length > 13){
        e.preventDefault();
    }

    if(this.value.length == 3){
        this.value = this.value + ".";
    }
    if(this.value.length == 7){
        this.value = this.value + ".";
    }
    if(this.value.length == 11){
        this.value = this.value + "-";
    }
}

function mascaraCEP(e){
    if(e.keyCode < 48 || e.keyCode > 57 || this.value.length > 8){
        e.preventDefault();
    }

    if(this.value.length == 5){
        this.value = this.value + "-";
    }
}

function mascaraTEL(e){
    if(e.keyCode < 48 || e.keyCode > 57 || this.value.length > 14){
        e.preventDefault();
    }

    if(this.value.length == 0){
        this.value = this.value + "(";
    }
    if(this.value.length == 3){
        this.value = this.value + ") ";
    }
    if(this.value.length == 10){
        this.value = this.value + "-";
    }
}

function mascaraPRICE(e){
    if(this.value.length > 5){
        e.preventDefault();
    }

    let value = this.value.replace(',','')

    if(this.value.length == 2){
        this.value = value.replace(',','') + ",";
    }
    if(this.value.length == 3){
        this.value = value.replace(',','') + ",";
    }
}

function limitPassword(){
    if(this.value.length < 8){
        document.querySelector('.msg-error').innerHTML = "Senha mínima de 8 caracteres";
    }else{
        document.querySelector('.msg-error').innerHTML = "";
    }
}

function inputStringValidation(e){
    if(!((e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 97 && e.keyCode <= 122) ||(e.keyCode === 32))){
        e.preventDefault();
    }
}

function inputNumberValidation(e){
    if(e.keyCode < 48 || e.keyCode > 57){
        e.preventDefault();
    }
}

function validaCreateAccount(e){
    verifyPassword(e);
}

function verifyPassword(e){
    const inputPassword = document.getElementById("password");
    const inputNewPassword = document.getElementById("PasswordConfirmation");

    if(inputPassword.value != inputNewPassword.value){
        document.querySelector('.msg-error').innerHTML = "Senha digitadas não conferem!";
        e.preventDefault();
        return false;
    }

    if(inputPassword.value.length < 8){
        document.querySelector('.msg-error').innerHTML = "Senha mínima de 8 caracteres";
        e.preventDefault();
        return false;
    }
    return true;
}

function formStep() {
    const steps = document.querySelectorAll('.form-step');

    const arrowLeft = document.querySelector('.arrow-left');
    const arrowRight = document.querySelector('.arrow-right');
    
    let currentIndex = 0;

    const moveToLeft = () => {
        if(currentIndex === 0) return;

        steps[currentIndex].classList.add('hidden');
        steps[currentIndex - 1].classList.remove('hidden');
        currentIndex--;

        if(currentIndex === 0){
            arrowLeft.classList.add('hidden');
        }

        if(currentIndex !== steps.length - 1) {
            arrowRight.classList.remove('hidden');
        }
    }

    const moveToRight = () => {
        if(currentIndex >= steps.length) return;

        steps[currentIndex].classList.add('hidden');
        steps[currentIndex + 1].classList.remove('hidden');
        currentIndex++;

        if(currentIndex > 0){
            arrowLeft.classList.remove('hidden');
        }
        
        if(currentIndex === steps.length - 1) {
            arrowRight.classList.add('hidden');
        }
    }

    if(arrowLeft) arrowLeft.addEventListener('click', moveToLeft)
    if(arrowRight) arrowRight.addEventListener('click', moveToRight)
}