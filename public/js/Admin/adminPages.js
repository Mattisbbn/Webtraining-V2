const CSRF_token = document.querySelector('#CSRF').value






//     // new makeAccountFormValidation(usernameInput.value)

    
// })




// function submitUserForm(){

// }












// class makeAccountFormValidation{
//     constructor(username){
//         this.username = username
//         this.checkUsername()
//     }


//     checkUsername(){
//         if(this.username.length < 5){
            
//             // displayError("Le nom doit comporter au moins 5 caractères.")
//         }
//     }







// }





// const errorContainer = document.querySelector("#errorContainer")
// const errorMessage = document.querySelector("#errorMessage")

// const errors = {
//     "InvalidUserType": "Vous n'avez pas sélectionné votre type d'utilisateur.",
//     "noEmail" : "Veuillez saisir votre adresse email.",
//     "noPassword" : "Veuillez saisir votre mot de passe."
// }

// function displayError(e) {
//      errorMessage.innerHTML = e
//     errorContainer.classList.add("error-show");
   

//     setTimeout(() => {
//         errorContainer.classList.remove("error-show");
//     }, 3000);
// }


function goPage(view, pageFunction) {

    fetch(`dashboard/view/${view}`, {
      method: "POST",
    })
      .then((response) => response.text())
      .then((response) => {
        document.getElementById("pagesContainer").innerHTML = response;
        if (typeof pageFunction === "function") {
          pageFunction();
        }
      })
      .catch((error) => {
        console.error("Erreur Fetch :", error);
      });



    }


    const accountsPage = () => {
        const usernameInput = document.querySelector("#username-input");
        const emailInput = document.querySelector("#email-input");
        const passwordInput = document.querySelector("#password-input");
        const classInput = document.querySelector("#class-input");
        const roleInput = document.querySelector("#role-input");
    
        const makeAccountForm = document.querySelector("#makeAccountForm");
    
        makeAccountForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const formData = new FormData(makeAccountForm);
            formData.append('CSRF', CSRF_token);
    
            fetch('admin/makeUser', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);  // Affiche la réponse du serveur
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    }


    window.addEventListener('hashchange', pagesRouter);

  function pagesRouter(){
    let hash = window.location.hash
    
    if(hash === "#accounts"){
        goPage("accounts",accountsPage)
    }else if(hash === "#classes"){
        goPage("classes","")
    }else if(hash === "#subjects"){
        goPage("subjects","")
    }else if(hash === "#lessons"){
        goPage("lessons","")
    }
    
  }
  pagesRouter()