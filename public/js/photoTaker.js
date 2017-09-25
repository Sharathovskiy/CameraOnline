$(document).keyup(function(e){
    if(e.keyCode === 13 || e.keyCode === 32 && !isPhotoDisplayed){
        snap();
    }
});

$('#cancel').click(function(){
   hidePhoto();
});

$('#snap').click(function(){
    var opacity = 0;
    
    function changeOpacity(){
        afterPicture.style.opacity = opacity;
        
        if(opacity <= 1){
            setTimeout(changeOpacity, 15);
        }
        opacity += 0.05;
    }
    changeOpacity();
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
    setImgValue();
}

/**
 * Stops the video and shows canvas with photo.
 */
function displayPhoto(){
    beforePicture.style.display = 'none';
    afterPicture.style.display = 'block';
    footer.style.display = 'none';
    video.pause();
    isPhotoDisplayed = true;
}

/**
 * Plays the video and hides canvas with photo
 */
function hidePhoto(){
    afterPicture.style.display = 'none';
    beforePicture.style.display = 'block';
    footer.style.display = 'block';
    video.play();
    isPhotoDisplayed = false;
}

function setImgValue(){
    var dataURL = canvas.toDataURL("image/png");
    document.getElementById('hidden_data').value = dataURL;
}