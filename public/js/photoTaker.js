$(document).keyup(function(e){
    if(e.keyCode === 13 || e.keyCode === 32){
        snap();
        sendPhoto();
    }
});

var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');

function snap() {
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
}

function sendPhoto() {
    var dataURL = canvas.toDataURL("image/png");
    document.getElementById('hidden_data').value = dataURL;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', uploadPhotoRoute, true);
    
    var fd = new FormData(document.forms["dataURLContainer"]);
    xhr.send(fd);
}