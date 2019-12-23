
# You can change this to a different version of Wordpress available at
# https://hub.docker.com/_/wordpress
FROM wordpress:5.3.1-apache


# install git and node/npm
RUN apt-get -y update
# subversion is needed for composer
RUN apt-get -y install git
RUN apt-get -y install unzip

# needed stuff for node
RUN apt-get -y install curl software-properties-common
RUN apt-get -y install gnupg
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get install -y nodejs
WORKDIR /

RUN npm i -g yarn

# Install Composerr
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html/wp-content/themes/presspack
WORKDIR /var/www/html/wp-content/themes/presspack
RUN yarn install
RUN composer install --no-interaction

USER www-data:www-data