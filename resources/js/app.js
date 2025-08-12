const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
import './bootstrap';
import './categories.js';
import './comments.js';
import './search.js';
import Alpine from 'alpinejs';
import './toast.js';
window.Alpine = Alpine
Alpine.start()

if(localStorage.theme === 'dark'){
    //document.querySelector('#theme-toggle').checked = true;
    document.querySelector('html').dataset.theme = 'dark';
}else{
    document.querySelector('html').dataset.theme = 'light';
}
function toggleTheme() {
    const html = document.documentElement;
    if (html.dataset.theme === 'dark') {
        html.removeAttribute('data-theme'); // back to light
        localStorage.theme = 'light';
    } else {
        html.dataset.theme = 'dark';
        localStorage.theme = 'dark';
    }
}

document.querySelector('#theme-toggle').addEventListener('click', toggleTheme);
