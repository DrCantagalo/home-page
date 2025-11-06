import './bootstrap';
import.meta.glob(['../images/**']);
import './gsap';
import './github-calendar';
import $ from 'jquery';

$(function(){
    let currentURL = window.location.href;
    let currentFile = currentURL.substring(currentURL.lastIndexOf('/') + 1) || 'index';
    if (!window.AppData.cookiePermission && currentFile !== 'legal') { 
        if (localStorage.getItem('visit_token') !== null) {
            let formData = {
                'id-token': localStorage.getItem('visit_token'),
                'user-verb': 'remember-me'
            };
            $.post('handler', formData, function(result) { 
                if(result.status == 'error') { 
                    localStorage.clear();
                    cookiePermission();
                }
                else { if(result.lang_changed) { location.reload(); } }
            });
        }
        else { cookiePermission(); }
    }
    setTimeout(function(){
        const logos = document.querySelectorAll('.tech-logo');
        logos.forEach((logo, i) => {
            setTimeout(() => {
                logo.classList.remove('opacity-0');
                logo.classList.add('opacity-80');
            }, i * 100); 
        });
    }, 1000);
});

$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});

function cookiePermission() {
    if (!document.getElementById('cookies')) {
        var askPermission = document.createElement("div");
        askPermission.className = "cookies";
        askPermission.id = "cookies";
        document.body.appendChild(askPermission);
    }
    $('#cookies').hide();
    $('#cookies').load('cookies', function(){ setTimeout(() => $('#cookies').fadeIn(200), 50); });
}

function changeLang(lang, option) {
    var frontData = {
        "lang":lang,
        "user-verb":"change-lang",
        "cookie-box":option
    };
    $.post('handler', frontData, function(){ 
        if (option) { cookiePermission(); }
        else { window.location.reload(); }
    });
}

window.changeLang = changeLang;

$(document).on('submit', '#cookie-form', async function(e) {
    e.preventDefault();
    let extraData = {};
    $('#cookie-btn').prop('disabled', true);
    if ($('#get-data-auth').is(':checked')) {
        try {
            const response = await fetch('https://ipapi.co/json/');
            extraData = await response.json();
        }
        catch { extraData = {}; }
    }
    let formArray = $(this).serializeArray();  
    formArray.push(
        {name: "origin", value: document.referrer || ''},
        {name: 'visits', value: 1}
    );
    for (const [key, value] of Object.entries(extraData)) { formArray.push({ name: "ipapi_" + key, value: value }); }
    if ($('#remember-decision').is(':checked')) {
        let idToken = btoa(Date.now() + '-' + Math.random().toString(36).substring(2, 8))
        formArray.push({name: "id-token", value: idToken});
        localStorage.setItem('visit_token', idToken);
    }
    $.post('handler', formArray, function(result) { 
        if(result.lang_changed) { location.reload(); }
        $('#cookies').fadeOut(200);
    });
});

$('#password-toggle').on('click', function() {
    if($(this).prop('checked') === true) {
        let text;
        if(window.lang == 'it') { text = 'Nascondi i testi sensibili'; }
        else if(window.lang == 'pt') { text = 'Ocultar os textos sensíveis'; }
        else { text = 'Hide the sensitive texts'; }
        $('#secret-hash').attr('type', 'text');
        $('#verification-code').attr('type', 'text');
        $('#password1').attr('type', 'text');
        $('#password2').attr('type', 'text');
        $('label[for=password-toggle').text(text);
    }
    else {
        let text;
        if(window.lang == 'it') { text = 'Mostra i testi nascosti'; }
        else if(window.lang == 'pt') { text = 'Mostrar os textos ocultos'; }
        else { text = 'Show the hidden texts'; }
        $('#secret-hash').attr('type', 'password');
        $('#verification-code').attr('type', 'password');
        $('#password1').attr('type', 'password');
        $('#password2').attr('type', 'password');
        $('label[for=password-toggle').text(text);
    }
});

function loadClearCredentials() {
    if (!document.getElementById('clear-credentials')) {
        var showForm = document.createElement("div");
        showForm.id = "clear-credentials";
        document.body.appendChild(showForm);
    }
    $('#clear-credentials').hide();
    $('#clear-credentials').load('timeflag', function() {
        $('#clear-credentials').load('clearcredentials', function(){ 
            setTimeout(() => $('#clear-credentials').fadeIn(200), 50);
        });
    });
}

window.loadClearCredentials = loadClearCredentials;