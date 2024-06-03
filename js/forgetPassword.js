function id(id) {
  return document.getElementById(id);
}
// declarations :
const emailInput = id("email");
const codeInput = id("code");
const confirmBtn = id("confirm_code");
const passwordInput = id("password");
const confirmPasswordInput = id("confirm-password");
const newsletter = id("newsletter");
const title = id("title");
const message = id("message");

let count = 0;

confirmBtn.onclick = function () {
  const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  emailInput.classList.remove("border-red-500", "border-green-500");
  let valid = false;

  if (email.value && emailPattern.test(email.value)) {
    email.classList.add("border-green-500");
    valid = true;
  } else {
    email.classList.add("border-red-500");
  }
  if (valid) {
    if (count == 0) {
      const data = {
        email: emailInput.value,
        count: count,
      };
      const options = {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      };

      fetch("/api/forgetPassword.api.php", options)
        .then((response) => {
          if (!response.ok) {
            throw new Error(
              "Network response was not ok " + response.statusText
            );
          }
          return response.json();
        })
        .then((data) => {
          if (data["status"] == 1) {
            emailInput.value = data["email"];
            emailInput.setAttribute("disabled", "");
            codeInput.parentElement.classList.remove("hidden");
            message.textContent = "";
            count++;
          } else {
            message.textContent = data["message"];
            emailInput.classList.remove("border-green-500");
            emailInput.classList.add("border-red-500");
          }
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    } else if (count == 1) {
      const codePattern = /[0-9]{6}/;

      if (codePattern.test(codeInput.value)) {
        const data = {
          email: emailInput.value,
          count: count,
          code: codeInput.value,
        };
        const options = {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(data),
        };

        fetch("/api/forgetPassword.api.php", options)
          .then((response) => {
            if (!response.ok) {
              throw new Error(
                "Network response was not ok " + response.statusText
              );
            }
            return response.json();
          })
          .then((data) => {
            if (data["status"] == 1) {
              codeInput.parentElement.classList.add("hidden");
              confirmBtn.classList.add("hidden");
              passwordInput.parentElement.classList.remove("hidden");
              confirmPasswordInput.parentElement.classList.remove("hidden");
              newsletter.parentElement.parentElement.classList.remove("hidden");
              document
                .querySelector('button[type = "submit"]')
                .classList.remove("hidden");
              message.textContent = "";
              count++;
            } else {
              codeInput.classList.add("border-red-500");
              message.textContent = "Wrong Code, pls check Your E-mail";
            }
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      } else {
        codeInput.classList.add("border-red-500");
      }
    }
  }
};

const form = document.forms[0];

form.onsubmit = function(event) {
    event.preventDefault();
    if (!/.{8,}/.test(passwordInput.value) || passwordInput.value !== confirmPasswordInput.value) {
        confirmPasswordInput.classList.add("border-red-500");
    } else {
        emailInput.removeAttribute("disabled");
        form.submit();
    }
};
