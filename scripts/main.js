import '../styles/main.scss';
import $ from 'jquery';
import AOS from 'aos';
import slick from 'slick-carousel';
import React from 'react'

import reactDom from 'react-dom';
import Contact from './contact';


$(() => {
    AOS.init({
        offset: 300
    });

    $('.testimonials--slider').slick({
        nextArrow: $('.fa-chevron-right'),
        prevArrow: $('.fa-chevron-left'),
    });

    reactDom.render(<Contact />, document.getElementById("contact"));

});

console.log(page);