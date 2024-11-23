<?php
include('../includes/config.php');

// Функции для генерации случайного имени и фамилии с учетом пола

// Генерация имени и фамилии для женского пола
function generateFemaleName() {
    $firstNames = ['Мария', 'Екатерина', 'Анна', 'Ольга', 'Елена', 'Виктория', 'Дарина', 'Ирина'];
    $lastNames = ['Иванова', 'Смирнова', 'Кузнецова', 'Попова', 'Васильева', 'Петрова', 'Соколова', 'Михайлова', 'Фёдорова'];
    return $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
}

// Генерация имени и фамилии для мужского пола
function generateMaleName() {
    $firstNames = ['Александр', 'Иван', 'Дмитрий', 'Сергей', 'Михаил', 'Олег', 'Владимир', 'Роман', 'Константин'];
    $lastNames = ['Иванов', 'Смирнов', 'Кузнецов', 'Попов', 'Васильев', 'Петров', 'Соколов', 'Михайлов', 'Фёдоров'];
    return $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
}

// Проверка, был ли отправлен запрос формы
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['authorCount'])) {
    $authorCount = (int) $_POST['authorCount'];

    if ($authorCount > 0) {
        try {
            // SQL-запрос для вставки данных
            $sql = "INSERT INTO authors (AuthorName) VALUES (:authorName)";
            $stmt = $dbh->prepare($sql);

            // Генерация и добавление авторов
            for ($i = 0; $i < $authorCount; $i++) {
                // Случайным образом выбираем пол (0 - женский, 1 - мужской)
                $gender = rand(0, 1);
                if ($gender === 0) {
                    // Женский автор
                    $authorName = generateFemaleName();
                } else {
                    // Мужской автор
                    $authorName = generateMaleName();
                }
                $stmt->execute([':authorName' => $authorName]);
            }

            echo "<p>Успешно добавлено $authorCount авторов.</p>";

        } catch (PDOException $e) {
            echo "<p>Ошибка: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>Количество авторов должно быть больше 0.</p>";
    }
} else {
    // Форма для ввода количества авторов
    echo '
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Добавить авторов</title>
    </head>
    <body>
        <h1>Добавление авторов в базу данных</h1>
        <form action="add_authors.php" method="POST">
            <label for="authorCount">Количество авторов:</label>
            <input type="number" id="authorCount" name="authorCount" min="1" required>
            <button type="submit">Добавить</button>
        </form>
    </body>
    </html>';
}
