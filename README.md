- To run this application without docker-compose run this commands.

1) docker build -t ems .

2) docker network create ems

3) docker run -d \
    --name mysql \
    -v ems_ems_db:/var/lib/mysql \
    -v ./DATABASE_FILE/:/docker-entrypoint-initdb.d/ \
    --network=ems \
    -e MYSQL_DATABASE=ems \
    -e MYSQL_USER=user \
    -e MYSQL_ROOT_PASSWORD=Nic@123 \
    -e MYSQL_PASSWORD=Nic@123 \
    -p 3306:3306 \
    mysql

4) docker run -d \
    --name ems \
    --network=ems \
    -v ./:/var/www/html \
    -p 80:80 \
    ems

- To run this application using docker-compose run this commands.

1) docker-compose down

2) docker-compose up -d
