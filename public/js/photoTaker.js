var video = document.getElementById('video');
var canvas = document.getElementById('canvas');

var context = canvas.getContext('2d');
var row = document.getElementById('photos');
var tdCounter = 0;
var trCounter = 0;

function snap() {
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
}

function sendPhoto() {
    var canvas = document.getElementById("canvas");
    var dataURL = canvas.toDataURL("image/png");
    document.getElementById('hidden_data').value = dataURL;
    var fd = new FormData(document.forms["form1"]);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', photoTakenRoute, true);

    xhr.send(fd);
}

function addCellAndInsertImage(image) {
    if (tdCounter >= 10) {
        table = row.parentElement;
        var newRow = table.insertRow(-1);
        row = newRow;
        tdCounter = 0;
        trCounter++;
    }
    var newImg = document.createElement('img');
    newImg.src = canvas.toDataURL();
    newImg.width = 100;
    newImg.height = 100;

    var td = row.insertCell(-1);
    td.appendChild(newImg);
    tdCounter++;
}

