
// highlight current day on opeining hours
$(document).ready(function() {
$('.opening-hours li').eq(new Date().getDay()-1).addClass('today');
});


/*
var n = new Date();
var d = n.getDay();

if(d==1) document.getElementById("mon").style.color='#0b0';
if(d==2) document.getElementById("tue").style.color='#0b0';
if(d==3) document.getElementById("wed").style.color='#0b0';
if(d==4) document.getElementById("thu").style.color='#0b0';
if(d==5) document.getElementById("fri").style.color='#0b0';
if(d==6) document.getElementById("sat").style.color='#0b0';
if(d==0) document.getElementById("sun").style.color='#0b0';
*/
