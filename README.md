- To run this application without docker-compose run this commands.

1. docker build -t ems .

2. docker network create ems_network

3. docker run -d \
   --name mysql \
   -v ems_ems_db:/var/lib/mysql \
   -v ./DATABASE_FILE/:/docker-entrypoint-initdb.d/ \
   --network=ems_network \
   -e MYSQL_DATABASE=ems \
   -e MYSQL_USER=admin \
   -e MYSQL_ROOT_PASSWORD=Admin@1234 \
   -e MYSQL_PASSWORD=Admin@1234 \
   -p 3306:3306 \
   mysql

4. docker run -d \
   --name ems \
   --network=ems_network \
   -v ./:/var/www/html \
   -p 80:80 \
   ems

- To run this application using docker-compose run this commands.

1. docker-compose down

2. docker-compose up -d

- To run this application using Kubernetes

1. kubectl apply -f mysql-secrets.yml -f mysql-configMap.yml

2. kubectl create configmap mysql-init-config --from-file=./DATABASE_FILE/ems.sql
