import 'flowbite';
import './blocks/reference-grid.js';
import './blocks/calendar.js';
import.meta.glob([
  '../images/**',
  '../fonts/**',
]);
import Swiper from 'swiper';
import { EffectFade, Pagination, Autoplay, Navigation } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/effect-fade';
import 'swiper/css/pagination';
import 'swiper/css/navigation';

document.addEventListener('DOMContentLoaded', () => {
  const nav = document.getElementById('main-nav');
  const navDiv = document.getElementById('nav-div');
  const navLogo = document.getElementById('nav-logo');
  const stickyClass = ['mt-0','bg-white','w-full','shadow-sm'];
  const relaxedClass = ['mt-8'];

  window.addEventListener('scroll', () => {
    if (window.scrollY > 10 || window.innerWidth < 1176) {
      nav.classList.remove(...relaxedClass);
      nav.classList.add(...stickyClass);
      navDiv.classList.remove('shadow-sm');
      navLogo.classList.add('h-10');
      navLogo.classList.remove('h-14');
    } else {
      nav.classList.remove(...stickyClass);
      nav.classList.add(...relaxedClass);
      navDiv.classList.add('shadow-sm');
      navLogo.classList.remove('h-10');
      navLogo.classList.add('h-14');
    }
  });
});




document.addEventListener('DOMContentLoaded', () => {
  new Swiper('.heroSwiper', {
    modules: [EffectFade, Pagination, Autoplay],
    effect: 'fade',
    fadeEffect: {
      crossFade: true, // weicher Übergang
    },
    loop: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    speed: 1000, // Übergangszeit in ms
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
  });
});

document.addEventListener('DOMContentLoaded', () => {
    new Swiper('.partnerSwiper', {
      modules: [Navigation, Autoplay],
      loop: true,
      slidesPerView: 3,
      spaceBetween: 20,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        320:  { slidesPerView: 1 },
        640:  { slidesPerView: 2 },
        1024: { slidesPerView: 3 },
      },
      // Autoplay optional
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
    });
  });