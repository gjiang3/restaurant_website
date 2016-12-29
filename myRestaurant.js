$(function() {
    
  var $img1 = $('#slideshow1 img');   
  var c1 = 0; // counter
  var n1 = $img1.length;
  
  var $img2 = $('#slideshow2 img');   
  var c2 = 0; // counter
  var n2 = $img2.length;
  
  var $img3 = $('#slideshow3 img');   
  var c3 = 0; // counter
  var n3 = $img3.length;
   
  $img1.eq(c1).siblings().hide();
  $img2.eq(c2).siblings().hide();
  $img3.eq(c3).siblings().hide();
    
  $('#previous, #next').click(function(){
     c1 = this.id=='next'? --c1 : ++c1 ;
	 c2 = this.id=='next'? --c2 : ++c2 ;
	 c3 = this.id=='next'? --c3 : ++c3 ;
	 
     $img1.fadeTo(800,0).eq(c1%n1).stop(1).fadeTo(800,1);
	 $img2.fadeTo(800,0).eq(c2%n2).stop(1).fadeTo(800,1);
	 $img3.fadeTo(800,0).eq(c3%n3).stop(1).fadeTo(800,1);
  });  
});


   function myFunction() {
      window.open("contact.html", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=300, left=500, width=400, height=400");
     }

	

     $(window).load(function() {
	         $(".loader").fadeOut(1500);
    })


window.onload = init;

var textArea;
var chooser;
var indexer;
var root;
var nameField;

function init() 
{
	textArea = document.getElementById("textArea");
    chooser  = document.getElementById("chooser");
    indexer  = document.getElementById("indexer");
    root     = document.getElementById("root");
	nameField = document.getElementById("name");
}

function nodeAction()
{
    var count  = root.getElementsByTagName("p").length;	
    var text     = textArea.value;
	var name = nameField.value + ":";
	var nameNode = document.createTextNode(name);
    var textNode = document.createTextNode(text);
	
    var pNode = document.createElement("p");
	 var pNode2 = document.createElement("p");
	pNode.appendChild(nameNode);
	root.appendChild(pNode);
	
    pNode2.appendChild(textNode);

    root.appendChild(pNode2);
    textArea.value = "";

}

