const menuItems = document.querySelectorAll('.menu-item-img-container');

menuItems.forEach(item => {
  const svg = item.querySelector('.menu-item-img');

  item.addEventListener('mouseenter', () => {
    svg.style.fill = '#58419b'; 
  });

  item.addEventListener('mouseleave', () => {
    svg.style.fill = ''; 
  });
});

const checkbox = document.getElementById('check');
const menu = document.getElementById('menu');
const menuName = document.getElementById('menu-name');
const textMenu = document.getElementById('text-menu');
const iconMenu = document.getElementById('icon-menu');

document.addEventListener('DOMContentLoaded', function() {

  checkbox.addEventListener('change', function() {
    if (!this.checked) {
      menu.classList.add('collapsed');
			menuName.classList.add('collapsed');
			textMenu.classList.add('collapsed');
			iconMenu.classList.remove('collapsed');
    } else {
      menu.classList.remove('collapsed');
			menuName.classList.remove('collapsed');
			textMenu.classList.remove('collapsed');
			iconMenu.classList.add('collapsed');
    }
  });
});

function iconClicked (uiID, arrowID) {
  checkbox.checked = !checkbox.checked;
	checkbox.dispatchEvent(new Event('change'));

	var uiList = document.getElementById(uiID);
	var arrow = document.getElementById(arrowID);

	if (uiList.classList.contains('rolled')) {
    uiList.classList.remove('rolled');
		arrow.classList.remove('rotated');
	}
}

function goFullScreen(headerID, menuID, containerID, breadcrumbsID) {
	let header = document.getElementById(headerID);
	let menu = document.getElementById(menuID);
	let container = document.getElementById(containerID);
	let breadcrumbs = document.getElementById(breadcrumbsID)

	if (menu.style.display === 'none') {
		breadcrumbs.style.removeProperty('display');
		header.style.removeProperty('display');
		menu.style.removeProperty('display');
		container.style.removeProperty('marginTop');
		container.style.removeProperty('marginRight');
		container.style.removeProperty('marginBottom');
		container.style.removeProperty('marginLeft');
		container.style.removeProperty('height');
	} else {
		breadcrumbs.style.display = 'none';
		header.style.display = 'none';
		menu.style.display = 'none';
		container.style.marginTop = '17px';
		container.style.marginRight = '10px';
		container.style.marginBottom = '0px';
		container.style.marginLeft = '10px';
		container.style.height = '98vh';
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
