const swiper = new Swiper('.swiper', {
  direction: 'horizontal',
  loop: true,
  slidesPerView:2,
  spaceBetween: 20,
  // centeredSlides: true,

  grabCursor: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },


});


const goTopBtn = document.querySelector(".go-top");

window.addEventListener("scroll", trackScroll);

goTopBtn.addEventListener("click", goTop);

function trackScroll() {

  const scrolled = window.pageYOffset;
  const coords = document.documentElement.clientHeight;
  if (scrolled > coords) {
    goTopBtn.classList.add("active--show");
  } else {
    goTopBtn.classList.remove("active--show");
  }
}

function goTop() {
  if (window.pageYOffset > 0) {
    window.scrollBy(0, -75); 
    setTimeout(goTop, 0); 
  }
}