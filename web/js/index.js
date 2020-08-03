
console.log("Script is working!");

var script = document.createElement('script');

script.type = 'text/javascript';

script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js';

document.head.appendChild(script);

window.onload = init;

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
          // document.getElementById("rating").setAttribute("class", "style1");
      }
  });

location.replace('http://localhost/basic/web/page/'+slug+'.html');

}
