$(document).keyup(function(e){
    if(e.keyCode === 13 || e.keyCode === 32 && !isPhotoDisplayed){
        snap();
    }
});

$('#send, #cancel').click(function(){
   if(this.id === 'send'){
       sendPhoto();
   }
   hidePhoto();
   isPhotoDisplayed = false;

});
var isPhotoDisplayed = false;

var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');

var beforePicture = document.getElementById('before-picture');
var afterPicture = document.getElementById('after-picture');
var footer = document.getElementById('footer');

function snap() {
    displayPhoto();

    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    canvas.style.display = "block";
    isPhotoDisplayed = true;
}

function displayPhoto(){
    beforePicture.style.display = 'none';
    afterPicture.style.display = 'block';
    footer.style.display = 'none';
}

function hidePhoto(){
    afterPicture.style.display = 'none';
    beforePicture.style.display = 'block';
    footer.style.display = 'block';
}

function sendPhoto() {
    var dataURL = canvas.toDataURL("image/png");
    document.getElementById('hidden_data').value = dataURL;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', uploadPhotoRoute, true);
    
    var fd = new FormData(document.forms["dataURLContainer"]);
    xhr.send(fd);
}