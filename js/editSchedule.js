function showCreateEvent() {
	console.log("Create event button pressed");
	const createContainer = document.getElementById("create-event-container");
	const editContainer = document.getElementById("edit-event-container");
	if (!editContainer.classList.contains("hide")) {
		editContainer.classList.add("hide");
	}
	createContainer.classList.remove("hide");
}

function clickEvent(element) {
	let id = element.getAttribute("data-id");

	url = `/eventList.php`;
	var request = new XMLHttpRequest();
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			handleEditForm(request.responseText);
		}
	};
	request.open("GET", url + `?id=${id}`, true); // true for asynchronous
	request.send(null);
}

function handleEditForm(jsonArray) {
	if (jsonArray == "null") {
		return;
	}
	let event = JSON.parse(jsonArray);
	console.log(event);

	const createContainer = document.getElementById("create-event-container");
	const editContainer = document.getElementById("edit-event-container");
	const editForm = document.getElementById("edit-event-form");

	if (!createContainer.classList.contains("hide")) {
		createContainer.classList.add("hide");
	}

	for (element of editForm.children) {
		if (element.nodeName == "INPUT") {
			if (element.name == "time") {
				t = event[element.name];
			}
			element.setAttribute("value", event[element.name]);
		} else if (element.nodeName == "SELECT") {
			for (option of element.children) {
				option.removeAttribute("selected");
				if (option.value == event["Day"]) {
					option.setAttribute("selected", "selected");
					break;
				} else if (option.value == event["Event Type"]) {
					option.setAttribute("selected", "selected");
				}
			}
		}
	}

	editContainer.classList.remove("hide");
}

/*
Store events array in session variable
Create extra file to handle sending what's stored in session variable
In clickEvent, create request to retrieve array information
go ham
*/
