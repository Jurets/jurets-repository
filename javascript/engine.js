// JavaScript Document
$(document).ready(function() {

$("#open-close").click(        
   function(){
        $(this).toggleClass("active");
        
        $("ul.navigation").toggle(); 
         return false;
   },
   function(){
         $(this).toggleClass("active");
       
         $("ul.navigation").toggle(); 
         return false;        
    }        
 ); 
  
    


});




