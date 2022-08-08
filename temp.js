
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
    if(n > imgArray.length){
        slideIndex = 1;
        n = slideIndex;
    }
    if (n <= 0){
        slideIndex = 3;
        n = slideIndex;
    }
    for(var i=0; i < imgArray.length; ++i){
        imgArray[i].className = imgArray[i].className.replace("current-img", " ");    
    }
    for (var j=0; j<=imgArray.length; j++){
        if(j == n-1){
            imgArray[j].classList.add("current-img");
            document.getElementById("img-slide-show").src=imgArray[j];
            break;
        }
    }
    
}
function imgLoop(){
    var imgArray = document.getElementsByClassName("flickity-imgArray");
   
    if(slide < 0){
        slide = 2;
    }
    if(slide > imgArray.length){
        slide = imgArray.length;
    }
    if(slide == imgArray.length){
        slide = 0;
    }
    for(var i=0; i < imgArray.length; ++i){
        imgArray[i].className = imgArray[i].className.replace("current-img", " ");    
    }
    for (var j=0; j<=imgArray.length; j++){
        if(j == slide){
            imgArray[j].classList.add("current-img");
            document.getElementById("img-slide-show").src=imgArray[j];
            break;
        }
    }
    ++slide; 
    timeout = setTimeout(imgLoop, 3000);
}