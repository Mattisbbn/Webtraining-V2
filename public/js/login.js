const inputLabels = document.querySelectorAll(".inputLabels")
const userTypeInput = document.querySelectorAll(".userTypeInput")

const emailInput = document.querySelector("#email")
const passwordInput = document.querySelector("#password")

userTypeInput.forEach((input,index) => {
    input.addEventListener("change",()=>{
        unselectInputs()
        if(input.checked === true){
            inputLabels[index].classList.remove("unselected-bg")
            inputLabels[index].classList.add("bg-black")
            inputLabels[index].classList.add("text-white")
        }
    })
});

function unselectInputs(){
    inputLabels.forEach((input)=>{
        input.classList.add("unselected-bg")
        input.classList.remove("bg-black")
        input.classList.remove("text-white")
    })
}

const loginForm = document.querySelector("#loginForm")
loginForm.addEventListener("submit",(e)=>{
    e.preventDefault()

    if(!checkUserType()){
        return
    }
    if(!checkEmail()){
        return
    }
    if(!checkPassword()){
        return
    }

    loginForm.submit()
})

function checkUserType(){
    if(userTypeInput[0].checked === false && userTypeInput[1].checked === false){
        displayError(errors.InvalidUserType)
        return false
    }
    return true;
}

function checkEmail(){
    if(emailInput.value === null || emailInput.value === "" ){
        displayError(errors.noEmail)
        return false;
    }
    return true
}

function checkPassword(){
    if(passwordInput.value === null || passwordInput.value === "" ){
        displayError(errors.noPassword)
        return false;
    }
    return true
}

// Affichage erreurs 

const errorContainer = document.querySelector("#errorContainer")
const errorMessage = document.querySelector("#errorMessage")

const errors = {
    "InvalidUserType": "Vous n'avez pas sélectionné votre type d'utilisateur.",
    "noEmail" : "Veuillez saisir votre adresse email.",
    "noPassword" : "Veuillez saisir votre mot de passe."
}

function displayError(e) {
     errorMessage.innerHTML = e
    errorContainer.classList.add("message-show");
   

    setTimeout(() => {
        errorContainer.classList.remove("message-show");
    }, 3000);
}
