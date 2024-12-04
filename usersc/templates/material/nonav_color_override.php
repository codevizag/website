<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet"><div class="background"></div>
<body onload="document.body.style.opacity=1" >
<style media="screen">
      .navbar{
         -webkit-box-shadow: 0 10px 10px -10px rgba(0, 0, 0, 0.35);
         box-shadow: 0 10px 10px -10px rgba(0, 0, 0, 0.35);
         background: -webkit-linear-gradient(90deg, #423f9c 31%, #862359 69%);
         background: -webkit-gradient(linear, left top, right top, color-stop(31%, #423f9c), color-stop(69%, #862359));
         background: -webkit-linear-gradient(left, #423f9c 31%, #862359 69%);
         background: -o-linear-gradient(left, #423f9c 31%, #862359 69%);
         background: linear-gradient(90deg, #423f9c 31%, #862359 69%);}
body{
  font-family: 'Bahamas', Bahamas;
    animation: fadeInAnimation ease 2s ;
    animation-iteration-count: 1; 
    animation-fill-mode: forwards; 
} 
  
@keyframes fadeInAnimation { 
    0% { 
        opacity: 0; 
    } 
    100% { 
        opacity: 1; 
     } 
}
@font-face {
  font-family: bahamas;
  src: url(<?=$us_url_root?>users/fonts/Bahamas.ttf);
}
p,b,h1,h2,h3,h4,u,li,span {
  font-family: Bahamas; 
}
.jumbotron{
	background: rgba(255,255,255,0.1); 
}
footer {
  background-color: #010e28 !important;
}

ul {
 padding:0;
 margin:0
}
li {
 list-style:none
}
a:focus,a:hover {
 text-decoration:none;
 -webkit-transition:.3s ease;
 -o-transition:.3s ease;
 transition:.3s ease
}
a:focus {
 outline:0
}
img {
 max-width:100%
}
p {
 font-size:16px;
 line-height:30px;
 color:#898b96;
 font-weight:300
}
h4 {
 margin:0;
 font-weight:400;
 padding:0;
 color:#fff;
}
a {
 color:#5867dd
}
.no-padding {
 padding:0!important
}
.footer-big {
 padding:105px 0 65px 0
}
.footer-big .footer-widget {
 margin-bottom:40px
}
.footer-big .footer-menu ul li a,.footer-big p,.footer-big ul li {
 color:#898b96
}
.footer-menu {
 padding-left:48px
}
.footer-menu ul li a {
 font-size:15px;
 line-height:32px;
 -webkit-transition:.3s;
 -o-transition:.3s;
 transition:.3s
}
.footer-menu ul li a:hover {
 color:#5867dd
}
.footer-menu--1 {
 width:100%
}
.footer-widget-title {
 line-height:42px;
 margin-bottom:10px;
 font-size:18px
}
.mini-footer {
 background:#192027;
 text-align:center;
 padding:32px 0
}
.mini-footer p {
 margin:0;
 line-height:26px;
 font-size:15px;
 color:#999
}
.mini-footer p a {
 color:#5867dd
}
.mini-footer p a:hover {
 color:#34bfa3
}
.widget-about img {
 display:block;
 margin-bottom:30px
}
.widget-about p {
 font-weight:400
}
.widget-about .contact-details {
 margin:30px 0 0 0
}
.widget-about .contact-details li {
 margin-bottom:10px;
 color: #fff;
}
.widget-about .contact-details li:last-child {
 margin-bottom:0
}
.widget-about .contact-details li span {
 padding-right:12px
}
.widget-about .contact-details li a {
 color:#5867dd
}
@media (max-width:991px) {
 .footer-menu {
  padding-left:0
 }
}
</style>
