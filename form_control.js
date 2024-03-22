function checkName(name, help, label) {
  if (name.value.length >= 2 && name.value.length <= 50) {
    help.innerHTML = "Ce " + label + " est valide.";
    help.className = "px-2 form-text text-success";
    return true;
  } else {
    help.innerHTML =
      "Le " + label + " doit comporter entre 2 et 50 caractères.";
    help.className = "px-2 form-text text-danger";
    return false;
  }
}

function validateEmail(email) {
  const emailRegularExpression = new RegExp(
    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/i
  );
  return emailRegularExpression.test(email);
}

function checkEmail(email, help) {
  return new Promise((resolve, reject) => {
    fetch("json_mail.php?email=" + email.value)
      .then(function (answer) {
        return answer.json();
      })
      .then(function (answer) {
        if (validateEmail(email.value)) {
          if (answer.nb == 1) {
            help.innerHTML = "Cette adresse mail est déjà utilisée.";
            help.className = "px-2 form-text text-danger";
            resolve(false);
          } else {
            help.innerHTML = "Cette adresse mail est disponible.";
            help.className = "px-2 form-text text-success";
            resolve(true);
          }
        } else {
          help.innerHTML = "Le format de l'adresse mail est invalide.";
          help.className = "px-2 form-text text-danger";
          resolve(false);
        }
      })
      .catch((error) => {
        console.error("Erreur lors de la vérification de l'email : ", error);
        reject(error);
      });
  });
}

function validatePassword(password) {
  const passwordRegularExpression = new RegExp(
    /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,40}$/
  );
  return passwordRegularExpression.test(password);
}

function checkPassword(password1, password2, help) {
  if (password1.value.length >= 8 && password1.value.length <= 40) {
    if (validatePassword(password1.value)) {
      if (password1.value == password2.value) {
        help.innerHTML = "Les mots de passes correspondent.";
        help.className = "px-2 form-text text-success";
        return true;
      } else {
        help.innerHTML = "Les mots de passes doivent correspondrent.";
        help.className = "px-2 form-text text-danger";
        return false;
      }
    } else {
      help.innerHTML =
        "Le mot de passe doit contenir au minimum, une minuscule, une majuscule, un chiffre et un caractère spécial (#,?,!,@,$,%,^,&,*,-).";
      help.className = "px-2 form-text text-danger";
      return false;
    }
  } else {
    help.innerHTML = "Le mot de passe doit comporter entre 8 et 40 caractères.";
    help.className = "px-2 form-text text-danger";
    return false;
  }
}

const lastname = document.querySelector("#lastname");
const lastnameHelp = document.querySelector("#lastnameHelp");
lastname.addEventListener("blur", function (e) {
  checkName(lastname, lastnameHelp, "nom");
});

const firstname = document.querySelector("#firstname");
const firstnameHelp = document.querySelector("#firstnameHelp");
firstname.addEventListener("blur", function (e) {
  checkName(firstname, firstnameHelp, "prénom");
});

const email = document.querySelector("#email");
const emailHelp = document.querySelector("#emailHelp");
email.addEventListener("blur", function (e) {
  checkEmail(email, emailHelp);
});

const password1 = document.querySelector("#password1");
const password2 = document.querySelector("#password2");
const passwordHelp = document.querySelector("#passwordHelp");
password1.addEventListener("blur", function (e) {
  checkPassword(password1, password2, passwordHelp);
});
password2.addEventListener("blur", function (e) {
  checkPassword(password2, password1, passwordHelp);
});

const formSubmit = document.querySelector("#formSubmit");
const formAlert = document.querySelector("#formAlert");
formSubmit.addEventListener("click", function (e) {
  e.preventDefault();
  let formValidated = true;
  let validated = [];
  validated.push(checkName(lastname, lastnameHelp, "nom"));
  validated.push(checkName(firstname, firstnameHelp, "prénom"));
  validated.push(checkPassword(password1, password2, passwordHelp));
  validated.push(checkPassword(password2, password1, passwordHelp));
  checkEmail(email, emailHelp).then((result) => {
    validated.push(result);
    validated.forEach(function (field) {
      if (field != true) {
        formValidated = false;
      }
    });
    if (formValidated) {
      document.querySelector("#form").submit();
    } else {
      formAlert.innerHTML =
        "Formulaire invalide, merci de vérifier tout les champs.";
      formAlert.className = "alert alert-danger text-center";
    }
  });
});

const password1Visibility = document.querySelector("#password1Visibility");
password1Visibility.addEventListener("click", function () {
  if (password1.type === "password") {
    password1.type = "text";
    this.classList.remove("fa-eye");
    this.classList.add("fa-eye-slash");
  } else {
    password1.type = "password";
    this.classList.remove("fa-eye-slash");
    this.classList.add("fa-eye");
  }
});

const password2Visibility = document.querySelector("#password2Visibility");
password2Visibility.addEventListener("click", function () {
  if (password2.type === "password") {
    password2.type = "text";
    this.classList.remove("fa-eye");
    this.classList.add("fa-eye-slash");
  } else {
    password2.type = "password";
    this.classList.remove("fa-eye-slash");
    this.classList.add("fa-eye");
  }
});
