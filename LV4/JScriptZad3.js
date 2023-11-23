//Class cat for creating objects
class Cat {
	constructor(name, colour, age, gender) {
		this.catname = name;
		this.catcolour = colour;
		this.catage = age;
		this.catgender = gender;
	}
}

//Creating new objects
tiger = new Cat("Garfield", "orange", "4", "male");
micika = new Cat("Meowt", "grey", "2", "female");

//Method for changing the age of the given object
function changeAge(obj, newAge) {
	obj.catage = newAge;
}

//Calling the changeAge method
changeAge(micika, 6);

//Outputting the objects info
document.write(
	"1st cat's name: " +
		tiger.catname +
		"<br>Colour: " +
		tiger.catcolour +
		"<br>Age: " +
		tiger.catage +
		"<br>Gender: " +
		tiger.catgender +
		"<br><br>"
);
document.write(
	"2nd cat's name: " +
		micika.catname +
		"<br>Colour: " +
		micika.catcolour +
		"<br>Age: " +
		micika.catage +
		"<br>Gender: " +
		micika.catgender +
		"<br><br>"
);
