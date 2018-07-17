# name-functions

Небольшая библиотека на PHP для операций над русскими ФИО.
Основные возможности - разбиение ФИО на части, соединение в одну
строку и валидация.

## Подключение в проект

Через composer. Добавьте в список `repositories` в composer.json:
```
{
    "type": "vcs",
    "url":  "https://gitlab.eterfund.ru/youngreaders/name-functions.git"
}
```
И в `dependencies`:
```
    "youngreaders/name-functions": "dev-master"
```
Выполните:
```
$ composer update
```

Дальше библиотеку можно подключить стандартным способом через autoload.

## Использование
Функции:
- `joinName ($parts, $format)` - объединяет части имени в соответствии с $format. Эта функция
не использует сервис подсказок dadata.
  - $parts - объект с полями surname, name и patronymic.
  - $format - по умолчанию равен "SNP" - Surname, Name, Patronymic или Фамилия, Имя, Отчество.
- `splitName ($client, $name)` - разбивает имя $name на части, используя клиент подсказок
$client. Возвращает объект с четырьмя полями: name, surname, patronymic и gender, где gender равен либо MALE, либо FEMALE.
  - $client - объект SuggestClient.
  - $name - строка с полным ФИО.
- `validateName ($client, $name, $format)` - проверяет имя $name на соответствие формату
$format.
  - $client - объект SuggestClient.
  - $name - строка с полным ФИО.
  - $format - по умолчанию равен "SNP" - Surname, Name, Patronymic или Фамилия, Имя, Отчество.
- `checkSplit ($name, $parts)` - проверяет, что подсказки не изменили, не удалили и не
добавили ни одного слова из $name.
  - $name - строка с полным ФИО.
  - $parts - объект с полями surname, name и patronymic.

Класс SuggestClient предоставляет интерфейс для доступа к сервису подсказок dadata. 
Создание экземпляра:
```
$client = new SuggestClient(
    new GuzzleHttp\Client(), 
    '<token>'
);
```
где `<token>` - ключ API Dadata.

Метод один:
```
$client->suggestName('Иванов Иван Иванович');
```

Возвращает массив вариантов разбиения имени (см. `splitName`)

## Запуск тестов
В склонированном репозитории:
```
$ composer install
$ vendor/bin/phpunit --bootstrap vendor/autoload.php test
```

