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
const main = document.querySelector('.main');
categoriesBtn.addEventListener('click', () => {
  // open the dropdown menu for the categories
  dropdownMenu.classList.toggle('hidden');
  
});

document.addEventListener('click', (e) => {
  if(!dropdownMenu.contains(e.target) && !categoriesBtn.contains(e.target))
    dropdownMenu.classList.add("hidden");
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