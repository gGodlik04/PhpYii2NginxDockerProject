FROM yiisoftware/yii2-php:8.1-fpm
RUN apt-get update && apt-get install -y libc-client-dev libkrb5-dev supervisor cron sudo gettext git && rm -r /var/lib/apt/lists/* && \
    docker-php-ext-configure imap --with-kerberos --with-imap-ssl && docker-php-ext-install imap
RUN groupadd --gid 1000 php \
  && useradd --uid 1000 --gid php --shell /bin/bash --create-home php