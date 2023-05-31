const header = document.querySelector("header");
window.addEventListener("scroll", function(){
    header.classList.toggle("sticky", window.scrollY > 100);
});

let Menu = document.getElementById("#MenuIcon");
let NavLists = document.getElementById(".NavList");

Menu.onclick =()=>{
    Menu.classList.toggle('bx-x');
    NavLists.classList.toggle('open');
};

window.onscroll = ()=>{
    Menu.classList.remove('bx-x');
    NavLists.classList.remove('open');
}

// let Hello = document.getElementById("Hello");
// Hello.onclick = ()=>{
//     alert('Hello');
//     Hello.style.backgroundImage='url(../a.jpg)';
// }