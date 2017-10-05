# Yii 2 Docker Project Template

Шаблон проекта основанный на Yii2advanced, обёрнутый в Docker.

## Установка

Для работы необходимо установить Docker:

    sudo apt-get remove docker docker-engine
    sudo apt-get update
    sudo apt-key adv --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys 58118E89F3A912897C070ADBF76221572C52609D
    sudo apt-add-repository 'deb https://apt.dockerproject.org/repo ubuntu-xenial main'
    sudo apt-get update
    sudo apt-get install -y docker-engine

Скачать данный репозиторий:

```git clone git@bitbucket.org:germanow/yii-docker-template.git```

Прописать в файле /etc/hosts:

```127.0.0.1	backend```

## Установка Windows

Скачать docker toolbox для win 7 или установщик для windows 10.

Сконфигурировать гит:

```git config --global core.autocrlf false```

Скачать данный репозиторий:

```git clone git@bitbucket.org:germanow/yii-docker-template.git```

Посмотреть ip для docker:

```docker-machine ip```

Прописать в файле /etc/hosts:

```<docker-machine>	backend```

## Запуск

Первый запуск выполняется командой (может занять некоторое время):

```sudo docker-compose up --build```

Последующий запуск выполняется командой

```sudo docker-compose up```

Выключение выполняется командой:

```sudo docker-compose down```

При запуске приложения выполняется установка зависимостей composer и накатывание миграций.

## Использование

Frontend часть доступна по адресу:

```http://mydomain```

Backend часть доступна по адресу:

```http://backend```

Mysql работает на порту 3307, для подключения воспользуйтесь команда:

```mysql -u root -proot --host=127.0.0.1 --port=3307```

Чтобы применить новые миграции:

```docker-compose restart init-app```

Чтобы установить новые зависимости composer:

```docker-compose restart composer```

## Тестирование

Для запуска тестов необходимо, подключиться к онтейнеру для тестов:

```docker exec -it yiidockertemplate_test-app_1 bash```

Для выхода из контейнера используйте команду ```exit```.

Запуск всех тестов:

```vendor/bin/codecept run```

Запуск тестов из ```common/tests```:

```vendor/bin/codecept run -- -c common```

Запуск тестов из ```frontend/tests```:

```vendor/bin/codecept run -- -c frontend```

Запуск тестов из ```backend/tests```:

```vendor/bin/codecept run -- -c backend```

Для более информативного вывода можно использовать флаг ```--debug```, например:

```vendor/bin/codecept run --debug -c backend```

Генерация функциональных тестов для frontend(можно скопировать существующий и переименовать):

```vendor/bin/codecept generate:cest functional TestName -c frontend```
