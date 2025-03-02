const logoutButton = document.querySelector("#logoutButton")

logoutButton.addEventListener("click", () => {
  const formData = new FormData();

  fetch("logout", {
      method: "POST",
      body: formData,
  })
  .then(response => {
      if (response.ok) {
          window.location.href = "login"; // Redirection vers la page de login
      } else {
          console.error("Erreur lors de la déconnexion");
      }
  })
  .catch(error => console.error("Erreur réseau :", error));
});
