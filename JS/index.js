

const loginBtn = document.querySelector("#login-button");
if (loginBtn) {
  loginBtn.addEventListener("click", () => {
    // open the login page
    location.assign("../HTML/customer_login.html");
  });
}


const contactBtn = document.querySelector("#contact-button");
contactBtn.addEventListener("click", () => {
  // open the contact us page
  location.assign("../HTML/contact_us.html");
});

const aboutBtn = document.querySelector("#about-us-button");
aboutBtn.addEventListener("click", () => {
  // open the about page
  location.assign("../HTML/aboutpage.html");
});

const accountBtn = document.querySelector("#account-button");
accountBtn.addEventListener("click", () => {
  // open the customer account page
  location.assign("../PHP/customer_profile.php");
});

const cartBtn = document.querySelector("#cart-button");
cartBtn.addEventListener("click", () => {
  // open the shopping cart page
  location.assign("../HTML/shoppingcart.html");
});

const logoutBtn = document.querySelector("#logout-button");
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
