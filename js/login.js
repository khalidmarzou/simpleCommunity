// declaration :
function id(id){
    return document.getElementById(id);
}

const email = id('email');
const password = id('password');
const loginForm = document.forms[0];

// Validation :
function validation(event){
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const passwordPattern = /^.{7,}$/;
    let valid = true;

    email.classList.remove('border-red-500', 'border-green-500');
    password.classList.remove('border-red-500', 'border-green-500');

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

    if(!valid){
        return event.preventDefault();
    }
}

loginForm.onsubmit = function(event){
    validation(event);
}