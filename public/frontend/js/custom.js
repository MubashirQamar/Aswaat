var sidepanel=document.getElementById("searchpanel");function openNav(){"300px"==sidepanel.style.width?sidepanel.style.width="0px":sidepanel.style.width="300px"}function customDropdown(){document.getElementById("myDropdown").classList.toggle("show")}window.onclick=function(e){if(!e.target.matches(".dropbtn")){var t,n=document.getElementsByClassName("dropdown-content");for(t=0;t<n.length;t++){var s=n[t];s.classList.contains("show")&&s.classList.remove("show")}}};
