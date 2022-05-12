<?php
require ('tool.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Тестовое задание - Кондратьева</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="script.js"></script>
</head>

<body>
    <header class="main-header">
        <h1 class="visually-hidden">Отдел кадров</h1>
    </header>
    <div class="main-content">
        <main class="content">
            <div class="form_radio_btn">
                <input type="radio" id="menu1" name="menu" value="1">
                <label for="menu1" class="">
                    <p>Испытательный срок</p>
                </label>
            </div>
            <div class="form_radio_btn">
                <input type="radio" id="menu2" name="menu" value="2">
                <label for="menu2" class="">
                    <p class="">Уволенные</p>
                </label>
            </div>
            <div class="form_radio_btn">

                <input type="radio" id="menu3" name="menu" value="3">
                <label for="menu3" class="">
                    <p class="">Начальники</p>
                </label>
                <div class="check1">
                    <div class="inside"></div>
                </div>
            </div>
            <div>
                <table id="result">

                </table>
            </div>

        </main>
    </div>
    <footer class="main-footer"></footer>
</body>

</html>
