

//Сохраняет входные данные пользователя для последующего расчета
var inputs = [""];
//Строка для хранения текущей входной строки
var totalString = [""];
//Массив операторов для проверки без "."
var operators1 = ["+", "-", "/", "*"];
//Массив операторов с символом "." для проверки
var operators2 = ["."];
//Цифры для проверки
var digits = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
//Результат, который рассчитывается после нажатия "="
var resultRegularCalculator;


//Функция добавления значения во входной массив
function getValueNumberSystemCalculator(input) {
	if (totalString.length < 14) {
		inputs.push(input);
		update();
	}
}

//Функция добавления значения во входной массив с проверкой значения
function getValueRegularCalculator(input) {
	if (totalString.length < 14) {
		//Проверка, чтобы входной массив не начинался с оператора
		if (inputs.length === 1 && operators1.includes(input) === false) {
			inputs.push(input);
		}
		//Если последний символ не был оператором, добавляем оператор в массив
		else if (operators1.includes(inputs[inputs.length - 1]) === false) {
			inputs.push(input);
		}
		else if (digits.includes(Number(input))) {
			inputs.push(input);
		}
		update();
	}
}



//Функция, переводящая из 10-ой системы в систему по основанию indexSystem
function getResultNumberSystemCalculator(indexSystem) {
	totalString = inputs.join("");
	var result = [];
	var temporary = totalString;
	var temporary2 = temporary;
	while (temporary2 > 0) {
		temporary = temporary % indexSystem;
		result.push(temporary);
		temporary2 = parseInt(temporary2 / indexSystem);
		temporary = temporary2;
	}
	result = result.join("");
	result = reverseString(result);
	$("#steps2").html(result);
}


//Функция, выводящая итоговое значение на экран (При нажатии "=")
function getResultRegularCalculator() {
	totalString = inputs.join("");
	resultRegularCalculator = eval(totalString);
	totalString = [resultRegularCalculator];
	inputs = [resultRegularCalculator];
	$("#steps").html(resultRegularCalculator);
}

//Функция обновления значения на экране после нажатия 
function update() {
	totalString = inputs.join("");
	$("#steps").html(totalString);
}

//Функция, чтобы инвертировать строку
function reverseString(string) {
	return string.split("").reverse().join("");
}

//Функция возведения в степень числа
function getDegree(index, indexSystem) {
	var temporary = 1;
	for (var i = 1; i < index; i++) {
		temporary = temporary * indexSystem;
	}
	return temporary;
}

