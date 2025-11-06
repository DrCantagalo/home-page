import gsap from "gsap";
import $ from 'jquery';

$(function(){
  randomColorWithComplement();
  var tl = gsap.timeline({delay: 1}),
    firstBg = document.querySelectorAll('.text__first-bg'),
    secBg = document.querySelectorAll('.text__second-bg'),
    word = document.querySelectorAll('.text__word');
  tl
    .to(firstBg, {duration: 0.2, scaleX:1})
    .to(secBg, {duration: 0.2, scaleX:1})
    .to(word, {duration: 0.1, opacity:1}, "-=0.1") 
    .to(firstBg, {duration: 0.2, scaleX:0})
    .to(secBg, {duration: 0.2, scaleX:0});
});

function randomColorWithComplement() {
  const r = Math.floor(Math.random() * 256);
  const g = Math.floor(Math.random() * 256);
  const b = Math.floor(Math.random() * 256);
  const compR = 255 - r;
  const compG = 255 - g;
  const compB = 255 - b;
  const toHex = (value) => value.toString(16).padStart(2, "0");
  const color = "rgb(" + r + ", " + g + ", " + b + ")";
  const complement = "rgb(" + compR + ", " + compG + ", " + compB + ")";
  $('.text__first-bg').css('background-color', color);
  $('.text__second-bg').css('background-color', complement);
}





