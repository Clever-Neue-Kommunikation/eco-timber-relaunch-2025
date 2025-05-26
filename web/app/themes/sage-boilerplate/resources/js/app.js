import 'flowbite';
import.meta.glob([
  '../images/**',
  '../fonts/**',
]);
import Swiper from 'swiper';
import { EffectFade, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/effect-fade';
import 'swiper/css/pagination';

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
      navLogo.classList.add('h-8');
      navLogo.classList.remove('h-10');
    } else {
      nav.classList.remove(...stickyClass);
      nav.classList.add(...relaxedClass);
      navDiv.classList.add('shadow-sm');
      navLogo.classList.remove('h-8');
      navLogo.classList.add('h-10');
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

