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

    const checkboxMenu = document.getElementById('checkbox-menu');

    if(checkboxMenu){
            checkboxMenu.addEventListener('click', () => {
            const menu = document.getElementById('menu');

            if (menu.classList.contains('open')) {
                // Se o elemento possui a classe 'hidden', remova-a
                menu.classList.remove('open');
            } else {
                // Se o elemento não possui a classe 'hidden', adicione-a
                menu.classList.add('open');
            }
        })
    }

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
    if(element.classList.contains('hidden')) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = 'auto';
    }
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
    const date = forms.date.vaule;
    const filter = forms.filter.value;
    const type = forms.type.value;
    const address = forms.address.value;
    const pets = [];

    forms['pets[]'].forEach(pet => pets.push(pet.value));

    const url = `data.php?time=${time}&date=${date}&filter=${filter}`;

    const getCardProfile = (sitter) => `
    <div class="card-profile">
        <form action="tutor_home_page.php?schedule" method="POST">
            <a href="view_sitter_page.php?user=${sitter.cod_usuario}"><img class="img-profile" src="images/${sitter.foto}" alt="Foto do usuário."></a>
            <a href="view_sitter_page.php?user=${sitter.cod_usuario}">
                <p title='${sitter.nome} ${sitter.sobrenome}'>${sitter.nome} ${sitter.sobrenome}</p>
            </a>
            <p class='price-view'>R$ ${sitter.preco}</p>
            <input type="hidden" name='sitter' value='${sitter.cod_catsitter}'>
            <input type="hidden" name='type' value='${type}'>
            <input type="hidden" name='address' value='${address}'>
            <input type="hidden" name='date' value='${date}'>
            <input type="hidden" name='time' value='${time}'>

            ${pets.map(pet => `<input type="hidden" name="pets[]" value="${pet}">`).join('')}

            <button class='btn-mark'>
                Agendar!
            </button>
            
            <a href="">
                <svg class="chat" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.99987 11C7.80208 11 7.60875 11.0586 7.4443 11.1685C7.27985 11.2784 7.15167 11.4346 7.07599 11.6173C7.0003 11.8 6.9805 12.0011 7.01908 12.1951C7.05767 12.3891 7.15291 12.5673 7.29276 12.7071C7.43261 12.847 7.61079 12.9422 7.80478 12.9808C7.99876 13.0194 8.19982 12.9996 8.38255 12.9239C8.56528 12.8482 8.72145 12.72 8.83134 12.5556C8.94122 12.3911 8.99987 12.1978 8.99987 12C8.99987 11.7348 8.89451 11.4804 8.70697 11.2929C8.51944 11.1054 8.26508 11 7.99987 11ZM11.9999 11C11.8021 11 11.6087 11.0586 11.4443 11.1685C11.2798 11.2784 11.1517 11.4346 11.076 11.6173C11.0003 11.8 10.9805 12.0011 11.0191 12.1951C11.0577 12.3891 11.1529 12.5673 11.2928 12.7071C11.4326 12.847 11.6108 12.9422 11.8048 12.9808C11.9988 13.0194 12.1998 12.9996 12.3826 12.9239C12.5653 12.8482 12.7215 12.72 12.8313 12.5556C12.9412 12.3911 12.9999 12.1978 12.9999 12C12.9999 11.7348 12.8945 11.4804 12.707 11.2929C12.5194 11.1054 12.2651 11 11.9999 11ZM15.9999 11C15.8021 11 15.6087 11.0586 15.4443 11.1685C15.2798 11.2784 15.1517 11.4346 15.076 11.6173C15.0003 11.8 14.9805 12.0011 15.0191 12.1951C15.0577 12.3891 15.1529 12.5673 15.2928 12.7071C15.4326 12.847 15.6108 12.9422 15.8048 12.9808C15.9988 13.0194 16.1998 12.9996 16.3825 12.9239C16.5653 12.8482 16.7215 12.72 16.8313 12.5556C16.9412 12.3911 16.9999 12.1978 16.9999 12C16.9999 11.7348 16.8945 11.4804 16.707 11.2929C16.5194 11.1054 16.2651 11 15.9999 11ZM11.9999 2C10.6866 2 9.38629 2.25866 8.17303 2.7612C6.95978 3.26375 5.85738 4.00035 4.9288 4.92893C3.05343 6.8043 1.99987 9.34784 1.99987 12C1.99112 14.3091 2.79066 16.5485 4.25987 18.33L2.25987 20.33C2.12111 20.4706 2.02711 20.6492 1.98974 20.8432C1.95236 21.0372 1.97329 21.2379 2.04987 21.42C2.13292 21.5999 2.26757 21.7511 2.43671 21.8544C2.60586 21.9577 2.80187 22.0083 2.99987 22H11.9999C14.652 22 17.1956 20.9464 19.0709 19.0711C20.9463 17.1957 21.9999 14.6522 21.9999 12C21.9999 9.34784 20.9463 6.8043 19.0709 4.92893C17.1956 3.05357 14.652 2 11.9999 2ZM11.9999 20H5.40987L6.33987 19.07C6.52612 18.8826 6.63066 18.6292 6.63066 18.365C6.63066 18.1008 6.52612 17.8474 6.33987 17.66C5.03045 16.352 4.21504 14.6305 4.03256 12.7888C3.85007 10.947 4.31181 9.09901 5.33909 7.55952C6.36638 6.02004 7.89566 4.88436 9.66638 4.34597C11.4371 3.80759 13.3397 3.8998 15.0501 4.60691C16.7604 5.31402 18.1727 6.59227 19.0463 8.22389C19.9199 9.85551 20.2007 11.7395 19.841 13.555C19.4813 15.3705 18.5032 17.005 17.0734 18.1802C15.6436 19.3554 13.8506 19.9985 11.9999 20Z" fill="#326B73"/>
                </svg>
            </a>
        </form>
    </div>
    `;

    
    fetch(url)
    
        .then(function(response){
            if(response.ok)
                return response.json()
            else
                console.log("erro");
    
        })
        .then(function(sitters){
            const parent =  document.querySelector('.sitters');

            console.log(sitters);

            if(sitters.length === 0) {
                parent.innerHTML = '<p>Nenhum resultado encontrado.</p>';
            }else {
                const html = sitters.map(sitter => getCardProfile(sitter)).join('');
     
                parent.innerHTML = html;
            }
    
    
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
    if (!(e.keyCode < 48 || e.keyCode > 57)) {
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