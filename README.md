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

```http://localhost```

Backend часть доступна по адресу:

```http://backend```

Mysql работает на порту 3307, для подключения воспользуйтесь команда:

```mysql -u root -proot --host=127.0.0.1 --port=3307```

Изменения в коде автоматически применяются. 

Чтобы применить новые миграции или установить новые зависимости composer, необходимо остановить и заново запустить приложение.

    sudo docker-compose down
    sudo docker-compose up