var video = document.createElement("video");
var canvas = document.getElementById("viewport");
var ctx = canvas.getContext("2d");

document.getElementById("btn-text").onclick = function () {
  Video();
};
var num = 0;

video.autoplay = true;

function Video() {
  if (num == 0) {
    document.getElementById("btn-text").innerHTML = "Pause";
    num = 1;
    (function loop() {
      if (num == 1) {
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

        setTimeout(loop, 1000 / 30);
      } else {
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
      }
    })();
  } else if (num == 1) {
    document.getElementById("btn-text").innerHTML = "Start";
    num = 0;
  }
}

navigator.mediaDevices
  .getUserMedia({
    audio: false,
    video: true,
  })
  .then((stream) => {
    video.srcObject = stream;
    console.log("test");
  })
  .catch((err) => {
    console.log(
      "navigator.MediaDevices.getUserMedia error:",
      err.message,
      err.name
    );
  });
