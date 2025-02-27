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

  let classSelect = document.querySelectorAll(".classSelect");

  classSelect.forEach((select) => {
    select.addEventListener("change", () => {
      const classId = select.value;
      const userId = select.getAttribute("user_id");
      const formData = new FormData();

      formData.append("CSRF", CSRF_token);
      formData.append("class_id", classId);
      formData.append("user_id", userId);
      fetch("admin/changeUserClass", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          actionResponseHandler(data);
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });
  });

  let rolesSelect = document.querySelectorAll(".rolesSelect");

  rolesSelect.forEach((select) => {
    select.addEventListener("change", () => {
      const roleId = select.value;
      const userId = select.getAttribute("user_id");
      const formData = new FormData();

      formData.append("CSRF", CSRF_token);
      formData.append("role_id", roleId);
      formData.append("user_id", userId);
      fetch("admin/changeUserRole", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          actionResponseHandler(data);
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });
  });

  editMode();

  function deleteUserButtonsHandler(userId) {
    const formData = new FormData();
    formData.append("CSRF", CSRF_token);
    formData.append("user_id", userId);
    fetch("admin/deleteUser", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        actionResponseHandler(data); // Affiche la réponse du serveur
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }

  const deleteUserButtons = document.querySelectorAll(".deleteUserButton");

  deleteUserButtons.forEach((button) => {
    let userId = button.getAttribute("user_id");

    button.addEventListener("click", () => {
      deleteUserButtonsHandler(userId);
    });
  });
};

window.addEventListener("hashchange", pagesRouter);

function selectNav(hash) {
  console.log("seletc");

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
  } else {
    window.location.hash = "#accounts";
    goPage("accounts", accountsPage);
  }
  if (hash !== "") {
    selectNav(hash);
  }
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
      closeModal();
      pagesRouter();
      displaySuccess(data.message);
    } else if (data.status === "error") {
      displayError(data.message);
    }
  }
}

function closeModal() {
  let modalCloseBtn = document.querySelector(".btn-close");
  modalCloseBtn.click();
}

let editedFields = {};

function editMode() {
  const editablesFields = document.querySelectorAll(".editable");

  editablesFields.forEach((field) => {
    let oldContent = field.textContent;
    field.addEventListener("dblclick", () => {
      field.setAttribute("contenteditable", true);
    });

    field.addEventListener("blur", () => {
      field.setAttribute("contenteditable", false);
      let content = field.textContent;
      let column = field.getAttribute("name");
      let user_id = field.parentElement.getAttribute("user_id");

      if (oldContent !== content) {
        editTableRow(content, column, user_id);
      }
    });
  });
}

function editTableRow(content, column, user_id) {
  const formData = new FormData();

  formData.append("CSRF", CSRF_token);
  formData.append("column", column);
  formData.append("user_id", user_id);
  formData.append("content", content);

  fetch("admin/editUser", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      actionResponseHandler(data);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
