importScripts('fuse.min.js');

var fuse;

// Определяем функцию для инициализации и поиска
onmessage = function(e) {
    if (e.data.action === 'initialize') {
        // Инициализируем Fuse при получении сообщения 'initialize'
        fuse = new Fuse(e.data.data, {
            keys: ["Obekt", "IT"],
            threshold: 0.4,
            includeMatches: true, // Включаем поиск по кириллице
            ignoreLocation: true // Игнорируем местоположение для точного совпадения
        });
    } else if (e.data.action === 'search') {
        // Выполняем транслитерацию текста, если он введен на латинице
        var filter = e.data.filter;
        var transliteratedFilter = transliterateLatinToCyrillic(filter);

        // Выполняем поиск с использованием транслитерированного фильтра
        var searchResult = fuse.search(transliteratedFilter);

        postMessage(searchResult);
    }
};

// Функция для транслитерации текста с латиницы на кириллицу
function transliterateLatinToCyrillic(text) {
    var transliterationMap = {
        'a': 'а',
        'b': 'б',
        'c': 'ц',
        'd': 'д',
        'e': 'е',
        'f': 'ф',
        'g': 'г',
        'h': 'х',
        'i': 'и',
        'j': 'ж',
        'k': 'к',
        'l': 'л',
        'm': 'м',
        'n': 'н',
        'o': 'о',
        'p': 'п',
        'q': 'кю',
        'r': 'р',
        's': 'с',
        't': 'т',
        'u': 'у',
        'v': 'в',
        'w': 'в',
        'x': 'кс',
        'y': 'й',
        'z': 'з',
        // Добавьте остальные соответствия по необходимости
    };

    // Проходим по каждой букве и выполняем замену
    return text.toLowerCase().split('').map(function(char) {
        return transliterationMap[char] || char;
    }).join('');
}
