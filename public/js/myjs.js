
var accordionLink = document.getElementsByClassName('mycss')

for (var i = 0; i < accordionLink.length; i++) {
  var elem = accordionLink[i];
  elem.addEventListener('click', function(event) {
    for (var j = 0; j < accordionLink.length; j++)
      accordionLink[j].classList.remove("active")
    this.classList.add('active');
    event.preventDefault();
  }, false);
}
