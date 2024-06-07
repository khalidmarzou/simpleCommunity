function removeDisabled(event) {
  const targetInput = event.currentTarget.previousElementSibling;
  targetInput.removeAttribute("disabled", "");
  targetInput.setAttribute("required", "");
  targetInput.classList.remove("bg-gray-50");
  targetInput.classList.add("bg-blue-50");

  if (targetInput.id == "password") {
    targetInput.parentElement.parentElement.nextElementSibling.nextElementSibling.children[1].removeAttribute(
      "disabled",
      ""
    );
    targetInput.parentElement.parentElement.nextElementSibling.nextElementSibling.children[1].setAttribute(
      "required",
      ""
    );
    targetInput.parentElement.parentElement.nextElementSibling.nextElementSibling.children[1].classList.remove(
      "bg-gray-50"
    );
    targetInput.parentElement.parentElement.nextElementSibling.nextElementSibling.children[1].classList.add(
      "bg-blue-50"
    );
  }
}
