// Draw an uploaded image to a Canvas
// Tips from TP
// function handleImage(e) {
//     var reader = new FileReader();
//     reader.onload = function (event) {
//         var img = new Image();
//         img.onload = function () {
//             canvas.width = img.width;
//             canvas.height = img.height;
//             ctx.drawImage(img, 0, 0);
//         }
//         img.src = event.target.result;
//     }
//     reader.readAsDataURL(e.target.files[0]);
// }

let fileInput = document.getElementById("fileinput");
//Add change event listener to the file input
fileInput.addEventListener("change", function (event) {
  //We can access the file uploaded using event.target.files or if you want to access files without the event object then we can access using the fileInput.files
  if (event.target.files) {
    //A Data URL is a URI scheme that provides a way to inline data in a document, and it’s commonly used to embed images in HTML and CSS.
    let file = event.target.files[0]; //get first file
    var reader = new FileReader();
    reader.readAsDataURL(file);

    //Add loadend event listener to file reader , this event is triggered when the fileReader finish converting the file into dataURL.
    reader.onloadend = function (e) {
      //Once the fileReader converted the image to dataURL then we need to create an Image object.
      var image = new Image();

      //Set the source of the image as the dataURL
      image.src = e.target.result;

      //Add load event listener to the image. So once the image is loaded we can draw the image to canvas.
      image.onload = function (event) {
        //Once the image is loaded we need to draw the image on the canvas using drawImage method of canvas context.
        var canvas = document.getElementById("canvas");
        canvas.width = image.width;
        canvas.height = image.height;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(image, 0, 0);
      };
    };
  }
});
