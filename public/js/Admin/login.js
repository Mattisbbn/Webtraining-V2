const adminLoginForm = document.querySelector("#adminLoginForm");
const emailInput = document.querySelector("#email")
const passwordInput = document.querySelector("#password")
const CSRF = document.querySelector('#CSRF').value

const errorContainer = document.querySelector("#errorContainer")
const errorMessage = document.querySelector("#errorMessage")

adminLoginForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    
    const formData = new FormData();
    formData.append('CSRF',CSRF)
    formData.append('email',emailInput.value)
    formData.append('password',passwordInput.value)

    fetch('/admin/login', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        loginResponseHandler(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
})

function loginResponseHandler(data){
    if ('error' in data) {
        displayError(data.error);
    }

    if(data.status === "sucess"){
        window.location.replace("/dashboard");
    }

}

function displayError(e) {
    errorMessage.innerHTML = e
   errorContainer.classList.add("error-show");
  

   setTimeout(() => {
       errorContainer.classList.remove("error-show");
   }, 3000);
}
