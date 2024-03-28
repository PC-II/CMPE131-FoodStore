const loginBtn = document.querySelector("#login-button");
loginBtn.addEventListener("click", () => {
    // open the login pop up screen
    alert("Login button was pressed!");
});
const acntBtn = document.querySelector("#account-button");
acntBtn.addEventListener("click", () => {
    // open the account pop up screen
    alert("Account button was pressed!");
    window.open("accountPage.html");
    window.close("index.html");
});

