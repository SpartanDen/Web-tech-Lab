function toggleBackgroundColor() {
    var currentColor = document.body.style.backgroundColor;
    document.body.style.backgroundColor = currentColor === "black" ? "#5c4033" : "black";
}
function displayCurrentTime() {
    var d = new Date();
    var hours = String(d.getHours()).padStart(2, '0');
    var minutes = String(d.getMinutes()).padStart(2, '0');
    var seconds = String(d.getSeconds()).padStart(2, '0');
    var timeStr = `${hours}:${minutes}:${seconds}`;
    document.timeForm.timeInput.value = timeStr;
    setInterval(displayCurrentTime, 1000);
}
function mouseOver() {
    document.getElementById('hoverBox').innerHTML = "History is amazing!";
}function mouseOut() {
    document.getElementById('hoverBox').innerHTML = "History is learning about our past";
}
function displayImageText() {
    document.getElementById("imageText").innerHTML = "This is a world map.";
}
function clearImageText() {
    document.getElementById("imageText").innerHTML = "";
}
