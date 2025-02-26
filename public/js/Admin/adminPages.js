const CSRF_token = document.querySelector("#CSRF").value;

const errorContainer = document.querySelector("#errorContainer");
const errorMessage = document.querySelector("#errorMessage");

const successContainer = document.querySelector("#successContainer");
const successMessage = document.querySelector("#successMessage");

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
class makeAccountFormValidation {
  constructor(username) {
    this.username = username;
    this.checkUsername();
  }

  checkUsername() {
    if (this.username.length < 5) {
      // displayError("Le nom doit comporter au moins 5 caractères.")
    }
  }
}

const accountsPage = () => {
  const usernameInput = document.querySelector("#username-input");
  const makeAccountForm = document.querySelector("#makeAccountForm");

  const accountsModalBody = document.querySelector(".accounts-modal-body");

  new makeAccountFormValidation(usernameInput.value);

  makeAccountForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const formData = new FormData(makeAccountForm);
    formData.append("CSRF", CSRF_token);
    const makeAccountLoader = new loader(accountsModalBody);
    fetch("admin/makeUser", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        actionResponseHandler(data); // Affiche la réponse du serveur
        makeAccountLoader.destroy(accountsModalBody);
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
};

window.addEventListener("hashchange", pagesRouter);

function selectNav(hash) {
  let navList = document.querySelectorAll(".navList a li");
  let selectedNav = document.querySelector(`a[href="${hash}"] li`);
  navList.forEach((nav) => {
    nav.classList.remove("selected");
    nav.classList.remove("text-white");
  });

  selectedNav.classList.add("text-white");
  selectedNav.classList.add("selected");
}

function pagesRouter() {
  let hash = window.location.hash;

  if (hash === "#accounts") {
    goPage("accounts", accountsPage);
  } else if (hash === "#classes") {
    goPage("classes", "");
  } else if (hash === "#subjects") {
    goPage("subjects", "");
  } else if (hash === "#lessons") {
    goPage("lessons", "");
  }else{
    window.location.hash = "#accounts"
    goPage("accounts", accountsPage);
  }
  selectNav(hash);
}
pagesRouter();

function displayError(e) {
  errorMessage.innerHTML = e;
  errorContainer.classList.add("message-show");

  setTimeout(() => {
    errorContainer.classList.remove("message-show");
  }, 3000);
}

function displaySuccess(e) {
  successMessage.innerHTML = e;
  successContainer.classList.add("message-show");

  setTimeout(() => {
    successContainer.classList.remove("message-show");
  }, 3000);
}
class loader {
  constructor(element) {
    this.element = element;
    this.span = document.createElement("div");

    this.span.className =
      "position-absolute d-flex w-100 h-100 bg-white justify-content-center align-items-center p-5 loader-wrapper top-50 start-50 translate-middle";
    this.span.innerHTML = '<span class="loader"></span>';

    element.appendChild(this.span);
  }

  destroy() {
    if (this.span) {
      this.span.remove();
      this.span = null;
    }
  }
}

function actionResponseHandler(data) {
  if ("status" in data) {
    if (data.status === "success") {
      displaySuccess(data.message);
    } else if (data.status === "error") {
      displayError(data.message);
    }
  }
}