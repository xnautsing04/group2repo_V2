//These functions act as links for buttons to work with upon clicking when the buttons are not within forms.

//Takes you to the confirmation page.
function confirmInfo()
{
    window.location.href="../pages/fuel_quote_confirmation.html";
}

//Takes you to the fuel quote denial page.
function denyInfo()
{
    window.location.href="../php/fuelQuoteForm.php";
}

//Takes you to the fuel quote form.
function formLoader()
{
    window.location.href="../php/fuelQuoteForm.php";
}

//Takes you to the fuel quote history page.
function historyLoader()
{
    window.location.href = "../php/fuel_quote_history.php";
}
// Takes you to Profile page
function profileLoader()
{
    window.location.href = "../php/clientProfile.php";
}

//Takes you to the login screen.
function loginLoader()
{
    window.location.href = "../pages/login.php";
}
