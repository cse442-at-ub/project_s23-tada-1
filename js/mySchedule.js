function selector(selectedClass, selectedType) {
	console.log(`Entered Selector`);
	c = document.getElementById("class-select");
	t = document.getElementById("type-select");
	for (option of c.children) {
		option.removeAttribute("selected");
		if (option.value == selectedClass) {
			console.log(`Found ${selectedClass}`);
			option.setAttribute("selected", "selected");
			break;
		}
	}

	for (option of t.children) {
		option.removeAttribute("selected");
		if (option.value == selectedType) {
			console.log(`Found ${selectedType}`);
			option.setAttribute("selected", "selected");
			return;
		}
	}
}
