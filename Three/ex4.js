var selectedRow = null;
let header = document.getElementsByClassName("BookStore")[0];

let books = [{}];
const getB = localStorage.getItem("books");
const dataB = JSON.parse(getB);
for (databook in dataB) {
  document.getElementById(
    "add_items"
  ).innerHTML += `<div class="items"><img src="https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8b3BlbiUyMGJvb2t8ZW58MHx8MHx8&w=1000&q=80" alt="#">
                    <div class="name">Name : ${dataB[databook].name}</div>
                    <div class="price">Price : ${
                      dataB[databook].price
                    } riels</div>
                    <div class="category">Category : ${
                      dataB[databook].category
                    }</div>
                    <div class="Button"><button id="${parseInt(
                      databook
                    )}" class="EditBtn" onclick="EditRecord(this.id)">Edit</button>
                    <button id="${parseInt(
                      databook
                    )}" class="DeletBtn" onclick="DeleteRecord(this.id)">Delete</button>
                    </div>
                    </div>`;
}

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
  const getdata = localStorage.getItem("books");
  let databookss = JSON.parse(getdata);
  books = Object.assign([{}], databookss);
  let x;
  if (databookss == null) {
    x = 0;
  } else {
    x = databookss.length;
  }
  const book = {
    name: `${data.name_book}`,
    price: `${data.price_book}`,
    category: `${data.category_book}`,
  };
  books[x] = book;
  localStorage.setItem("books", JSON.stringify(books));
  let databooks = GetBook();

  document.getElementById(
    "add_items"
  ).innerHTML += `<div class="items"><img src="https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8b3BlbiUyMGJvb2t8ZW58MHx8MHx8&w=1000&q=80" alt="#">
                        <div class="name" data="${x}">Name : ${
    databooks[x].name
  }</div>
                        <div class="price">Price : ${
                          databooks[x].price
                        } Riels</div>
                        <div class="category">Category : ${
                          databooks[x].category
                        }</div>
                        <div class="Button"><button id="${parseInt(
                          x
                        )}" class="EditBtn" onclick="EditRecord(this.id)">Edit</button>
                            <button id="${parseInt(
                              x
                            )}" class="DeletBtn" onclick="DeleteRecord(this.id)">Delete</button></div>
                    </div>`;
}

function DeleteRecord(id) {
  let databooks = GetBook();
  if (confirm("Do you want to delete this record??")) {
    databooks.splice(id, 1);
    localStorage.setItem("books", JSON.stringify(databooks));

    document.getElementById("add_items").innerHTML = "";
    for (databook in databooks) {
      document.getElementById(
        "add_items"
      ).innerHTML += `<div class="items"><img src="https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8b3BlbiUyMGJvb2t8ZW58MHx8MHx8&w=1000&q=80" alt="#">
                                <div class="name">Name : ${
                                  databooks[databook].name
                                }</div>
                                <div class="price">Price : ${
                                  databooks[databook].price
                                } Riels</div>
                                <div class="category">Category : ${
                                  databooks[databook].category
                                }</div>
                                <div class="Button"><button id="${parseInt(
                                  databook
                                )}" class="EditBtn" onclick="EditRecord(this.id)">Edit</button>
                                    <button id="${parseInt(
                                      databook
                                    )}" class="DeletBtn" onclick="DeleteRecord(this.id)">Delete</button></div>
                            </div>`;
    }
  }
  Reset();
}

function EditRecord(id) {
  header.innerHTML = "Edit information here!!";

  let getdatabooks = GetBook();

  selectedRow = id;
  document.getElementsByClassName("EditBook")[0].style.visibility = "visible";
  document.getElementsByClassName("AddBook")[0].style.visibility = "hidden";

  document.getElementById("name_book").value = getdatabooks[id].name;
  document.getElementById("price_book").value = getdatabooks[id].price;
  document.getElementById("category_book").value = getdatabooks[id].category;
}

function UpdateRecord(formData) {
  document.getElementsByClassName("name")[selectedRow].innerHTML =
    "Name : " + formData.name_book;
  document.getElementsByClassName("price")[selectedRow].innerHTML =
    "Price : " + formData.price_book + " Riels";
  document.getElementsByClassName("category")[selectedRow].innerHTML =
    "Category : " + formData.category_book;
  document.getElementsByClassName("EditBook")[0].style.visibility = "hidden";
  document.getElementsByClassName("Addbook")[0].style.visibility = "visible";

  let bookss = GetBook();
  const bookUpdate = {
    name: `${formData.name_book}`,
    price: `${formData.price_book}`,
    category: `${formData.category_book}`,
  };

  books = Object.assign([{}], bookss);
  books[selectedRow] = bookUpdate;
  localStorage.setItem("books", JSON.stringify(books));

  document.getElementsByClassName("BookStore")[0].innerHTML =
    "Add new book here!!";
  selectedRow = null;
}

function Reset() {
  document.getElementById("name_book").value = "";
  document.getElementById("price_book").value = "";
  document.getElementById("category_book").value = "";
}

function GetBook() {
  const getbooks = localStorage.getItem("books");
  let databooks = JSON.parse(getbooks);

  return databooks;
}
