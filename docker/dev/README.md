# Docker dev

Основные контейнер ```mysql```,```nginx```, ```php-fpm```.

Контейнеры для тестов ```nginx-test```, ```test-app```, ```selenium```. 

Вспомогательные ```composer``` и ```init-app``` запускаются один раз и умирают сразу после выполнения своих функций.

Для тестов необходимо подключиться к ```test-app```, он находится все время в спящем режиме скриптом ```idle.sh```.

Composer накатывает зависимости из composer.(json/lock) . 

Init-app запускает скрипт init для advanced и накатывает миграции. 

Для инициализации базы используется ```dbinit.sql```. 