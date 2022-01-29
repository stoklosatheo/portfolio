/* ACCORDEON ARTICLES */
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}

/*--- Mode Sombre ---*/
var bouton_ms = document.createElement("a");
var body = document.querySelector("*");
var nav = document.querySelector("nav");

nav.appendChild(bouton_ms);
bouton_ms.innerText = "Mode sombre";
bouton_ms.classList.add("btn_mode_sombre");

bouton_ms.addEventListener("click", function () {
  if (body.classList.contains("mode_sombre")) {
    bouton_ms.innerText = "Activer le mode sombre";
    body.classList.toggle("mode_sombre");
    
  } else {
    bouton_ms.innerText = "Désactiver le mode sombre";
    body.classList.toggle("mode_sombre");
  }
});

/*--- Hover Bouton MS ---*/

bouton_ms.addEventListener("mouseover", function () {
  bouton_ms.classList.add("btn_mode_sombre:hover");
});

bouton_ms.addEventListener("mouseout", function () {
  bouton_ms.classList.remove("btn_mode_sombre:hover");
});

/* Boutons */
var itemFiltrage = new Array();
itemFiltrage[0] = "Mercato";
itemFiltrage[1] = "Résultats";
itemFiltrage[2] = "Divers";
itemFiltrage[3] = "Tous";

console.log(itemFiltrage);

var nav = document.querySelector("nav");
function CreateBouton(itemFiltrage) {
  for (var i in itemFiltrage) {
    var link = document.createElement("a");
    link.innerText = itemFiltrage[i];
    nav.appendChild(link);
    link.classList.add("lienfiltre");
  }
}
CreateBouton(itemFiltrage);

/*--- Classe selon catégorie ---*/
var categorie = document.getElementsByClassName("categorie");
var article = document.getElementsByTagName("article");
console.log(article.length);
console.log(categorie.length);
  for (let i = 0; i < categorie.length; i++) {
    console.log(categorie[i].innerText);
        if (categorie[i].innerText === "Mercato") {
        article[i].classList.add("merc");
        } else if (categorie[i].innerText === "Résultats") {
        article[i].classList.add("result");
        } else if (categorie[i].innerText === "Divers") {
          article[i].classList.add("divers");
        }
    }

/*--- Couleur par catégorie ---*/
for (let i = 0; i < categorie.length; i++) {
  if (categorie[i].innerText === "Mercato") {
    categorie[i].classList.add("cyan");
  } else if (categorie[i].innerText === "Résultats") {
    categorie[i].classList.add("magenta");
  } else if (categorie[i].innerText === "Divers") {
    categorie[i].classList.add("vert");
}
}
 
/*--- Filtrage ---*/
var bouton = document.getElementsByClassName("lienfiltre");
console.log(bouton.length);

var merc = document.getElementsByClassName("merc");

var result = document.getElementsByClassName("result");

var div = document.getElementsByClassName("divers");

for (let i = 0; i < bouton.length; i++) {
  if (
    bouton[i].addEventListener("click", function () {
      let x = bouton[i].innerText;
      console.log(x);
      switch (x) {
        case "Mercato":
          for (let j = 0; j < merc.length; j++) {
            merc[j].style.visibility = "visible";
            merc[j].style.display = "block";
          }

          for (let k = 0; k < result.length; k++) {
            result[k].style.visibility = "hidden";
            result[k].style.display = "none";
          }

          for (let l = 0; l < div.length; l++) {
            div[l].style.visibility = "hidden";
            div[l].style.display = "none";
          }
          break;

        case "Résultats":
          for (let j = 0; j < merc.length; j++) {
            merc[j].style.visibility = "hidden";
            merc[j].style.display = "none";
          }

          for (let k = 0; k < result.length; k++) {
            result[k].style.visibility = "visible";
            result[k].style.display = "block";
          }

          for (let l = 0; l < div.length; l++) {
            div[l].style.visibility = "hidden";
            div[l].style.display = "none";
          }
          break;

        case "Divers":
          for (let j = 0; j < merc.length; j++) {
            merc[j].style.visibility = "hidden";
            merc[j].style.display = "none";
          }

          for (let k = 0; k < result.length; k++) {
            result[k].style.visibility = "hidden";
            result[k].style.display = "none";
          }

          for (let l = 0; l < div.length; l++) {
            div[l].style.visibility = "visible";
            div[l].style.display = "block";
          }
          break;

        case "Tous":
          for (let j = 0; j < merc.length; j++) {
            merc[j].style.visibility = "visible";
            merc[j].style.display = "block";
          }

          for (let k = 0; k < result.length; k++) {
            result[k].style.visibility = "visible";
            result[k].style.display = "block";
          }

          for (let l = 0; l < div.length; l++) {
            div[l].style.visibility = "visible";
            div[l].style.display = "block";
          }
            break;

        default:
          for (let j = 0; j < merc.length; j++) {
            merc[j].style.visibility = "visible";
            merc[j].style.display = "block";
          }

          for (let k = 0; k < result.length; k++) {
            result[k].style.visibility = "visible";
            result[k].style.display = "block";
          }

          for (let l = 0; l < div.length; l++) {
            div[l].style.visibility = "visible";
            div[l].style.display = "block";
          }
          break;
      }
    })
  );
  
}

/*--- Lightbox ---*/

const lightbox = document.createElement('div')
lightbox.id = 'lightbox'
document.body.appendChild(lightbox)

const images = document.querySelectorAll('img')
images.forEach(image => {
  image.addEventListener('click', e => {
    lightbox.classList.add('active')
    const img = document.createElement('img')
    img.src = image.src
    while (lightbox.firstChild) {
      lightbox.removeChild(lightbox.firstChild)
    }
    lightbox.appendChild(img)
  })
})

lightbox.addEventListener('click', e => {
  if (e.target !== e.currentTarget) return
  lightbox.classList.remove('active')
})