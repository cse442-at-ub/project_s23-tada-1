function clickEvent(element) {
	let id = element.getAttribute("data-id");

	let container = document.getElementById("event-form-container");
	let form = document.createElement("form");
	Object.assign(form, {
		method: "POST",
		action: "mySchedule.php",
		className: "edit-form",
	});
	form.appendChild(Object.assign(document.createElement("input"), {}));
	container.appendChild(Object.assign(document.createElement("form")));
}
