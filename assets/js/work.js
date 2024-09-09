$(document).ready(function(){
	var class_array = ['sale','book','fob','plus','code','description','q-note','i-note','weight','offer','total','pm-quote','pmw-quote','pmwa-note','crm-note'];
	$("#add_new").on("click",function(){
		var html = "<tr>";
		for(var i=0;i<class_array.length;i++)
		{
			html+="<td><input type='text' class = 'form-control "+class_array[i]+"'></td>";
		}
		html += "</tr>";
		$("#table_body").after(html);
	})

	$("#save").on("click",function(){
		var quote = [];
	    var quote_array = $(".description");
	    quote_array.each(function(index,element){
	        quote[index] = $(element).val();
	    })

	    var pm_quote = $(".pm-quote").val();

	})
})