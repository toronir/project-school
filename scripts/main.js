import '../styles/main.scss';
import $ from 'jquery';
import AOS from 'aos';
import slick from 'slick-carousel';
import React from 'react'

import Newsletter from './newsletter';
import reactDom from 'react-dom';


$(() => {
    AOS.init({
        offset: 300
    });

    $('.testimonials--slider').slick({
        nextArrow: $('.fa-chevron-right'),
        prevArrow: $('.fa-chevron-left'),
    });

    reactDom.render(<Newsletter />, document.getElementById("newsletter"));

});

console.log(page);