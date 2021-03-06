## Настройка проекта
- `composer install`
- настроить `.env` файл
- `php artisan key:generate`
- использовать дамп БД `dump.sql`

### Пояснение
Миграции сразу не завелись, позже разобрался что проблема в настройке 
config/database.php, 
[надо было добавить](https://stackoverflow.com/questions/49949526/laravel-mysql-migrate-error):
```$php
        'modes'  => [
            'ONLY_FULL_GROUP_BY',
            'STRICT_TRANS_TABLES',
            'NO_ZERO_IN_DATE',
            'NO_ZERO_DATE',
            'ERROR_FOR_DIVISION_BY_ZERO',
            'NO_ENGINE_SUBSTITUTION',
        ],
```
Переделывать уже не стал, поэтому нет миграции для таблицы `status`, 
необходимо развернуть базу из дампа. 

## Техническое задание

#### Обязательно
- Создать страницу на которой выводится текущая температура в Брянске 
(запрос из php) (Работа с api какого-либо сервиса например: 
https://tech.yandex.ru/weather/)

- Создать страницу со списоком заказов в табличном виде
    - поля 
        - ид_заказа 
        - название_партнера 
        - стоимость_заказа 
        - наименование_состав_заказа 
        - статус_заказа
    - ид_заказа - ссылка на редактирование заказа в новой вкладке
- Создать страницу редактирования заказа
    - поля для редактирования:
        - email_клиента(редактирование, обязательное)
        - партнер(редактирование, обязательное)
        - продукты(вывод наименования + количества единиц продукта)
        - статус заказа(редактирование, обязательное)
        - стоимость заказ(вывод)
        - сохранение изменений в заказе

#### Не обязательно (если желаете лучше продемонстрировать свои умения)
- Создать страницу со списком продуктов в табличном виде:
    - поля 
        - ид_продукта 
        - наименование_продукта 
        - наименование_поставщика 
        - цена
    - сортировка по алфавиту по возрастанию
    - пагинация по 25 элементов
    - редактирование цены каждого продукта с помощью ajax запроса
- Дополнительный функционал для страницы списка заказов
    - список заказов разбить на вкладки(bootstrap)
        - владка просроченные
            - дата доставки раньше текущего момента
            - статус заказа 10
            - сортировка по дате доставки по убыванию
            - ограничение 50 штук
        - текущие
            - дата доставки 24 часа с текущего момента
            - статус заказа 10
            - сортировка по дате доставки по возрастанию
        - новые
            - дата доставки после текущего момента
            - статус заказа 0
            - сортировка по дате доставки по возрастанию
            - ограничение 50
        - выполненные
            - дата доставки в текущие сутки
            - статус заказа 20
            - сортировка по дате доставки по убыванию
            - ограничение 50
- Дополнительный функционал для страницы редактирования заказа
    - при установке статуса заказа "завершен" требуется отправить 
    email - партнеру и всем поставщикам продуктов из заказа
        - заказ №(номер) завершен
        - текст состав заказа (список), стоимость заказа (значение)
