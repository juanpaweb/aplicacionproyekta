//rt accordions 
jQuery(function($){
    $(document).ready(function(){ 
     	$(".rt-toggle .toggle-content").hide(); 
		$(".rt-toggle .open .toggle-content").show();  
     	
     	$(".rt-toggle ol li .toggle-head").click(function(){ 
 
     		if($(this).parent("li").hasClass("open")){ 
	     		$(this).parent("li").removeClass("open").find(".toggle-content").stop().slideUp(300);  
     		}else{
	  	  		$(this).parents("ol").find("li.open").removeClass("open").find(".toggle-content").stop().slideUp(300);  
	  	  		$(this).parent("li").addClass("open").find(".toggle-content").stop().slideDown(300, "easeInQuad");	
	  	  	} 
	 	});
});  
}); 