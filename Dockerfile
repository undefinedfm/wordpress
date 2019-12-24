
FROM wordpress

RUN sed -i 's/80/8080/' /etc/apache2/ports.conf /etc/apache2/sites-enabled/000-default.conf

RUN mv "$PHP_INI_DIR"/php.ini-development "$PHP_INI_DIR"/php.ini

# install_wordpress.sh & misc. dependencies
RUN apt-get update; \
  apt-get install -yq mariadb-client netcat sudo less git unzip

# node.js
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get install -yq nodejs
RUN npm i -g yarn

# wp-cli
RUN curl -sL https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar -o wp; \
  chmod +x wp; \
  mv wp /usr/local/bin/; \
  mkdir /var/www/.wp-cli; \
  chown www-data:www-data /var/www/.wp-cli

# composer
RUN curl -sL https://raw.githubusercontent.com/composer/getcomposer.org/master/web/installer | php; \
  mv composer.phar /usr/local/bin/composer; \
  mkdir /var/www/.composer; \
  chown www-data:www-data /var/www/.composer

# phpunit, phpcs, wpcs
RUN sudo -u www-data composer global require \
  phpunit/phpunit \
  dealerdirect/phpcodesniffer-composer-installer \
  phpcompatibility/phpcompatibility-wp \
  automattic/vipwpcs

COPY . /var/www/html/wp-content/themes/presspack
RUN sudo -u www-data cd /var/www/html/wp-content/themes/presspack &&  sudo -u www-data ls -la
RUN sudo -u www-data cd /var/www/html/wp-content/themes/presspack &&  sudo -u www-data yarn install

COPY ./plugins /var/www/html/plugins
COPY ./composer.json /var/www/html/composer.json
COPY ./composer.lock /var/www/html/composer.lock
RUN sudo -u www-data cd /var/www/html &&  sudo -u www-data composer install --no-interaction

# ensure wordpress has write permission on linux host https://github.com/postlight/headless-wp-starter/issues/202
RUN chown -R www-data:www-data /var/www/html

# include composer-installed executables in $PATH
ENV PATH="/var/www/.composer/vendor/bin:${PATH}"

EXPOSE 8080
USER www-data:www-data