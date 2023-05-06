// When the create event button is pressed, the edit form if it's showing
// Then show the crete form
function showCreateEvent() {
	const createContainer = document.getElementById("create-event-container");
	const editContainer = document.getElementById("edit-event-container");
	if (!editContainer.classList.contains("hide")) {
		editContainer.classList.add("hide");
	}
	createContainer.classList.remove("hide");
}

// When an event is clicked, send a request to the server for an array of the event information
function clickEvent(element) {
	let id = element.getAttribute("data-id");

	url = `eventHandle.php`;
	var request = new XMLHttpRequest();
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			handleEditForm(request.responseText);
		}
	};
	request.open("GET", url + `?id=${id}`, true); // true for asynchronous
	request.send(null);
}

// Handles the event array returned by the server
// First hide the create form if it's showing
// Fill out the sections of the form with the information in the array
// Show edit form
function handleEditForm(jsonArray) {
	if (jsonArray == "null") {
		return;
	}
	let event = JSON.parse(jsonArray);

	const createContainer = document.getElementById("create-event-container");
	const editContainer = document.getElementById("edit-event-container");
	const editForm = document.getElementById("edit-event-form");

	if (!createContainer.classList.contains("hide")) {
		createContainer.classList.add("hide");
	}

	// For each element in the form
	for (element of editForm.children) {
		if (element.nodeName == "INPUT") {
			// If the form is an input, set the value to the corresponding information
			if (element.name == "Time") {
				i = String(event["Time"]).indexOf(":");
				element.setAttribute("value", event["Time"].slice(0, i));
			} else {
				element.setAttribute("value", event[element.name]);
			}
		} else if (element.nodeName == "SELECT") {
			// If the element is a select statement, deselect all options and select the matching option
			for (option of element.children) {
				option.removeAttribute("selected");
				if (option.value == event["Day"]) {
					option.setAttribute("selected", "selected");
				} else if (option.value == event["Event Type"]) {
					option.setAttribute("selected", "selected");
				}
			}
		}
	}

	editContainer.classList.remove("hide");
}
