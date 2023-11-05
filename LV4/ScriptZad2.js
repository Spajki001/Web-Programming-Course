//Declaration of main variables
const GreetingButton = document.getElementById("Greeting");
const CheckButton = document.getElementById("Check");
const SquaringButton = document.getElementById("SquaringButton");
var ResultField = document.getElementById("ResultField");
const SubjectsButton = document.getElementById("SubjectsButton");
const ClearButton = document.getElementById("ClearButton");

//Event listeners
GreetingButton.addEventListener("dblclick", () => {
	Greeting();
});

CheckButton.addEventListener("click", () => {
	Validation();
});

SquaringButton.addEventListener("click", () => {
	Squaring();
});

ClearButton.addEventListener("mouseenter", () => {
	Clearing();
});

SubjectsButton.addEventListener("mouseup", () => {
	SubjectsList();
});

//Functions
function Greeting() {
	console.log("A double click has been performed!");

	//Outputting 5 alerts with "remaining alerts" counter
	var i = 5;
	for (i; i > 0; i--) {
		alert("Alerts left: " + (i - 1));
	}
}

function Validation() {
	const EmailField = document.getElementById("EmailField").value;
	const emailRegex = /^[a-zA-Z0-9._%+-]{2,}@([a-zA-Z0-9.-]{2,}\.[a-zA-Z]{2,})$/;
	console.log("A validation has been performed!");

	//Checking if the FnameLname field is empty
	if (document.getElementById("FnameLname").value == "") {
		alert("Name and surname field can't be empty!");
	}

	//Checking the email address validity
	if (!EmailField.match(emailRegex)) {
		alert(
			"Email adresa nije ispravna. Molimo provjerite sljedeće uvjete:\n\n- Minimalno 2 znaka prije @\n- Postojanje znaka @\n- Minimalno 2 znaka nakon @\n- Postojanje točke nakon @\n- Najmanje dva znaka nakon točke."
		);
	}

	//Checking if the OutputArea has more than 30 chars
	OutputAreaText = document.getElementById("OutputArea").value;
	if (OutputAreaText.length > 30) {
		alert("Output area has more than 30 characters!");
	}

	//Opening a final windows if everything is correct
	if (
		document.getElementById("FnameLname").value != "" &&
		EmailField.match(emailRegex)
	) {
		Name = document.getElementById("FnameLname").value.split(" ")[0];
		Surname = document.getElementById("FnameLname").value.split(" ")[1];
		let text =
			"Your name is: " +
			Name +
			"\nYour surname is: " +
			Surname +
			"\nYour email address is: " +
			EmailField;
		confirm(text);
	}
}

function Squaring() {
	const NumberPwr = document.getElementById("NumberPwr").value;
	console.log("Squaring has been performed!");

	//Checking if the number is in the [1, 10] interval
	if (NumberPwr < 1 || NumberPwr > 10) {
		alert("Number has to be between 1 and 10!");
	} else ResultField.innerText = NumberPwr * NumberPwr;
}

function Clearing() {
	console.log("Clearing has been performed!");

	//Clearing the OutputArea
	document.getElementById("OutputArea").value = "";
}

function SubjectsList() {
	console.log("Subjects output has been performed!");
	const subjects = [
		"Mathematics",
		"English",
		"Physics",
		"Program Engineering",
		"Web Programming",
		"Economics and Management",
		"Digital Communications",
		"Algorithms and Data structures",
	];

	//Outputting subjects list
	for (var subject_id in subjects) {
		document.getElementById("OutputArea").value += "Subject no. " + subject_id;
		document.getElementById("OutputArea").value +=
			": " + subjects[subject_id] + "\n";
	}
}
