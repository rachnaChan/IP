var selectedRow = null;
let x = -1;
var names = [];
var price = [];
var category = [];
let header = document.getElementsByClassName("BookStore")[0];

function Submit(e) {
  event.preventDefault();
  var formData = readFormData();
  if (selectedRow === null) {
    AddRecord(formData);
  } else {
    UpdateRecord(formData);
  }
  Reset();
}

document.querySelector(".AddBook").placeholder = "";


function readFormData() {
  var formData = {};
  formData["name_book"] = document.getElementById("name_book").value;
  formData["price_book"] = document.getElementById("price_book").value;
  formData["category_book"] = document.getElementById("category_book").value;

  return formData;
}


function AddRecord(data) {
  names[x + 1] = data.name_book;
  price[x + 1] = data.price_book;
  category[x + 1] = data.category_book;

  document.getElementById("add_items").innerHTML += 
                        `<div class="items">
                        <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8b3BlbiUyMGJvb2t8ZW58MHx8MHx8&w=1000&q=80" alt="#">
                        <div class="name" data="${data.name_book}">Name : ${
    data.name_book
  }                     </div>
                        <div class="price">Price : ${
                          data.price_book
                        } riels</div>
                        <div class="category">Category : ${
                          data.category_book
                        }</div>
                        <div class="Button">
                            <button id="${parseInt(
                              x + 1
                            )}" class="EditBtn" onclick="EditRecord(this.id)">Edit</button>
                            <button id="${parseInt(
                              x + 1
                            )}" class="DeletBtn" onclick="DeleteRecord(this.id)">Delete</button>
                        </div>
                    </div>`;
  x++;
}


function EditRecord(id) {
  header.innerHTML = "Edit information here!!";

  selectedRow = id;
  document.getElementsByClassName("EditBook")[0].style.visibility = "visible";
  document.getElementsByClassName("AddBook")[0].style.visibility = "hidden";

  document.getElementById("name_book").value = names[id];
  document.getElementById("price_book").value = price[id];
  document.getElementById("category_book").value = category[id];
}

function UpdateRecord(formData) {
  document.getElementsByClassName("name")[selectedRow].innerHTML =
    "Name : " + formData.name_book;
  document.getElementsByClassName("price")[selectedRow].innerHTML =
    "Price : " + formData.price_book + " riels";
  document.getElementsByClassName("category")[selectedRow].innerHTML =
    "Category : " + formData.category_book;
  document.getElementsByClassName("EditBook")[0].style.visibility = "hidden";
  document.getElementsByClassName("AddBook")[0].style.visibility = "visible";

  document.getElementsByClassName("BookStore")[0].innerHTML = "ADD New BOOKs";

  selectedRow = null;
}


function DeleteRecord(id) {
  console.log(id);
  if (confirm("Do you want to delete this book??")) {
    document.getElementsByClassName("items")[id].hidden = true;
  }
  Reset();
}

function Reset() {
  document.getElementById("name_book").value = "";
  document.getElementById("price_book").value = "";
  document.getElementById("category_book").value = "";
}
