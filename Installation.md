# Установка
## Linux и Windows на одном диске
Устанавливаем Windows без подключенного интернета
При установке Linux подключаем интернет с Live-USB
Порядок boot: 1) Linux USB 2) HDD, с установленной Windows 3) Windows boot loader
Обязательно ставьте пароли на учетные записи

## Google Chrome
[Устанавливаем Google Chrome](https://www.google.ru/chrome/)

## GitHub
[Регистрируемся в GitHub](https://github.com/)

## SSH key
Создать ssh ключ, ссылка здесь:

GitHub.com -> настройки профиля -> ssh keys -> generate one (Нужен ED25519 SSH)

## Git
Установка git, в консоле пишем:

Mac OS:

`/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install.sh)"`

`brew install git`

Linux:

`sudo apt install git`

Настройка git:

Глобальные настройки Git для Linux и Mac OS,
где имена меняем на свои и почту меняем на ту, на которую регали gitlab:

`git config --global user.name "Петр Иванов"`

`git config --global user.email "petr@CloudCrmWeb.cam"`

## Toolbox App
[Устанавливаем Toolbox App](https://www.jetbrains.com/toolbox-app/)

## PhpStorm
Устанавливаем через Toolbox App

## PhpStorm Plugins
- .env files support
- .ignore
- Ideolog
- Material Theme UI
- Php Inspections (EA Extended)
- Yii2 Inspections
- Yii2 Support
- Недостающие плагины находятся в "Phpstorm" по File/settings/plugins

## Docker and Docker Compose
По этой статье ставим докер:

Mac:
- https://docs.docker.com/docker-for-mac/install/

Linux:

- https://docs.docker.com/engine/install/ubuntu/
- https://docs.docker.com/compose/install/
- После установки в терминале прописываем команду:
  "sudo usermod -aG docker $USER"
  (вместо $USER пишем свой никнейм)
  после этого завершаем сеанс работы с ОС и заходим снова в свою учетную запись ОС.
  Лучше перезагрузи компьютер, на Ubuntu завершение сеанса было недостаточно.

## Установка проекта

В консоль пишем:

Mac:

`cd /Users/<user>/PhpstormProjects/`

Linux:

`cd /home/<user>/PhpstormProjects/`

Общее:

Создадим папку проекта:

`mkdir CloudCrmWeb`

Заходим в папку:

`cd CloudCrmWeb`

Клонируем проект:

`git clone git@github.com:TrainingCloudCrmWeb/Training_Galikhanov_Eduard.git`

## Возможные ошибки

1. Ошибка занятости порта

`ERROR: for training_nginx_1 Cannot start service nginx: driver failed programming external connectivity on endpoint training_nginx_1 (82f8aeeb230d9b4d670a224936519391748e3dcca354590f4950a5ae28c77a04): Error starting userland proxy: listen tcp4 0.0.0.0:80: bind: address already in use`

Ошибка указывает на то что порт 80 который хочет слушать nginx занят. Скорее всего его слушать будет apache.

Для начала проверь кто слушает порт:

### NetStat синтаксис Linux

`$ netstat -tulpn | grep LISTEN`, где LISTEN - номер порта.
Если его слушает apache сноси его :)

### Удалить apache для Ubuntu
`sudo apt remove apache2`

Если указывает что порт пустой нужно переустановить docker engine и docker compose.
