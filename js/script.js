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
    const redirectBtn =  document.getElementById('close-btn');
    const toggle = document.getElementById('theme-btn');
    const theme = window.localStorage.getItem('theme');

    const btnAddPet = document.getElementById('add-pet-btn');
    const btnCloseAddPet = document.getElementById('btn-close-add-pet');
    const btnInfoPet = document.getElementById('btn-inf-pet');
    const btnPetRotina= document.getElementById('btn-rotina');
    const btnPetFichaMedica = document.getElementById('btn-ficha-medica');
    const btnPetContatoPet = document.getElementById('btn-contato-pet');
    const btnFotoPet = document.getElementById('btn-foto-pet');
    const btnCloseInfoPet = document.getElementById('btn-close-info-pet');
    const btnCloseRotina = document.getElementById('btn-close-rotina');
    const btnCloseFichaMedica = document.getElementById('btn-close-ficha-medica');
    const btnCloseContatoPet = document.getElementById('btn-close-contato-pet');
    const btnCloseFotoPet = document.getElementById('btn-close-foto-pet');

    const btnFotoProfile = document.getElementById('btn-foto-profile');
    const btnInfoProfile = document.getElementById('btn-info-profile');
    const btnInfoAddress = document.getElementById('btn-info-address');
    const btnResetPassword = document.getElementById('btn-reset-password');
    const btnCloseInfoProfile = document.getElementById('btn-close-info-profile');
    const btnCloseAddress = document.getElementById('btn-close-address');
    const btnCloseFotoProfile = document.getElementById('btn-close-foto-profile');
    const btnCloseResetPassword = document.getElementById('btn-close-reset-password');
    const newPassword = document.getElementById('new-password');

    const btnAddBadges = document.getElementById('btn-add-badges');
    const btnCloseAddBadges = document.getElementById('btn-close-add-badges');
    const btnInfoWork = document.getElementById('btn-info-work');
    const btnCloseInfoWork = document.getElementById('btn-close-info-work');

    const btnAdmAddBadges = document.getElementById('btn-adm-add-badges');
    const btnCloseAdmAddBadges = document.getElementById('btn-close-adm-add-badges');

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

    if(newPassword){
        newPassword.addEventListener("keypress", limitPassword);
    }

    if(buttonSubmit){
        buttonSubmit.addEventListener("click", verifyPassword);
    }

    if(redirectBtn){
        redirectBtn.addEventListener('click', function() {
            history.back();
        })
    }

    if(inputStrings){
        inputStrings.addEventListener("keypress", inputStringValidation);
    }

    if(inputNumbers){
        inputNumbers.addEventListener("keypress", inputNumberValidation);
    }

    // dark mode
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

    // pets
    if(btnAddPet){
        const form = document.getElementById('form-add-pet');
        btnAddPet.addEventListener("click", () => toggleForm(form));
    }

    if(btnCloseAddPet){
        const form = document.getElementById('form-add-pet');
        btnCloseAddPet.addEventListener("click", () => toggleForm(form));
    }

    if(btnInfoPet){
        const form = document.getElementById('form-info-pet');
        btnInfoPet.addEventListener("click", () => toggleForm(form));
    }

    if(btnCloseInfoPet){
        const form = document.getElementById('form-info-pet');
        btnCloseInfoPet.addEventListener("click", () => toggleForm(form));
    }

    if(btnPetRotina){
        const form = document.getElementById('form-rotina');
        btnPetRotina.addEventListener("click", () => toggleForm(form));
    } 

    if(btnCloseRotina){
        const form = document.getElementById('form-rotina');
        btnCloseRotina.addEventListener("click", () => toggleForm(form));
    } 
    
    if(btnPetFichaMedica){
        const form = document.getElementById('form-ficha-medica');
        btnPetFichaMedica.addEventListener("click", () => toggleForm(form));
    }  

    if(btnCloseFichaMedica){
        const form = document.getElementById('form-ficha-medica');
        btnCloseFichaMedica.addEventListener("click", () => toggleForm(form));
    }  
    
    if(btnPetContatoPet){
        const form = document.getElementById('form-contato-pet');
        btnPetContatoPet.addEventListener("click", () => toggleForm(form));
    }

    if(btnCloseContatoPet){
        const form = document.getElementById('form-contato-pet');
        btnCloseContatoPet.addEventListener("click", () => toggleForm(form));
    }

    if(btnFotoPet){
        const form = document.getElementById('form-foto-pet');
        btnFotoPet.addEventListener("click", () => toggleForm(form));
    }

    if(btnCloseFotoPet){
        const form = document.getElementById('form-foto-pet');
        btnCloseFotoPet.addEventListener("click", () => toggleForm(form));
    }
    
    //tutor e sitter
    if(btnFotoProfile){
        const form = document.getElementById('form-foto-profile');
        btnFotoProfile.addEventListener("click", () => toggleForm(form));
    }

    if(btnCloseFotoProfile){
        const form = document.getElementById('form-foto-profile');
        btnCloseFotoProfile.addEventListener("click", () => toggleForm(form));
    }

    if(btnInfoProfile){
        const form = document.getElementById('form-info-profile');
        btnInfoProfile.addEventListener("click", () => toggleForm(form));
    }

    if(btnCloseInfoProfile){
        const form = document.getElementById('form-info-profile');
        btnCloseInfoProfile.addEventListener("click", () => toggleForm(form));
    }

    if(btnInfoAddress){
        const form = document.getElementById('form-address');
        btnInfoAddress.addEventListener("click", () => toggleForm(form));
    }

    if(btnCloseAddress){
        const form = document.getElementById('form-address');
        btnCloseAddress.addEventListener("click", () => toggleForm(form));
    }

    if(btnResetPassword){
        const form = document.getElementById('form-reset-password');
        btnResetPassword.addEventListener("click", () => toggleForm(form));
    }

    if(btnCloseResetPassword){
        const form = document.getElementById('form-reset-password');
        btnCloseResetPassword.addEventListener("click", () => toggleForm(form));
    }

    //sitter
    if(btnAddBadges){
        const form = document.getElementById('form-add-badges');
        btnAddBadges.addEventListener("click", () => toggleForm(form));
    }

    if(btnCloseAddBadges){
        const form = document.getElementById('form-add-badges');
        btnCloseAddBadges.addEventListener("click", () => toggleForm(form));
    }

    if(btnInfoWork){
        const form = document.getElementById('form-info-work');
        btnInfoWork.addEventListener("click", () => toggleForm(form));
    }

    if(btnCloseInfoWork){
        const form = document.getElementById('form-info-work');
        btnCloseInfoWork.addEventListener("click", () => toggleForm(form));
    }

    //adm
    if(btnAdmAddBadges){
        const form = document.getElementById('form-adm-add-badges');
        btnAdmAddBadges.addEventListener("click", () => toggleForm(form));
    }

    if(btnCloseAdmAddBadges){
        const form = document.getElementById('form-adm-add-badges');
        btnCloseAdmAddBadges.addEventListener("click", () => toggleForm(form));
    }

    formStep();
}

function toggleForm(element){
    element.classList.toggle("hidden");
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
    
            if(data.erro){
                document.getElementById("street").value=""
                document.getElementById("city").value=""
                document.getElementById("state").value=""
                document.getElementById("country").value=""    
            }else{
                document.getElementById("street").value=data.logradouro
                document.getElementById("city").value=data.localidade
                document.getElementById("state").value=data.uf
                document.getElementById("country").value="Brasil"
            }
    
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

    if(this.value.length == 3){
        this.value = this.value + ",";
    }
}

function limitPassword(e){
    if(this.value.length < 8){
        e.target.offsetParent.querySelector('.msg-error').innerHTML = "Senha mínima de 8 caracteres";
    }else{
        e.target.offsetParent.querySelector('.msg-error').innerHTML = "";
    }
}

function verifyLimitPassword(e){
    const newinputPassword = document.getElementById("new-password");

    if(newinputPassword.value.length < 8){
        document.querySelector('.msg-error').innerHTML = "Senha mínima de 8 caracteres";

        return false;
    }
    return true;
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
    return verifyPassword(e);
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