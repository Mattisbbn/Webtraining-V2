const adminLoginForm = document.querySelector("#adminLoginForm");
const emailInput = document.querySelector("#email")
const passwordInput = document.querySelector("#password")
const CSRF = document.querySelector('#CSRF').value


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
    .then(response => response.text())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });

    
})