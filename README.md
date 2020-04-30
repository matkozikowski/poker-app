# poker-app
Required:
- docker-compose
- symfony
- POSTMAN application

Example poker app with input file
- webserver run: ``/home/enp.local/mkozikowski/.symfony/bin/symfony server:start``
- run mysql docker: ``docker-compose up``
- connect into DB: ``mysql -h 0.0.0.0 -P 3310 -u master -p``
- run phpunit in app directory ``php bin/phpunit tests/Util``
- example url for upload file: ``http://127.0.0.1:8000/files/hands.txt``

To run application:
1. run /bin/bash run.sh

TO run application manually:
1. run: ``docker-compose up -d``
2. in app directory run ``composer install``
2. in app directory run: ``symfony server:start``
3. in app directory run ``php bin/console doctrine:migrations:migrate``
3. Import poker.postman_collection.json into POSTMAN app.
4. In postman at first:
5 Run Login endpoint
6 Run UploadFile endpoint
7 Run Scores endpoint

In Futuer TODO:
- create lock PUT request per minutes to upload file
- add verification content type for upload file
- create time expired token
- Create RabbitMQ for upload all data from txt file into DB, run with command in CRON