var sidepanel = document.getElementById("searchpanel")

function openNav() {

    if (sidepanel.style.width == "300px") {

        sidepanel.style.width = "0px";

    } else {

        sidepanel.style.width = "300px";

    }

}


/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function customDropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}