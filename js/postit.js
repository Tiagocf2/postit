const MIN_POSTIT_OFFSET = 400;
var mouseX = 0;
var mouseY = 0;
var offsetX = 0;
var offsetY = 0;
var drag;
var isHolding = false;

var comment = document.getElementById("comment");

if(navigator.userAgent.toLowerCase().match(/mobile/i)){
	document.addEventListener("touchmove", handleTouch);
	comment.addEventListener("touchstart", holdComment);
	document.addEventListener("touchend", dropComment);

	comment.texto.addEventListener("touchstart",interruptParentEvent); //mousedown
	comment.submit.addEventListener("touchstart",interruptParentEvent); //mousedown
} else {
	document.onmousemove = handleMouse;
	comment.addEventListener("mousedown", holdComment);
	document.addEventListener("mouseup", dropComment);

	comment.texto.addEventListener("mousedown",interruptParentEvent);
	comment.submit.addEventListener("mousedown",interruptParentEvent);
}

function interruptParentEvent(event){
	//console.log('interruptParentEvent');
	event.stopPropagation();
}

function handleMouse(event){
	//console.log('handleMouse');
	if(isHolding && event.clientY > window.innerHeight - 50){
		window.scrollTo(window.pageXOffset, window.pageYOffset + 20);
	}
	mouseX = event.clientX;
	mouseY = event.clientY + (document.documentElement.scrollTop || window.pageYOffset);
}

function handleTouch(event){
	isHolding = !isHolding;
	if(isHolding){
		holdComment();
	} else {
		dropComment();
	}
}

function holdComment(){
	comment.texto.disabled = true;
	comment.submit.disabled = true;
	var pos = comment.getBoundingClientRect();
	offsetX = mouseX - pos.x + 10;
	offsetY = mouseY - (pos.y + (document.documentElement.scrollTop || window.pageYOffset)) + 10;
	clearInterval(drag);
	drag = setInterval(holdingComment, 10);
}

function holdingComment(){
	comment.style.transform = "rotateZ(8deg)";
	comment.style.top = mouseY - offsetY;
	comment.style.left = mouseX - offsetX;
	comment.x.value = comment.style.left;
	comment.y.value = comment.style.top;
	
}

function dropComment(){
	comment.texto.disabled = false;
	comment.submit.disabled = false;
	comment.style.transform = "";
	clearInterval(drag);
}
