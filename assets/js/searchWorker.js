importScripts('fuse.min.js');

var fuse;

// Определяем функцию для инициализации и поиска
onmessage = function(e) {
    if (e.data.action === 'initialize') {
        // Инициализируем Fuse при получении сообщения 'initialize'
        fuse = new Fuse(e.data.data, {
            keys: ["Obekt", "IT"],
            threshold: 0.4
        });
    } else if (e.data.action === 'search') {
        // Выполняем поиск при получении сообщения 'search'
        var filter = e.data.filter;
        var searchResult = fuse.search(filter);
        postMessage(searchResult);
    }
};
