// declaration :
function id(id){
    return document.getElementById(id);
}
const firstName = id('firstName');
const lastName = id('lastName');
const email = id('email');
const password = id('password');
const c_password = id('c_password');
const profile = id('profile');
const registerForm = document.forms[0];

// Validation :
function validation(event){
    const patternName = /^([a-z]{3,}(\s[a-z]+)*)$/i;
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const passwordPattern = /^.{7,}$/;
    let valid = true;

    firstName.classList.remove('border-red-500', 'border-green-500');
    lastName.classList.remove('border-red-500', 'border-green-500');
    email.classList.remove('border-red-500', 'border-green-500');
    password.classList.remove('border-red-500', 'border-green-500');
    c_password.classList.remove('border-red-500', 'border-green-500');

    if (firstName.value && patternName.test(firstName.value)){
        firstName.classList.add('border-green-500');
    }else{
        firstName.classList.add('border-red-500');
        valid = false;
    }
    if (lastName.value && patternName.test(lastName.value)){
        lastName.classList.add('border-green-500');
    }else{
        lastName.classList.add('border-red-500');
        valid = false;
    }
    if (email.value && emailPattern.test(email.value)){
        email.classList.add('border-green-500');
    }else{
        email.classList.add('border-red-500');
        valid = false;
    }
    if (password.value && passwordPattern.test(password.value)){
        password.classList.add('border-green-500');
    }else{
        password.classList.add('border-red-500');
        valid = false;
    }
    if(c_password.value == password.value){
        c_password.classList.add('border-green-500');
    }else{
        c_password.classList.add('border-red-500');
        valid = false;
    }

    if(!valid){
        return event.preventDefault();
    }
}

registerForm.onsubmit = function(event){
    validation(event);
}