<?php
session_start();
if($_SESSION["UserPage"] == 1) {
    $_SESSION["UserPage"] = 2;
} if($_SESSION["UserPage"] < 2) {
    header('Location: Mission' . $_SESSION["UserPage"] . '.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<style>
html, body {
    margin: 0;
  overflow: hidden;
}
canvas {
	background-image: url("street.PNG");
	background-size: cover;
	height: 100%;
}
</style>
</head>
<body onload="startGame()">
<img src="autorot.png" id="autorot" >
<img src="autoblau.png" id="autoblau" >

<script>

var myGamePiece; 

var zahler = 0;

var x = 10, y = 100;

var zahl = 3;
var position_x =200;
var position_y =200;

var direction =3;

var lastLoop = new Date();
var ki = true;
var screenHeight = window.innerHeight;
var screenWidth = window.innerWidth;
var img;

var x1 = 350;
var x2 = 900;
var x3 = 1500;
var y1 = 700;
var y2 = 150;


var xPositionauto = x3;
var yPositionauto = y1;
var wPositionauto;
var hPositionauto;

var xPositionEnemy = x1;
var yPositionEnemy = y2;
var wPositionEnemy;
var hPositionEnemy;

var xPositionEnemy2 =x2;
var yPositionEnemy2 =y2;
var wPositionEnemy2;
var hPositionEnemy2;


function startGame() {
	myGamePiece = new component(123, 182, "auto.png", x1, y1, "image");
	enemy = document.getElementById("enemy");
	enemy2 = document.getElementById("enemy2");
	
    myGameArea.start();
}

var myGameArea = {
    canvas : document.createElement("canvas"),
    start : function() {
        this.canvas.width =window.innerWidth;
        this.canvas.height = window.innerHeight;
        
        this.context = this.canvas.getContext("2d");
        document.body.insertBefore(this.canvas, document.body.childNodes[0]);
        this.frameNo = 0;
        this.interval = setInterval(updateGameArea, 16);

        window.addEventListener('keydown', function (e) {
            e.preventDefault();
			zahl = 4;
            myGameArea.keys = (myGameArea.keys || []);
            myGameArea.keys[e.keyCode] = (e.type == "keydown");
        })
        window.addEventListener('keyup', function (e) {
			clearmove();
			zahl = 4;
            myGameArea.keys[e.keyCode] = (e.type == "keydown");
        })

    },

    clear : function() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    },
    stop : function() {
        clearInterval(this.interval);
    }
}


function component(width, height, color, x, y, type) {
    this.type = type;
	
    if (type == "image") {
        this.image = new Image();
        this.image.src = color;
    }
    this.width = width;
    this.height = height;
    this.speedX = 0;
    this.speedY = 0;    
    this.x = x;
    this.y = y;    
    this.update = function() {
    ctx = myGameArea.context;
	
	
	yPositionauto = this.y;
	wPositionauto = this.width;
	hPositionauto = this.height;
	
	draw();
        if (type == "image") {
            ctx.drawImage(this.image, 
                this.x, 
                this.y,
                this.width, this.height);
        } else {
            ctx.fillStyle = color;
            ctx.fillRect(this.x, this.y, this.width, this.height);
			
        }
    }
    this.newPos = function() {
        this.x = xPositionauto;
        this.y = yPositionauto;     
    }	
}

function collissionDetection(xPlayer, yPlayer, wPlayer, hPlayer
		, xObject, yObject, wObject, hObject) {
	
	if(xPlayer < xObject + wObject && xPlayer + wPlayer > xObject && yPlayer < yObject + hObject && yPlayer + hPlayer > yObject) {
		return true;
	} else {
		return false;
	}
	
}

function draw() {
	ctx = myGameArea.context;
	
	if(ki == true) {
		ctx.font = "bold 35px Consolas";
	}
	
	ctx.drawImage(autorot, xPositionEnemy, yPositionEnemy, 123, 182)
	ctx.drawImage(autoblau, xPositionEnemy2, yPositionEnemy2, 123, 182)
	
	yPositionEnemy+=10;
	
	yPositionEnemy2+=10;
	
	if(yPositionEnemy>=1100){
	zahler++;
	var zufall= Math.round(Math.random()*3)
		if(1==zufall){
			xPositionEnemy=x1;
		} else if(2==zufall){
			xPositionEnemy=x2;
		}else{
			xPositionEnemy=x3;
		}
		yPositionEnemy=y2;
	}
	if(yPositionEnemy2>=1100){
	zahler++;
	var zufall= Math.round(Math.random()*3)
		if(1== zufall){
			xPositionEnemy2=x1;
		} else if(2==zufall){
			xPositionEnemy2=x2;
		}else{
			xPositionEnemy2=x3;
		}
		yPositionEnemy2=y2;
	}

	
}

function getDistanceCircles(x1, y1, x2, y2){
	let xDistance = x2-x1;
	let yDistance = y2-y1;
	
	return Math.sqrt(Math.pow(xDistance, 2) + Math.pow(yDistance, 2));
}

function updateGameArea() {
	ctx = myGameArea.context;
	myGameArea.clear();
	if(myGameArea.keys && myGameArea.keys[13]) {
			window.location.href='12455672.php';
		}
	
	
	 if(collissionDetection(xPositionauto, yPositionauto, wPositionauto, hPositionauto,
		xPositionEnemy, yPositionEnemy, 123, 182) == true) {
		ctx.fillText("He escaped..." ,screenWidth/2-180, screenHeight/3*2+150);
				ctx.font = "bold 80px Consolas";
				ctx.fillText("Game Over" ,screenWidth/2-180, screenHeight/3*2-180);
				ctx.font = "bold 50px Consolas";
				ctx.fillText("Press enter to restart" ,screenWidth/2-300, screenHeight/3*2-100);
				showVender = false;
				dialogAcc == 6;
				
		
	} else if(collissionDetection(xPositionauto, yPositionauto, wPositionauto, hPositionauto,
		xPositionEnemy2,yPositionEnemy2,123, 182) == true) {
		
		ctx.fillText("He escaped..." ,screenWidth/2-180, screenHeight/3*2+150);
				ctx.font = "bold 80px Consolas";
				ctx.fillText("Game Over" ,screenWidth/2-180, screenHeight/3*2-180);
				ctx.font = "bold 50px Consolas";
				ctx.fillText("Press enter to restart" ,screenWidth/2-300, screenHeight/3*2-100);
				showVender = false;
				dialogAcc == 6;
	
	} else {
	
	
		if (myGameArea.keys && myGameArea.keys[39] || myGameArea.keys[68]) {
			if(xPositionauto==x1){
			xPositionauto = x2; 
			zahl = 3;
			}else if (zahl == 4){
			xPositionauto = x3; 
			}
		myGamePiece.image.src = "auto.png";	
			
		}

		if (myGameArea.keys && myGameArea.keys[37] || myGameArea.keys[65]) {
			if(xPositionauto==x3){
			xPositionauto = x2; 
			zahl = 3;
			}else if (zahl == 4){
			xPositionauto = x1; 
			}
		myGamePiece.image.src = "auto.png";	
			
		}		
		
		position_x = xPositionauto;
		
		
		
	}
	
	
	if(zahler == 20){
	
	window.location.href='zwischenspiel.html';
	}

	
    myGamePiece.newPos();
    myGamePiece.update();
}

function directionAfterCollision(xPositionauto, yPositionauto, wPositionauto, hPositionauto,
		xPositionEnemy, yPositionEnemy, wPositionEnemy, hPositionEnemy) {
		
		if (xPositionauto < xPositionEnemy && yPositionauto + hPositionauto > yPositionEnemy+8 && yPositionauto < yPositionEnemy+hPositionEnemy-8) {
			myGamePiece.speedX = -7;
		} else if (xPositionauto >= xPositionEnemy+20 && yPositionauto + hPositionauto > yPositionEnemy+8 && yPositionauto < yPositionEnemy+hPositionEnemy-8) {
			myGamePiece.speedX = 7;
		} else if (yPositionauto+hPositionauto <= yPositionEnemy+8) {
			myGamePiece.speedY = -7;
		} else if (yPositionauto >= yPositionEnemy + hPositionEnemy-8) {
			myGamePiece.speedY = 7;
		}
}


function clearmove() {
    myGamePiece.speedX = 0; 
    myGamePiece.speedY = 0; 
	
}
</script>

</body>
</html>