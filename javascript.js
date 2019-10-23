// javascript.js

function O(i) { return typeof i == 'object' ? i : document.getElementById(i) }
function S(i) { return O(i).style                                            }
function C(i) { return document.getElementsByClassName(i)                    }

function passwordVal() {
  var x = document.forms["passLength"]["fpass"].value;
  if(x.value.length <= 8) {
    alert("Password must be at least 8 characters long.");}
  else {
    return false;
  }
} 

/*source https://dev.to/ananyaneogi/create-a-dark-light-mode-switch-with-css-variables-34l8*/
const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
const currentTheme = localStorage.getItem('theme');

if (currentTheme) {
    document.documentElement.setAttribute('data-theme', currentTheme);
  
    if (currentTheme === 'dark') {
        toggleSwitch.checked = true;
    }
}

function switchTheme(e) {
    if (e.target.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
    }
    else {
          document.documentElement.setAttribute('data-theme', 'light');
          localStorage.setItem('theme', 'light');
    }    
}

toggleSwitch.addEventListener('change', switchTheme, false);
    