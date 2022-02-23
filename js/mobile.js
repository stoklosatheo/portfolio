class Mobile {
	constructor(idVal, xVal, yVal, vxVal, vyVal) {
		this.id = idVal;
		this.x = xVal;
		this.y = yVal;
        this.vx = vxVal;
        this.vy = vyVal;
		this.color = getRandomColor();

        const element = document.createElement('div');
        element.id = this.id;
        element.classList.add('mobile');
        document.body.appendChild(element);

        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
              color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
          }

        function getRandomInt(max) {
            return Math.floor(Math.random() * Math.floor(max + 1));
        }

        // Création de l'élément canvas
        const canvas = document.createElement('canvas');
        // Définition d'un rayon aléatoire entre 10 et 15 pixels
        this.radius = 10 + getRandomInt(15);
        // Définition de la taille du canvas
        canvas.width = 2 * this.radius;
        canvas.height = 2 * this.radius;
        // Récupération du contexte du canvas et tracé du disque
        const ctx = canvas.getContext('2d');
        ctx.fillStyle = this.color;
        ctx.beginPath();
        ctx.arc(this.radius, this.radius, this.radius, 0, 2 * Math.PI);
        ctx.fill();
        // Ajout du canvas comme enfant de l'élément div
        element.appendChild(canvas);

        const boxDiv = document.createElement('div');
        boxDiv.id = 'box';
        boxDiv.padding = '0';
        boxDiv.style.position = 'absolute';

        let xMin = 10, xMax = 800;
        let yMin = 250, yMax = 500;
        let border = 2;

        boxDiv.style.left = xMin+'px';
        boxDiv.style.top = yMin+'px';
        // boxDiv.style.right = 800+'px';
        // boxDiv.style.bottom = 500+'px';
        boxDiv.style.width = (xMax-xMin-2*border)+'px';
        boxDiv.style.height = (yMax-yMin-2*border)+'px';
        boxDiv.style.border = '2px solid black';
        document.body.appendChild(boxDiv);
	}

    position() {
		document.getElementById(this.id).style.left = this.x+'px';
		document.getElementById(this.id).style.top  = this.y+'px';
	}

    setColor(colorVal) {
        this.color = colorVal;
        this.position();
    }

    removeElement() {
        var element = document.getElementById(this.id);
        element.remove();
    }

    move() {
        this.x += this.vx;           // équivaut à this.x = this.x + this.vx
        if (this.x < 0) {
            this.x = window.innerWidth - 1;
        } else if (this.x > window.innerWidth - 1) {
            this.x = 0;
        }

        this.y += this.vy;
        if (this.y < 0) {
            this.y = window.innerHeight - 1;
        } else if (this.y > window.innerHeight - 1) {
            this.y = 0;
        }

        this.position();
    }

    moveInBox(xMin, yMin, xMax, yMax) {

        // Récupération de la taille de l'élément div en incluant la taille de sa bordure
        var w = document.getElementById(this.id).offsetWidth;
        var h = document.getElementById(this.id).offsetHeight;

        this.x += this.vx; 
        this.y += this.vy;


        //  Réapparition à l'opposé
        // if (this.x < xMin) {
        //     this.x = xMax - w;
        // } else if (this.x + w > xMax) {
        //     this.x = xMin;
        // }

        // if (this.y < yMin) {
        //     this.y = yMax - h;
        // } else if (this.y + h > yMax) {
        //     this.y = yMin;
        // }

        //  Rebond
        if (this.x < xMin) {
            this.x = xMin;
            this.vx = -this.vx;
        } else if (this.x + w > xMax) {
            this.x = xMax - w;
            this.vx = -this.vx ;
        }

        if (this.y < yMin) {
            this.y = yMin;
            this.vy = -this.vy;
        } else if (this.y + h > yMax) {
            this.y = yMax - h;
            this.vy = -this.vy; 
        }

        this.position();
    }

    moveInBoxGravity(xMin, yMin, xMax, yMax) {

        // Récupération de la taille de l'élément div en incluant la taille de sa bordure
        var w = document.getElementById(this.id).offsetWidth;
        var h = document.getElementById(this.id).offsetHeight;

        this.x += this.vx; 
        this.y += this.vy;

        this.vy *= 0.99;
        this.vy += 0.25;

        this.vx *= 0.99;

        //  Rebond
        if (this.x < xMin) {
            this.x = xMin;
            this.vx = -this.vx;
        } else if (this.x + w > xMax) {
            this.x = xMax - w;
            this.vx = -this.vx ;
        }

        if (this.y < yMin) {
            this.y = yMin;
            this.vy = -this.vy;
        } else if (this.y + h > yMax) {
            this.y = yMax - h;
            this.vy = -this.vy; 
        }

        this.position();
    }
}

// var mob1 = new Mobile('div1', 400, 200);
// var mob2 = new Mobile('div2', 500, 100);
// var mob3 = new Mobile('div3', 300, 400);

// mob1.position();
// mob2.position();
// mob3.position();

// var b1 = getElementById("mob1");
// b1.addEventListener("click", function() {
//     mob1.position();
// })

var mobTab = [
    new Mobile('div1', 400, 200, 5, -5),
    new Mobile('div2', 500, 100, 10, 4),
    new Mobile('div3', 300, 400, 8, -3)
];

var bTab = document.querySelectorAll(".position");
bTab.forEach(function(b, index) {
    b.addEventListener("click", function() {
        // console.log(index);
        mobTab[index].position();
    });
});

var suppr = document.querySelectorAll(".del")
suppr.forEach(function(suppr, index) {
    suppr.addEventListener("click", function() {
        mobTab[index].removeElement();
    })
});

var cTab = document.querySelectorAll(".color");
cTab.forEach(function(c, index) {       //index=position dans le tableau
    c.addEventListener("change", function() {
        mobTab[index].setColor(c.value);
    })
})  


// Fonction appliquant un déplacement au mobile

function anim() {
    mobTab.forEach(function(mob) {
        mob.move();
    });
}

// Fonction appliquant un déplacement à l'intérieur d'une boîte
function animInBox() {
    mobTab.forEach(function(mob) {
        mob.moveInBox(10, 250, 800, 500);
    });
}

// Appel de la fonction Anim lors d'un clic sur le bouton
var bDeplace = document.querySelector(".deplace");
bDeplace.addEventListener("click", function() {
    anim();
})

var animationTimer = 0;

function start() {
    if (animationTimer == 0)
        animationTimer = setInterval(anim, 40);
}

function stop() {
    clearInterval(animationTimer);
    animationTimer = 0;
}

var bAnim = document.querySelector(".anim");
bAnim.addEventListener("click", function() {
    if (animationTimer == 0) {
        // Pas d'animation en cours, on lance l'anim
        start();
        bAnim.textContent = "Arrêter l'animation";
    } else {
        stop();
        bAnim.textContent = "Lancer l'animation";
    }
});

// Mise en place de l'animation à l'intérieur d'une boîte
var animationTimer = 0;

function startInBox() {
    if (animationTimer == 0)
        animationTimer = setInterval(animInBox, 20);
}

function stopInBox() {
    clearInterval(animationTimer);
    animationTimer = 0;
}

var bAnimInBox = document.querySelector(".animInBox");
bAnimInBox.addEventListener("click", function() {
    if (animationTimer == 0) {
        // Pas d'animation en cours, on lance l'anim
        setInterval(startInBox(),20);
        bAnimInBox.textContent = "Arrêter l'animation boîte";
    } else {
        stopInBox();
        bAnimInBox.textContent = "Lancer l'animation boîte";
    }
});