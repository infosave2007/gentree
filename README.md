# gentree
Разбор CSV и формирование JSON tree
# Gentree

## Установка

1. Установите composer: `https://getcomposer.org/download/`
2. В директории проекта выполните команду: `composer install`

## Запуск

1. Создайте объект Gentree: `$gentree = new Gentree\CsvReader::read('path/to/input.csv'));`
2. Генерируйте JSON дерево: `$jsonTree = $gentree->generateJsonTree();`
3. Сохраните JSON файл: `file_put_contents('path/to/output.json', $jsonTree);`

## Запуск тестов

1. В директории проекта выполните команду: `./vendor/bin/phpunit tests`
