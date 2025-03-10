const inputLabels = document.querySelectorAll(".inputLabels")


const emailInput = document.querySelector("#email")
const passwordInput = document.querySelector("#password")



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


    if(!checkEmail()){
        return
    }
    if(!checkPassword()){
        return
    }

    let formData = new FormData(loginForm)

    logUser(formData)
    
})

async function logUser(formData){

    try{
        let data = await fetch("/login",{method:"POST",body: formData})
        if(!data.ok){
            throw new Error("Erreur, la requette n'a pas fonctionnée.")
        }
        let response = await data.json()
 
        
       

        loginResponseHandler(response)
        
    }catch(e){
        console.log(e);
    }

}


function loginResponseHandler(data){

    
    if(data.status === "error"){
        displayError(data.message);
    }
    if(data.status === "success"){
        window.location.replace("/dashboard");
    }

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
