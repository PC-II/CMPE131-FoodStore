$(document).ready(function() {
    // Home and Logo button
    $('#logo-button, #home-button').click(function() {
        location.assign("../PHP/index.php");
    });

    // Login button
    $('#login-button').click(function() {
        location.assign("../HTML/customer_login.html");
    });

    // Shopping cart button
    $('#cart-button').click(function() {
        location.assign("../HTML/shoppingcart.html");
    });

    // Customer account button
    $('#account-button').click(function() {
        location.assign("../PHP/customer_profile.php");
    });

    // Categories dropdown and buttons
    const categoriesBtn = $('#categories-button');
    const dropdownMenu = $('.dropdown');
    const main = $('main');
    categoriesBtn.click(function() {
        dropdownMenu.toggleClass('hidden');
        main.toggleClass('dim');
    });

    $(document).click(function(e) {
        if (!dropdownMenu.is(e.target) && !categoriesBtn.is(e.target)) {
            dropdownMenu.addClass("hidden");
            main.removeClass('dim');
        }
    });

    // About button
    $('#about-button').click(function() {
        location.assign("../HTML/aboutpage.html");
    });

    // Contact us button
    $('#contact-button').click(function() {
        location.assign("../HTML/contact_us.html");
    });

    // Privacy policy button
    $('#privacy-policy-button').click(function() {
        location.assign('../HTML/privacyPolicy.html');
    });

    // Licensing button
    $('#licensing-button').click(function() {
        location.assign('../HTML/licensing.html');
    });

    // Logout button
    $('#logout-button').click(function() {
        fetch("../PHP/logout.php", { method: "POST", headers: {"Content-Type": "application/x-www-form-urlencoded"} })
        .then(response => {
            if (response.ok) {
                location.assign("../PHP/index.php");
            } else {
                throw new Error("Failed to log out.");
            }
        })
        .catch(error => {
            console.error(error);
        });
    });

    //Dark Mode script
    //let prefersDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

    let prefersDarkMode = false;
    const darkModeElements = document.querySelectorAll('[data-dark-mode], dark-body');
    const themeToggleBtn = document.querySelector('#theme-toggle-button');
    const body = document.querySelector('body');
    let themeToggleSelector = themeToggleBtn.querySelector('.selector');
    themeToggleBtn.addEventListener('click', () => {
      if(themeToggleSelector.classList.contains('isDarkMode'))
      {
        body.classList.remove('dark-body');
        darkModeElements.forEach(entry => {
          if(entry.classList.contains('dark-background'))
            entry.classList.remove('dark-background')
          if(entry.classList.contains('dark-text'))
            entry.classList.remove('dark-text')
          if(entry.classList.contains('dark-form'))
            entry.classList.remove('dark-form')
          
        })
      }
      else
      {
        body.classList.add('dark-body');
        darkModeElements.forEach(entry => {
          if(entry.dataset.darkMode == 'both')
          {
            entry.classList.add('dark-background');
            entry.classList.add('dark-text');
          }
          else if(entry.dataset.darkMode == 'background')
          {
            entry.classList.add('dark-background');
          }
          else if(entry.dataset.darkMode == 'form')
          {
            entry.classList.add('dark-form');
            entry.classList.add('dark-text');
            entry.classList.add('dark-background');
          }
          else
          {
            entry.classList.add('dark-text');
          }
        })
      }
      themeToggleSelector.classList.toggle('isDarkMode');
    });

    // Use the prefersDarkMode variable to determine if dark mode is preferred
    // This will set the initial mode when the site is loaded
    if (prefersDarkMode) {
      if(!themeToggleSelector.classList.contains('isDarkMode'))
        themeToggleSelector.classList.add('isDarkMode');
      darkModeElements.forEach(element => {
        if(element.dataset.darkMode == 'both')
        {
          element.classList.add('dark-text');
          element.classList.add('dark-background');
        }
        else if(element.dataset.darkMode == 'text')
        {
          element.classList.add('dark-text');
        }
        else if(element.dataset.darkMode == 'form')
        {
          element.classList.add('dark-form');
          element.classList.add('dark-text');
          element.classList.add('dark-background');
        }
        else
        {
          element.classList.add('dark-background');
        }
      })
      body.classList.add('dark-body');

      // Apply dark mode styles
    } else {
      if(themeToggleSelector.classList.contains('isDarkMode'))
        themeToggleSelector.classList.remove('isDarkMode');
      darkModeElements.forEach(element => {
        if(element.classList.contains('dark-background'))
          element.classList.remove('dark-background')
        if(element.classList.contains('dark-text'))
          element.classList.remove('dark-text')
        if(element.classList.contains('dark-form'))
          element.classList.remove('dark-form')
      })
      // Apply light mode styles
      body.classList.remove('dark-body');
    }

});
