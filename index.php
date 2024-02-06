<?php
$accountName = "Алекс";
session_start(); 
$_SESSION['accountName'] = 'Алекс'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Обекти</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <div id="menu">
    <div class="menu-header">
      <span class="menu-name">Menu</span>
      <div id="collapse-button">
        <label class="bar" for="check">
          <input type="checkbox" id="check">
          <span class="top"></span>
          <span class="middle"></span>
          <span class="bottom"></span>
        </label>
      </div>
    </div>
    <h3 class="menu-item-header" onclick="rollList('devices', 'devices-arrow')">УСТРОЙСТВА
      <svg class="arrow rotated" id="devices-arrow" xmlns="http://www.w3.org/2000/svg" width="11" height="6"
        viewBox="0 0 11 6" fill="none">
        <path d="M5.80857 6L0.808594 0H10.8086L5.80857 6Z" fill="#BCBCC6" />
      </svg>
    </h3>
    <ul id="devices" class="rolled">
      <li class="menu-option">Принтери</li>
      <li class="menu-option">Движение техника</li>
      <li class="menu-option">UPS</li>
      <li class="menu-option">ACC PC</li>
      <li class="menu-option">Servers MC</li>
      <li class="menu-option">Servers AP</li>
      <li class="menu-option">Web Access Network Devices</li>
    </ul>
    <hr>
    <h3 class="menu-item-header" onclick="rollList('connection', 'connection-arrow')">СВЪРЗАНОСТ
      <svg class="arrow rotated" id="connection-arrow" xmlns="http://www.w3.org/2000/svg" width="11" height="6"
        viewBox="0 0 11 6" fill="none">
        <path d="M5.80857 6L0.808594 0H10.8086L5.80857 6Z" fill="#BCBCC6" />
      </svg>
    </h3>
    <ul id="connection" class="rolled">
      <li class="menu-option">VPNs</li>
      <li class="menu-option">Clients NetMK</li>
      <li class="menu-option">Wi-Fi</li>
    </ul>
    <hr>
    <h3 class="menu-item-header" onclick="rollList('objects', 'objects-arrow')">ОБЕКТИ
      <svg class="arrow rotated" id="objects-arrow" xmlns="http://www.w3.org/2000/svg" width="11" height="6"
        viewBox="0 0 11 6" fill="none">
        <path d="M5.80857 6L0.808594 0H10.8086L5.80857 6Z" fill="#BCBCC6" />
      </svg>
    </h3>
    <ul id="objects" class="rolled">
      <li class="menu-option">СЕСПА Доклади</li>
      <li class="menu-option">Принтери в обектите</li>
      <li class="menu-option">К5 Трансфер</li>
      <li class="menu-option">Заявки аптеки</li>
      <li class="menu-option">Други</li>
      <li class="menu-option">Покажи данни SRV</li>
    </ul>
    <hr>
    <h3 class="menu-item-header" onclick="rollList('tickets', 'tickets-arrow')">ТИКЕТИ
      <svg class="arrow rotated" id="tickets-arrow" xmlns="http://www.w3.org/2000/svg" width="11" height="6"
        viewBox="0 0 11 6" fill="none">
        <path d="M5.80857 6L0.808594 0H10.8086L5.80857 6Z" fill="#BCBCC6" />
      </svg>
    </h3>
    <ul id="tickets" class="rolled">
      <li class="menu-option">TT - Обекти</li>
      <li class="menu-option">TT - IT</li>
      <li class="menu-option">TT - Други</li>
    </ul>
    <hr>
    <h3 class="menu-item-header" onclick="rollList('actions', 'actions-arrow')">ДЕЙСТВИЯ
      <svg class="arrow rotated" id="actions-arrow" xmlns="http://www.w3.org/2000/svg" width="11" height="6"
        viewBox="0 0 11 6" fill="none">
        <path d="M5.80857 6L0.808594 0H10.8086L5.80857 6Z" fill="#BCBCC6" />
      </svg>
    </h3>
    <ul id="actions" class="rolled">
      <li class="menu-option">Автономни действия</li>
      <li class="menu-option">Движение техника</li>
      <li class="menu-option">Troubleshoot problems</li>
      <li class="menu-option">Смяна парола</li>
    </ul>
  </div>

  <header id="header">
    <div class="header-container">
      <div class="selector-container">
        <label for="table-selector">Выберите вариант:</label>
        <div class="selector-element-container">
          <select size="1" id="table-selector">
            <option value="1">Таблица с суперважной информацией от 22-12-1816 Вариант 1</option>
            <option value="2">Таблица с суперважной информацией от 22-12-1816 Вариант 2</option>
            <option value="3">Таблица с суперважной информацией от 22-12-1816 Вариант 3</option>
            <option value="4">Таблица с суперважной информацией от 22-12-1816 Вариант 4</option>
            <option value="5">Таблица с суперважной информацией от 22-12-1816 Вариант 5</option>
            <option value="6">Таблица с суперважной информацией от 22-12-1816 Вариант 6</option>
            <option value="7">Таблица с суперважной информацией от 22-12-1816 Вариант 7</option>
            <option value="8">Таблица с суперважной информацией от 22-12-1816 Вариант 8</option>
            <option value="9">Таблица с суперважной информацией от 22-12-1816 Вариант 9</option>
          </select>
          <button id="table-selector-button" onclick="confirmSelection()">Подтвердить выбор</button>
        </div>
      </div>
      <div class="user-details">
        <div class="table-button help" onclick="showHelp()">?</div>
        <div class="avatar">AP</div>
        <p class="logged-as-test"> <span id="logged-as">Alex Prokofiev</span></p>
        <div class="logout">
          <svg fill="var(--dark-tone-60)" height="28px" width="28px" version="1.1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 489.9 489.9" xml:space="preserve">
            <path d="M110.7,34.3h128c9.5,0,17.2-7.7,17.2-17.1c0-9.5-7.7-17.2-17.2-17.2h-128C59.4,0,17.6,41.8,17.6,93.1v303.7
        c0,51.3,41.8,93.1,93.1,93.1h125.9c9.5,0,17.2-7.7,17.2-17.1c0-9.5-7.7-17.2-17.2-17.2H110.7c-32.4,0-58.8-26.4-58.8-58.8V93.1
        C52,60.6,78.3,34.3,110.7,34.3z" />
          </svg>
          <svg fill="var(--dark-tone-60)" height="30px" width="30px" version="1.1" id="logout-arrow"
            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 489.9 489.9"
            xml:space="preserve">
            <path d="M468.3,255.8c0.1-0.1,0.1-0.1,0.2-0.2c0.3-0.4,0.6-0.7,0.8-1.1c0.1-0.1,0.1-0.2,0.2-0.3c0.2-0.4,0.5-0.8,0.7-1.2
				c0-0.1,0.1-0.2,0.1-0.2c0.2-0.4,0.4-0.8,0.6-1.3c0-0.1,0-0.1,0.1-0.2c0.2-0.4,0.3-0.9,0.5-1.4c0-0.1,0-0.2,0.1-0.2
				c0.1-0.5,0.3-0.9,0.3-1.4c0-0.2,0-0.3,0.1-0.5c0.1-0.4,0.1-0.8,0.2-1.2c0.1-0.6,0.1-1.1,0.1-1.7c0-0.6,0-1.1-0.1-1.7
				c0-0.4-0.1-0.8-0.2-1.2c0-0.2,0-0.3-0.1-0.5c-0.1-0.5-0.2-0.9-0.3-1.4c0-0.1,0-0.2-0.1-0.2c-0.1-0.5-0.3-0.9-0.5-1.4
				c0-0.1,0-0.1-0.1-0.2c-0.2-0.4-0.4-0.9-0.6-1.3c0-0.1-0.1-0.2-0.1-0.2c-0.2-0.4-0.4-0.8-0.7-1.2c-0.1-0.1-0.1-0.2-0.2-0.3
				c-0.3-0.4-0.5-0.8-0.8-1.1c-0.1-0.1-0.1-0.1-0.2-0.2c-0.4-0.4-0.7-0.9-1.2-1.3l-98.9-98.8c-6.7-6.7-17.6-6.7-24.3,0
				c-6.7,6.7-6.7,17.6,0,24.3l69.6,69.6H136.8c-9.5,0-17.2,7.7-17.2,17.1c0,9.5,7.7,17.2,17.2,17.2h276.8l-69.1,69.1
				c-6.7,6.7-6.7,17.6,0,24.3c3.3,3.3,7.7,5,12.1,5s8.8-1.7,12.1-5l98.3-98.3C467.5,256.6,467.9,256.2,468.3,255.8z" />
          </svg>
        </div>
      </div>
    </div>
  </header>
  <div id="container">

    <div id="table-container">

      <div id="breadcrumbs-container">
        <h1 id="page-title">Objects Table</h1>
        <ul class="breadcrumbs">
          <li class="bc-element">Adminpanel</li>
          <li class="bc-separator"> / </li>
          <li class="bc-element">Objects</li>
          <li class="bc-separator"> / </li>
          <li class="bc-element active">Filtered Objects</li>
        </ul>
      </div>

      <div id="table-rendering-place">
        <div id="table-header">
          <div id="table-info">
            <h2 id="table-title">Database Table</h2>

          </div>
          <div id="table-buttons">
            <div class="table-button" onclick="refreshTable()">
              <svg fill="#000000" height="20px" width="20px" version="1.1" class="table-button-icon" id="refresh-icon"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 489.698 489.698" xml:space="preserve">
                <g>
                  <g>
                    <path d="M468.999,227.774c-11.4,0-20.8,8.3-20.8,19.8c-1,74.9-44.2,142.6-110.3,178.9c-99.6,54.7-216,5.6-260.6-61l62.9,13.1
			c10.4,2.1,21.8-4.2,23.9-15.6c2.1-10.4-4.2-21.8-15.6-23.9l-123.7-26c-7.2-1.7-26.1,3.5-23.9,22.9l15.6,124.8
			c1,10.4,9.4,17.7,19.8,17.7c15.5,0,21.8-11.4,20.8-22.9l-7.3-60.9c101.1,121.3,229.4,104.4,306.8,69.3
			c80.1-42.7,131.1-124.8,132.1-215.4C488.799,237.174,480.399,227.774,468.999,227.774z" />
                    <path d="M20.599,261.874c11.4,0,20.8-8.3,20.8-19.8c1-74.9,44.2-142.6,110.3-178.9c99.6-54.7,216-5.6,260.6,61l-62.9-13.1
			c-10.4-2.1-21.8,4.2-23.9,15.6c-2.1,10.4,4.2,21.8,15.6,23.9l123.8,26c7.2,1.7,26.1-3.5,23.9-22.9l-15.6-124.8
			c-1-10.4-9.4-17.7-19.8-17.7c-15.5,0-21.8,11.4-20.8,22.9l7.2,60.9c-101.1-121.2-229.4-104.4-306.8-69.2
			c-80.1,42.6-131.1,124.8-132.2,215.3C0.799,252.574,9.199,261.874,20.599,261.874z" />
                  </g>
                </g>
              </svg>
            </div>
            <div class="table-button" onclick="goFullScreen('header', 'menu', 'table-rendering-place', 'breadcrumbs-container')">
              <svg xmlns="http://www.w3.org/2000/svg" id="close-icon" class="table-button-icon" viewBox="0 0 24 24"
                width="20" height="24" fill="#484964" stroke="#484964" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <line x1="21" y1="3" x2="3" y2="21"></line>
                <line x1="3" y1="3" x2="21" y2="21"></line>
              </svg>

            </div>
          </div>
        </div>
        <div id="table-header-bottom">
          <div class="filter-container">
            <div id="element-count">Showing <span class="amount-of-objects">10</span> from <span
                class="amount-of-objects">291</span> objects</div>
          </div>
          <div class="group">
            <svg viewBox="0 0 24 24" aria-hidden="true" class="icon">
              <g>
                <path
                  d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                </path>
              </g>
            </svg>
            <input class="input" type="search" id="searchInput" placeholder="Search" />
          </div>

        </div>
        <?php include('backend.php'); ?>
      </div>

    </div>
  </div>
  <script>
  var accountName = <?php echo json_encode($accountName); ?>;
  </script>
  <script src="https://cdn.jsdelivr.net/npm/fuse.js@7.0.0"></script>
  <script src="assets/js/script.js"></script>
</body>

</html>