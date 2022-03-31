//These functions correspond with the different tabs on top of the screen.

//This takes you to the login page.
function loginTab()
{
    window.location.href = "../php/login.php";
}

//This takes you to the register page.
function registerTab()
{
    window.location.href = "../pages/registration.html";
}

//This takes you to the profile page.
function profileTab()
{
    window.location.href = "../php/clientProfile.php";
}

//This takes you to the fuel quote form.
function quoteTab()
{
    window.location.href = "../php/fuelQuoteForm.php";
}

//This takes you to the fuel quote history page.
function historyTab()
{
    window.location.href = "../php/fuel_quote_history.php";
}

//This logs the user out.
function logoutTab(){
    window.location.href = "../php/loggingOut.php";
}
