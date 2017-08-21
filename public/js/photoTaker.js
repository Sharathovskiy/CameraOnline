var video = document.getElementById('video');
var canvas = document.getElementById('canvas');

var context = canvas.getContext('2d');
var row = document.getElementById('photos');
var tdCounter = 0;
var trCounter = 0;
var photos = [];

function snap(){
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    addCellAndInsertImage(video);
    photos.push(video);
}

function addCellAndInsertImage(image){
    if(tdCounter >= 10){
        table = row.parentElement;
        var newRow = table.insertRow(-1);
        row = newRow;
        tdCounter = 0;
        trCounter++;
    }
    var td = row.insertCell(-1);
    var canvasId = 'c' + trCounter + tdCounter;
    td.innerHTML = '<canvas id="' + canvasId + '" width="100" height="100"></canvas>';
    var tdCanvas = document.getElementById(canvasId);
    tdCanvas.getContext('2d').drawImage(image, 0,0,100,100);
    tdCounter++;
}