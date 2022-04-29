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
    if(n > imgArray.length){
        slideIndex = 1;
        n = slideIndex;
    }
    if (n <= 0){
        slideIndex = 3;
        n = slideIndex;
    }
   
    for (var j=0; j<=imgArray.length; j++){
        if(j == n-1){
            document.getElementById("img-slide-show").src=imgArray[j];
            break;
        }
    }
    
}
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
            document.getElementById("img-slide-show").src=imgArray[j];
            break;
        }
    }
    ++slide; 
    timeout = setTimeout(imgLoop, 3000);
}