function apply(element) {
	let query = "id=" + element.getAttribute("data-id");

	location.href = "/jobApplication.php?" + query;
}
