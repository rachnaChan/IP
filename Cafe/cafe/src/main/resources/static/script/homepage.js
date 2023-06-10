$(document).ready(function () {
  $(".type").click(function () {
    const value = $(this).attr("data-filter");

    if(value=='drink'){
        document.querySelector('.item_container').style.cssText='display: flex;gap: 1rem; --x-slide:-202%;overflow: hidden;'
    }else if(value=='food'){
        document.querySelector('.item_container').style.cssText='display: flex;gap: 1rem; --x-slide:-101%;overflow: hidden;'
        
    }else{
        document.querySelector('.item_container').style.cssText='display: flex;gap: 1rem; --x-slide:-0%;overflow: hidden;'

    }
  });

  $(".type").click(function () {
    $(this).addClass("active").siblings().removeClass("active");
  });
});

function search() {
  let dataFilter = document.getElementById("find").value.toUpperCase();

  let items = document.querySelectorAll(".product");
  let list = document.getElementsByTagName("h5");

  for (var i = 0; i <= list.length; i++) {
    let aa = items[i].getElementsByTagName("h5")[0];

    let value = aa.innerHTML || aa.innerText || aa.textContent;

    if (value.toUpperCase().indexOf(dataFilter) > -1) {
      items[i].style.display = "";
    } else {
      items[i].style.display = "none";
    }
  }
}

const drinks = document.getElementsByClassName("dname");
const drinkSelected = (e) => {
  // Get ID of Clicked Element
  let drinkID = e.target.id;
  let images = document.getElementsByClassName("dimage");
  for (let image of images) {
    // image.style.display = "none";
    image.classList.add("d-none");
  }
  document.getElementById("dimage" + drinkID).classList.remove("d-none");
  // document.getElementById("dimage" + drinkID).style.display = "inline-block";
};

for (let drink of drinks) {
  drink.addEventListener("click", drinkSelected);
}

const foods = document.getElementsByClassName("fname");
const foodSelected = (e) => {
  // Get ID of Clicked Element
  let foodID = e.target.id;
  let images = document.getElementsByClassName("fimage");
  for (let image of images) {
    // image.style.display = "none";
    image.classList.add("d-none");
  }
  document.getElementById("fimage" + foodID).classList.remove("d-none");
  // document.getElementById("fimage" + foodID).style.display = "inline-block";
};

for (let food of foods) {
  food.addEventListener("click", foodSelected);
}

const cashiers = document.getElementsByClassName("cname");
const cashierSelected = (e) => {
  // Get ID of Clicked Element
  let cashierID = e.target.id;
  let images = document.getElementsByClassName("cimage");
  for (let image of images) {
    image.classList.add("d-none");
  }
  document.getElementById("cimage" + cashierID).classList.remove("d-none");
};

for (let cashier of cashiers) {
  cashier.addEventListener("click", cashierSelected);
}


var btnCashier = document.getElementById("cashiers")
// var 


$(function () {
  $("#content-1").mCustomScrollbar({
      theme: "rounded-dots-dark"
  });

  // $("#content-2").mCustomScrollbar({
  //     theme: "rounded-dots-dark"
  // });
  // $("#content-3").mCustomScrollbar({
  //     theme: "rounded-dots-dark"
  // });
});