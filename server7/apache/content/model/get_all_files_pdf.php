<?php
$files = scandir('../view/files');
if (count($files) <= 2) {
    echo "<h2>Нет загруженных файлов</h2>";
} else {
    echo "<h2>Загруженные файлы</h2>";
    foreach ($files as $file) {
        if ($file != "." and $file != "..") {
            echo "<div class='card'><a class='card-body' href='http://localhost:8081/view/files/" . $file . "' download>" . $file . "</a></div>";
        }
    }
}
