function getIpsum()
{	
	paragraphs = $("#paragraphs").val();
	startWith = ($("#startWith").attr("checked") == "checked") ? 1 : 0;
	output = $("input:radio[name=output]:checked").val();
	
	//alert("/get/"+paragraphs+"/"+startWith+"/"+output);
	
	$.ajax({
	type: 'GET',
	url: "/get/"+paragraphs+"/"+startWith+"/"+output+"/",
	dataType: "html",
	success: function(html){
	 		 $('#ipsum').html(html);
	 		 $('#ipsum').select();	
	 		 SelectText('ipsum');
	 		 window.location = "#ipsum";		
		},
	error: function(){
	  		alert('Whoa! HTTP bailed! Try again.');
		}
	});
}

function SelectText(element) {
    var doc = document;
    var text = doc.getElementById(element);    
    if (doc.body.createTextRange) {
        var range = document.body.createTextRange();
        range.moveToElementText(text);
        range.select();
    } else if (window.getSelection) {
        var selection = window.getSelection();        
        var range = document.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
    }
}







