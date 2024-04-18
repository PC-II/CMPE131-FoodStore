const homeBtns = document.querySelectorAll('#logo-button, #home-button');
homeBtns.forEach(button => {
  button.addEventListener('click', () => {
    location.assign("./index.php");
  });
});

const loginBtn = document.querySelector("#login-button");
if (loginBtn) {
  loginBtn.addEventListener("click", () => {
    // open the login page
    location.assign("../HTML/customer_login.html");
  });
}

const cartBtn = document.querySelector("#cart-button");
cartBtn.addEventListener("click", () => {
  // open the shopping cart page
  location.assign("../HTML/shoppingcart.html");
});

const accountBtn = document.querySelector("#account-button");
accountBtn.addEventListener("click", () => {
  // open the customer account page
  location.assign("../PHP/customer_profile.php");
});

const categoriesBtn = document.querySelector('#categories-button');
const dropdownMenu = document.querySelector('.dropdown');
const main = document.querySelector('main');
categoriesBtn.addEventListener('click', () => {
  // open the dropdown menu for the categories
  dropdownMenu.classList.toggle('hidden');
  main.classList.toggle('dim');
});

document.addEventListener('click', (e) => {
  if(!dropdownMenu.contains(e.target) && !categoriesBtn.contains(e.target))
  {
    dropdownMenu.classList.add("hidden");
    main.classList.remove('dim');
  }  
});

const aboutBtn = document.querySelector("#about-button");
aboutBtn.addEventListener("click", () => {
  // open the about page
  location.assign("../HTML/aboutpage.html");
});

const contactBtn = document.querySelector("#contact-button");
contactBtn.addEventListener("click", () => {
  // open the contact us page
  location.assign("../HTML/contact_us.html");
});

const logoutBtn = document.querySelector("#logout-button");
if(logoutBtn)
{
  logoutBtn.addEventListener("click", () => {
    // send a request to the server to unset and destroy the session
    fetch("../PHP/logout.php", { method: "POST", headers: {"Content-Type": "application/x-www-form-urlencoded"}
    })
    
    .then(response => {
      if (response.ok) {
        // redirect to the homepage
        location.assign("../PHP/index.php");
      } else {
        throw new Error("Failed to log out.");
      }
    })
    .catch(error => {
      console.error(error);
    });
  });
}

const carouselContainer = document.querySelector('.slides');
const slides = document.querySelectorAll('.slides div');
let activeSlide = 0;

const carouselBtns = document.querySelectorAll('.carousel .buttons button');
const updateCarouselButton = (index) => {
  carouselBtns.forEach((button, i) => {
    if(index == i)
      button.style.background = `black`;
    else
      button.style.background = `gray`;
  });
}

const slideLength = slides.length;
const moveToSlide = (index) => {
  slides.forEach((slide, i) => {
    let translateAmount = i - index;
    if(translateAmount > Math.floor(slides.length / 2))
      translateAmount = translateAmount - slideLength;
    else if(translateAmount < -1 * Math.floor(slides.length / 2))
      translateAmount = translateAmount + slideLength;

    if(i == index)
    {
      slide.style.scale = `none`;
      slide.style.opacity = `1`;
    }
    else
    {
      slide.style.scale = `75%`;
      slide.style.opacity = `0`;
    }

    if(translateAmount <= 1 && translateAmount >= -1)
      slide.style.zIndex = `1`;
    else
      slide.style.zIndex = `0`;

    if(Math.abs(index - activeSlide) > 1 && Math.abs(index - activeSlide) != slides.length - 1)
      slide.style.transition = `none`;
    else
      slide.style.transition = `250ms ease-in-out`;

    slide.style.transform = `translateX(${(translateAmount) * 100}%)`;
  });
  activeSlide = index;
  updateCarouselButton(activeSlide);
}
// moves the carousel to the first slide on site load
moveToSlide(0);

const autoplay = () => {
  activeSlide++;
  if(activeSlide >= slides.length)
    activeSlide = 0;
  moveToSlide(activeSlide);
}

let intervalId = setInterval(autoplay, 4000);

const arrows = document.querySelectorAll('.arrows button');
arrows.forEach(arrow => {
  arrow.addEventListener('click', () => {

    clearInterval(intervalId);

    const offset = arrow.id.includes('right') ?  1 : -1;
    
    let newIndex = activeSlide + offset;
    
    if(newIndex < 0) newIndex = slides.length - 1;
    if(newIndex > slides.length - 1) newIndex = 0;

    moveToSlide(newIndex);
    intervalId = setInterval(autoplay, 4000);
  });
});

carouselBtns.forEach((button, i) => {
  button.addEventListener('click', () => {
    clearInterval(intervalId);
    moveToSlide(i);
    intervalId = setInterval(autoplay, 4000);
  });
});

let prefersDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
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
  console.log("User prefers dark mode");
  if(!themeToggleSelector.classList.contains('isDarkMode'))
    themeToggleSelector.classList.add('isDarkMode');
  // Apply dark mode styles
} else {
  console.log("User prefers light mode");
  if(themeToggleSelector.classList.contains('isDarkMode'))
    themeToggleSelector.classList.remove('isDarkMode');
  darkModeElements.forEach(element => {
    if(element.dataset.darkMode == 'both')
    {
      element.classList.remove('dark-text');
      element.classList.remove('dark-background');
    }
    else if(element.dataset.darkMode == 'text')
    {
      element.classList.remove('dark-text');
    }
    else
    {
      element.classList.remove('dark-background');
    }
  })
  body.classList.remove('dark-body');
  // Apply light mode styles
}