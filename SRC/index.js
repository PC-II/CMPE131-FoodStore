import { generateResponse } from "./ai.js";

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
  location.assign("../PHP/shoppingcart.php");
});

const accountBtn = document.querySelector("#account-button");
accountBtn.addEventListener("click", () => {
  // open the customer account page
  location.assign("../PHP/customer_profile.php");
});

const categoriesBtn = document.querySelector('#categories-button');
const dropdownMenu = document.querySelector('.dropdown');
const main = document.querySelector('main');
if(categoriesBtn) {
  categoriesBtn.addEventListener('click', () => {
    // open the dropdown menu for the categories
    dropdownMenu.classList.toggle('hidden');
    main.classList.toggle('dim');
  });
}


document.addEventListener('click', (e) => {
  if(!dropdownMenu.contains(e.target) && !categoriesBtn.contains(e.target))
  {
    dropdownMenu.classList.add("hidden");
    main.classList.remove('dim');
  }
  if(!boxes[0].contains(e.target) && !boxes[1].contains(e.target) && !boxes[2].contains(e.target))
    resetActiveBoxes();
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

const privacyPolicyBtn = document.getElementById('privacy-policy-button');
privacyPolicyBtn.addEventListener('click', () => {
  location.assign('../HTML/privacyPolicy.html');
})

const licensingBtn = document.getElementById('licensing-button');
licensingBtn.addEventListener('click', () => {
  location.assign('../HTML/licensing.html');
})

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
  })
  body.classList.remove('dark-body');
  // Apply light mode styles
}

let userInput = document.getElementById('user-input');
userInput.addEventListener('keydown', async (e) => {
  if(e.keyCode == 13)
  {
    if (!e.shiftKey)
    {
      e.preventDefault();
      if(userInput.value == '') return;

      waitingForResponse();

      const response = await generateResponse(userInput.value);
      showResponse(response);
    }
    else
    {
      e.preventDefault();
      userInput.value += '\n';
    }
  }

  if(userInput.clientHeight !== userInput.scrollHeight)
    userInput.style.height = `${userInput.scrollHeight - 10}px`;
});

userInput.addEventListener('keyup', (e) => {
  if(e.key === `Backspace`)
  {
    userInput.style.height = `24px`;
    userInput.style.height = `${userInput.scrollHeight - 10}px`;
  }
});

const boxPrompts = [
  `<p class="box">What are some popular foods I can make for dinner?</p>`, 
  `<p class="box">I'm making chilaquiles tonight, what are some organic ingredients I might need?</p>`,
  `<p class="box">What spices pair well with chicken parmesan?</p>`,
  `<p class="box">What's the difference between organic and conventionally grown produce?</p>`,
  `<p class="box">What are some substitutions I can make for an organic ingredient?</p>`,
  `<p class="box">How long will my organic groceries typically stay fresh?</p>`,
  `<p class="box">What are some tips for cooking with unfamiliar organic ingredients?</p>`,
  `<p class="box">How can I store my organic produce to ensure it stays fresh for longer?</p>`,
  `<p class="box">I'm wondering how to make the best pancakes with organic ingredients.</p>`,
  `<p class="box">What are some tips for preserving the shelf life of organic herbs and spices?</p>`,
]
const suggestions = document.querySelector('.chat-bot .suggestions');
const generateBoxes = () => {
  const boxIndices = [];
  while(boxIndices.length < 3)
  {
    const randomNumber = Math.floor(Math.random() * 10);
    if(!boxIndices.includes(randomNumber))
      boxIndices.push(randomNumber); 
  }

  boxIndices.forEach(index => {
    suggestions.insertAdjacentHTML('beforeend', boxPrompts[index])
  });

  return suggestions.querySelectorAll('.box');
}
const boxes = generateBoxes();

const resetActiveBoxes = () => {
  boxes.forEach(box => {
    box.style.background = `silver`;
  })
}

boxes.forEach(box => {
  box.addEventListener('click', () => {
    resetActiveBoxes();
    box.style.background = `var(--ogs-green)`;
    userInput.value = box.textContent;
    userInput.focus();
    userInput.style.height = `24px`;
  });
});

const botSubmitBtn = document.getElementById('bot-submit-button');
botSubmitBtn.addEventListener('click', async () => {
  if(userInput.value == '') return;

  waitingForResponse();

  const response = await generateResponse(userInput.value);
  console.log(response);
  showResponse(response);
});

const waitingBalls = document.querySelector('.chat-bot .bot-field .waiting-balls')
const waitingForResponse = () => {
  waitingBalls.classList.toggle('hidden');
  waitingBalls.style.maxHeight = `none`;
}

const responseArea = document.querySelector('.chat-bot .response-area')
const userQuery = responseArea.querySelector('.user-query pre');
const botResponse = responseArea.querySelector('.bot-response pre')
const showResponse = (response) => {
  userQuery.textContent = userInput.value;
  botResponse.textContent = response;
  responseArea.style.maxHeight = 'none';
  userInput.value = '';

  waitingBalls.classList.toggle('hidden');
  waitingBalls.style.maxHeight = `0px`;
}

