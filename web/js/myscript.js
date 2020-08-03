

console.log("name");

var resultAfterSending = false;

var script = document.createElement('script');

script.type = 'text/javascript';

script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js';

document.head.appendChild(script);

window.onload = init;
var stars = document.getElementsByTagName("span");
function init()
{
  var stars = document.getElementsByTagName("span");
  for(var i = 0; i < stars.length; i++)
  {
    stars[i].onclick = doSomething;
  }
}

function doSomething(eventObj)
{
  var star = eventObj.target;
  var result1 = star.id;
  console.log(result1);

  $.ajax({
      type: "GET",
      url: '../rating/vote.html',
      data: {
        slug: slug,
        ip : ip,
        i: result1
      },
      success: function(){
          alert("The vote has been accepted");
          resultAfterSending = true;
          $(".rating").css("pointer-events", "none");
          $(".default").removeClass("default");


          if(result1 == 1){
               $("span#1").addClass("star-active");
          }else if (result1 == 2) {
               $("span#1").addClass("star-active");
               $("span#2").addClass("star-active");
          }else if (result1 == 3) {
               $("span#1").addClass("star-active");
               $("span#2").addClass("star-active");
               $("span#3").addClass("star-active");
          }else if (result1 == 4) {
               $("span#1").addClass("star-active");
               $("span#2").addClass("star-active");
               $("span#3").addClass("star-active");
               $("span#4").addClass("star-active");
          }else if (result1 == 5) {
               $("span#1").addClass("star-active");
               $("span#2").addClass("star-active");
               $("span#3").addClass("star-active");
               $("span#4").addClass("star-active");
               $("span#5").addClass("star-active");
          }
      }
  });



}
