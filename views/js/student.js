function filterSearch(){
	var value = $("#search_text").val().toLowerCase();
	$("#studentListing tbody tr").filter(function(){
		$(this).toggle($(this).text().toLowerCase().indexOf(value)>-1)
	});
}

// Provide missing JS code here for double clicking on table row
$("#studentListing tbody tr").dblclick(function(){
	var idStudent = $(this).attr("idStudent");
	student_fullname = this.cells[0].innerHTML + ', ' + this.cells[1].innerHTML;
	$("#search_text").val(student_fullname);
	window.location = "index.php?route=studentupdate&idStudent="+idStudent;
});

	


