//COULEURSCROLL//
const navigation = document.querySelector('header');

window.addEventListener('scroll', () => {
  if(window.scrollY > 30){
    navigation.classList.add('anim-header');
  } else {
    navigation.classList.remove('anim-header');
  }
})

//SMOOTHSCROLL//
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});

//ANIMLOGO//
const sr = ScrollReveal();

sr.reveal('.anim1', {
  origin: 'top',
  distance: '50px',
  duration: 1000,
  reset: true,
});


