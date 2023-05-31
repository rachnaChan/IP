
function SelectOption() {
    document.getElementById("myOption").style.display = "block";
  }
  
  function closeForm() {
    document.getElementById("myOption").style.display = "none";
  }

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});


$(document).ready(function () {
  $('.type').click(function () {
      const value = $(this).attr('data-filter');

      if (value == 'all') {
          $('.itemBox').show('1000');
      } else {
          $('.itemBox').not('.' + value).hide('1000');
          $('.itemBox').filter('.' + value).show('1000');
      }
  })

  $('.type').click(function () {
      $(this).addClass('active').siblings().removeClass('active');
  })
})

function search(){
  let dataFilter = document.getElementById('find').value.toUpperCase();

  let items = document.querySelectorAll('.product')
  let list = document.getElementsByTagName('h5');

  for(var i=0; i<= list.length; i++){
      let aa=items[i].getElementsByTagName('h5')[0];

      let value= aa.innerHTML || aa.innerText || aa.textContent;

      if(value.toUpperCase().indexOf(dataFilter)>-1){
          items[i].style.display = "";
      }else{
          items[i].style.display="none";
      }
  }
}
