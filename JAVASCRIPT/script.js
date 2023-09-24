// let hamMenuIcon = document.getElementById("ham-menu");
// let navBar = document.getElementById("nav-bar");
// let navLinks = navBar.querySelectorAll("li");

// hamMenuIcon.addEventListener("click", () => {
//   navBar.classList.toggle("active");
//   hamMenuIcon.classList.toggle("fa-times");
// });
// navLinks.forEach((navLinks) => {
//   navLinks.addEventListener("click", () => {
//     navBar.classList.remove("active");
//     hamMenuIcon.classList.toggle("fa-times");
//   });
// });


$('.navTrigger').click(function () {
  $(this).toggleClass('active');
  console.log("Clicked menu");
  $("#mainListDiv").toggleClass("show_list");
  $("#mainListDiv").fadeIn();

});


// Example JavaScript code
console.log('Hello, world!');



 //Scroling cards

 // Calculate the width of each card
const cardWidth = document.querySelector('.Scard').offsetWidth;

// Calculate the number of visible cards
const visibleCards = Math.floor(document.querySelector('.scrolling-Scards-container').offsetWidth / cardWidth);

// Get the scrolling container
const scrollingContainer = document.querySelector('.scrolling-Scards');

// Get the right and left arrow buttons
const rightArrow = document.querySelector('.right-arrow');
const leftArrow = document.querySelector('.left-arrow');

// Set the initial scroll position
let scroll



// Course Cards in Home

// Code for smooth scrolling when clicking on button
$('button').click(function() {
  $('html, body').animate({
    scrollTop: $('#course').offset().top
  }, 1000);
});


