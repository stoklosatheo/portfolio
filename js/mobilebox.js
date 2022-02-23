class MobileBox {
    constructor(xMin, yMin, xMax, yMax) {
        this.xMin = xMin;
        this.yMin = yMin;
        this.xMax = xMax;
        this.yMax = yMax;
        this.mobTab = [];

        const boxDiv2 = document.createElement('div');
        boxDiv2.id = 'box2';
        boxDiv2.padding = '0';
        boxDiv2.style.position = 'absolute';

        let border = 2;

        boxDiv2.style.left = xMin+'px';
        boxDiv2.style.top = yMin+'px';
        // boxDiv2.style.right = 800+'px';
        // boxDiv2.style.bottom = 500+'px';
        boxDiv2.style.width = (xMax-xMin-2*border)+'px';
        boxDiv2.style.height = (yMax-yMin-2*border)+'px';
        boxDiv2.style.border = '2px solid black';
        document.body.appendChild(boxDiv2);
    }

    fillBox(n) {
        function getRandomInt(max) {
            return Math.floor(Math.random() * Math.floor(max + 1));
        }

        // Initialisation du tableau de mobiles
        var mobTab = [];

        // Remplissage du tableau de mobiles
        for (var i = 0; i < n; i++)
        if (mobTab.length > 0) {
            mobTab.removeMobiles();
        }
        else
        {
            // Coordonnées x et y du mobile d'indice i tirées
            // aléatoirement à l'intérieur de la boîte
            var x = this.xMin + getRandomInt(this.xMax - this.xMin);
            var y = this.yMin + getRandomInt(this.yMax - this.yMin);

            // Vitesses aléatoires comprise entre 1 et 10
            var vx = 1 + getRandomInt(9);
            var vy = 1 + getRandomInt(9);

            // Création de l'instance de l'objet Mobile
            // d'indice i
            var mob = new Mobile('div' + i, x, y, vx, vy);

            // Ajout de l'instance de l'objet Mobile créée
            // au tableau mobTab
            this.mobTab.push(mob);
        }
    } 

    removeMobiles() {
        for (let i = 0; i < mobTab.length; i++)
        {
            // Suppression des éléments div
            mobTab[i].removeElement();
        }

        // Suppression des mobiles
        mobTab.splice(0, mobTab.length);
    }

    anim() {
        for (var i = 0; i < this.mobTab.length; i++)
        {
            this.mobTab[i].moveInBoxGravity(this.xMin,this.yMin, this.xMax, this.yMax);        
            this.mobTab[i].position();
        }
    }
}

var box = new MobileBox(850, 250, 1100, 600);

// function nombreMobiles() {
//     box.fillBox(8);
// }

var nbMob = document.getElementById("nb1");
var putNbMob = document.getElementById("nbmob");
putNbMob.addEventListener("click", function() {
    box.fillBox(nbMob.value);
    box.anim();
})


function animInBox2() {
    mobTab.forEach(function() {
        box.anim();
    });
}

// function startInBox2() {
//     if (animationTimer == 0)
//         animationTimer = setInterval(animInBox2, 40);
// }

let starttime = 0;
// Fréquence d'affichage maximum
const maxfps = 60;
const interval = 1000 / maxfps;

// Fonction permettant de démarrer l'animation
function startRAF(timestamp = 0) {
	animationTimer = requestAnimationFrame(startRAF);
	if (starttime === 0) starttime = timestamp;
	let delta = timestamp - starttime;
	if (delta >= interval) {
		animInBox2();
		starttime = timestamp - (delta % interval);
	}
}

// Fonction permettant d'arrêter l'animation
function stopRAF() {
	cancelAnimationFrame(animationTimer);
	animationTimer = 0;
}

var bAnimInBox2 = document.querySelector(".animInBox2");
bAnimInBox2.addEventListener("click", function() {
    if (animationTimer == 0) {
        // Pas d'animation en cours, on lance l'anim
        startRAF();
        bAnimInBox2.textContent = "Arrêter l'anim MobileBox";
    } else {
        stopRAF();
        bAnimInBox2.textContent = "Lancer l'anim MobileBox";
    }
});



