const green = document.querySelector(".green");
const red = document.querySelector(".red");
const orange = document.querySelector(".orange");
const color = document.querySelector(".content");

green.addEventListener("click", () => {
  color.style.backgroundColor = "green";
  color.innerHTML = `
    <div class="right-content">
    <div class="table-info">
        <h1>Table Information</h1>
        <h2>Tabel: ,</h2>
        <h2>Status: Available</h2>
        <h2>Orders:</h2>

        <input type="submit" value="Next">
    </div>
</div>
    `;
});
red.addEventListener("click", () => {
  color.style.backgroundColor = "red";
});
orange.addEventListener("click", () => {
  color.style.backgroundColor = "orange";
});
