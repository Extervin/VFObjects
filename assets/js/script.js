function quickSort(arr, columnIndex) {
	if (arr.length <= 1) {
			return arr;
	}

	const pivotIndex = Math.floor(arr.length / 2);
	const pivot = arr[pivotIndex].getElementsByTagName("td")[columnIndex];

	const left = [];
	const right = [];

	for (let i = 0; i < arr.length; i++) {
			if (i !== pivotIndex) {
					const cell = arr[i].getElementsByTagName("td")[columnIndex];

					if (cell) {
							const value = cell.innerHTML.toLowerCase();
							if (value < pivot.innerHTML.toLowerCase()) {
									left.push(arr[i]);
							} else {
									right.push(arr[i]);
							}
					}
			}
	}

	return quickSort(left, columnIndex).concat([arr[pivotIndex]], quickSort(right, columnIndex));
}

function sortTable(columnIndex) {
	const table = document.getElementById("databaseTable");
	const rows = Array.from(table.rows);

	const sortedRows = quickSort(rows, columnIndex);

	for (let i = 0; i < sortedRows.length; i++) {
			table.appendChild(sortedRows[i]);
	}
}



let changeAllowed = true;

function rollList(uiID, arrowID) {
	var uiList = document.getElementById(uiID);
	var arrow = document.getElementById(arrowID);

	if (!uiList.classList.contains('rolled')) {
  	uiList.classList.add('rolled');
		arrow.classList.add('rotated');
	} else {
    uiList.classList.remove('rolled');
		arrow.classList.remove('rotated');
	}
}

var searchData;
var searchWorker = new Worker('assets/js/searchWorker.js');

// Загрузка данных с сервера
function loadData() {
    return fetch('search.php')
        .then(response => response.json())
        .then(data => {
            searchData = data;

            // Инициализируем воркер после загрузки данных
            searchWorker.postMessage({ action: 'initialize', data: searchData });
        })
        .catch(error => console.error('Ошибка загрузки данных:', error));
}

// Вызываем функцию загрузки данных при загрузке страницы
window.onload = function() {
    loadData();
};

const input = document.getElementById("searchInput");
const table = document.getElementById("databaseTable");
const rows = table.getElementsByTagName("tr");

// Обработчик события input для строки поиска
input.addEventListener('input', function() {
    const filter = input.value.toUpperCase();

    // Отправляем запрос в веб-воркер
    searchWorker.postMessage({ action: 'search', filter });

    // Обрабатываем результаты поиска в основном скрипте
    searchWorker.onmessage = function(event) {
        const searchResults = event.data;

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td")[2];
            if (cells) {
                const cellText = cells.textContent;
                // Показываем все строки, если фильтр пустой
                if (filter === "") {
                    rows[i].style.display = "";
                } else {
                    // Скрываем или показываем строки в зависимости от результатов поиска
                    rows[i].style.display = searchResults.some(result => result.item.Obekt === cellText) ? "" : "none";
                }
            }
        }
    };
});



function closeTable() {
	// Код закрытия таблицы
}

function refreshTable() {
	// Код обновления таблицы
}

function showHelp() {
	// Код отображения справки
}

function showFilters() {
	// Код отображения фильтров
}

// Функция для отправки асинхронного запроса на сервер
function sendRequest(action, col, id, spanId, buttonId, callback) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
			var span = document.getElementById(spanId);
			if (this.readyState == 4 && this.status == 200) {

					if (this.response === 'success') {
							// Добавляем класс с плавным изменением цвета фона для успешного обновления
							span.classList.add('highlight-success');

							// Убираем класс через некоторое время (например, через 1.5 секунды)
							setTimeout(function() {
									span.classList.add('highlight-blank');
									setTimeout(function() {
											span.classList.remove('highlight-success');
											span.classList.remove('highlight-blank');
									}, 100);
							}, 1000);
							console.log(this.response);
							callback(true);
					} else {
							// Добавляем класс с плавным изменением цвета фона для ошибки обновления
							span.classList.add('highlight-error');

							// Убираем класс через некоторое время (например, через 1.5 секунды)
							setTimeout(function() {
									span.classList.add('highlight-blank');
									setTimeout(function() {
											span.classList.remove('highlight-error');
											span.classList.remove('highlight-blank');
									}, 100);
							}, 1000);

							console.error(this.response);
							callback(false);
					}
			}
	};

	// Формирование и отправка запроса
	xhttp.open("POST", "backend.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action + "&id=" + id + "&column=" + col);
}

// Функция для обработки клика на span
function changeText(spanId, buttonId) {
	// Получение id
	var col = spanId.split("_")[0];
	var id = spanId.split("_")[2];

	var span = document.getElementById(spanId);
	var button = document.getElementById(buttonId);

	if (span.classList.contains('click')) {
		// Вызов функции на сервере для обновления значения
		sendRequest('changeText', col, id, spanId, buttonId, function(success) {
				if (success) {
						// Обновление интерфейса (можете добавить свою логику)
						span.innerHTML = accountName;
						span.classList.remove('click');
						button.classList.remove('hidden');
				}
		});
	}
}

// Функция для обработки клика на кнопку
function clearText(spanId, buttonId) {
	// Получение id
	var col = spanId.split("_")[0];
	var id = spanId.split("_")[2];

	// Вызов функции на сервере для обновления значения
	sendRequest('clearText', col, id, spanId, buttonId, function(success) {
			if (success) {
					// Обновление интерфейса (можете добавить свою логику)
					var span = document.getElementById(spanId);
					var button = document.getElementById(buttonId);
					span.innerHTML = "Click";
					span.classList.add('click');
					button.classList.add('hidden');
			}
	});
}