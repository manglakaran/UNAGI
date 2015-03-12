function clickEdit() {
	var parent = $(this).parent();
	parent.children('td').each(function () {
	if(this.className == 'field')
	    $(this).replaceWith("<td class='field'><input value='" + $(this).html() +"' required></td>");
	});
	$(this).html("<button>Update</button>");
	$(this).removeClass("edit");
	$(this).addClass("update");
	$(this).off("click");
	$(this).click(clickUpdate);
}
function clickUpdate() {
	var parent = $(this).parent();
	parent.children('td').each(function () {
	if(this.className == 'field')
	  $(this).html($(this).children().first().val());
	});
	$(this).html("<button>Edit</button>");
	$(this).removeClass("update");
	$(this).addClass("edit");
	$(this).off("click");
	update(parent); //updates customer in db
	$(this).click(clickEdit);
}
function onClickEdit (td_element) {        
  	$(".edit").click(clickEdit);
}
