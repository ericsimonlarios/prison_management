var slideIndex = 1;
var slide=0;
var imgArray=["background-image.jpg","background-image-2.jpg", "background-image-3.jpg"];
var timeout;
imgLoop();

function moveImg(n){  
    showImg(slideIndex += n)
   if(n<0){
       slide-=2;
       clearTimeout(timeout)
   }else{
       clearTimeout(timeout)   
   }
   imgLoop();
   
}
function changeImg(n){
    showImg(slideIndex = n)
    slide=n;
}
function showImg(n){
    var dots = document.getElementsByClassName("flickity-dots");
<<<<<<< HEAD
    if(n > dots.length){
=======
    if(n > imgArray.length){
>>>>>>> a51f882f0fe69907ed5af80bb530516da83659bf
        slideIndex = 1;
        n = slideIndex;
    }
    if (n <= 0){
        slideIndex = 3;
        n = slideIndex;
    }
<<<<<<< HEAD
    for(var i=0; i < dots.length; ++i){
        dots[i].className = dots[i].className.replace("current-img", " ");    
    }
    for (var j=0; j<=dots.length; j++){
        if(j == n-1){
            dots[j].classList.add("current-img");
=======
   
    for (var j=0; j<=imgArray.length; j++){
        if(j == n-1){
>>>>>>> a51f882f0fe69907ed5af80bb530516da83659bf
            document.getElementById("img-slide-show").src=imgArray[j];
            break;
        }
    }
    
}
<<<<<<< HEAD
function imgLoop(){
    var dots = document.getElementsByClassName("flickity-dots");
   
    if(slide < 0){
        slide = 2;
    }
    if(slide > dots.length){
        slide = dots.length;
    }
    if(slide == dots.length){
        slide = 0;
    }
    for(var i=0; i < dots.length; ++i){
        dots[i].className = dots[i].className.replace("current-img", " ");    
    }
    for (var j=0; j<=dots.length; j++){
        if(j == slide){
            dots[j].classList.add("current-img");
=======
function imgLoop(){  
    if(slide < 0){
        slide = 2;
    }
    if(slide > imgArray.length){
        slide = imgArray.length;
    }
    if(slide == imgArray.length){
        slide = 0;
    }
   
    for (var j=0; j<=imgArray.length; j++){
        if(j == slide){
>>>>>>> a51f882f0fe69907ed5af80bb530516da83659bf
            document.getElementById("img-slide-show").src=imgArray[j];
            break;
        }
    }
    ++slide; 
    timeout = setTimeout(imgLoop, 3000);
}