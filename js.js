function functionContacts() {

	document.getElementById("home").style.display = "block";
	document.getElementById("sidebar").style.display = "none";
	document.getElementById("addContact").style.display = "none";
}

function functionFilterContacts() {

	document.getElementById("sidebar").style.display = "block";
	document.getElementById("home").style.display = "none";
	document.getElementById("addContact").style.display = "none";
}

function functionAdd() {

	document.getElementById("addContact").style.display = "flex";
	document.getElementById("addContact").style.flexDirection = "column";
	document.getElementById("sidebar").style.display = "none";
	document.getElementById("home").style.display = "none";
}

function functionLogout() {

	window.location.replace("login_register.html");
}

function home() {

	document.getElementById("home_page").style.display = "block";
	document.getElementById("login").style.display = "none";
	document.getElementById("register").style.display = "none";
	document.getElementById("filteredTitle").style.display = "none";
}

function login_js() {
  
  document.getElementById("login").style.display = "flex";
  document.getElementById("login").style.flexDirection = "column";
  document.getElementById("register").style.display = "none";
  document.getElementById("home_page").style.display = "none";
  document.getElementById("filteredTitle").style.display = "none";
}

function register_js() {
  
  document.getElementById("register").style.display = "flex";
  document.getElementById("register").style.flexDirection = "column";
  document.getElementById("login").style.display = "none";
  document.getElementById("home_page").style.display = "none";
  document.getElementById("filteredTitle").style.display = "none";
}