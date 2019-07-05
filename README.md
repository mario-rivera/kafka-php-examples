## Installing Composer Dependencies

```bash
$ docker-compose -f $(pwd)/docker/compose/commands.yaml \
--project-directory $(pwd) \
run --rm --no-deps --user $(id -u):$(id -g) \
composer
```

#### Require a composer package

```bash
$ docker-compose \
-f ./docker/compose/bootstrap.yml \
--project-directory $(pwd) \
run --rm --no-deps --user $(id -u):$(id -g) \
composer composer require -n --ignore-platform-reqs --no-scripts \
{packagename}:{packageversion}
```

#### Update composer packages

```bash
$ docker-compose \
-f ./docker/compose/bootstrap.yml \
--project-directory $(pwd) \
run --rm --no-deps --user $(id -u):$(id -g) \
composer composer update -n --ignore-platform-reqs --no-scripts
```

## Run PHP Console

```bash
$ docker-compose run --rm \
php
```

## Running Kafka containers

```bash
$ docker-compose -f $(pwd)/docker/compose/kafka.yaml \
--project-directory $(pwd) \
up -d kafka zookeeper
```

## Create Kafka Topic

```bash
$ docker-compose -f $(pwd)/docker/compose/kafka.yaml \
--project-directory $(pwd) \
run --rm --no-deps \
crudtopic
```

## Display Kafka Topic List

```bash
$ docker-compose -f $(pwd)/docker/compose/kafka.yaml \
--project-directory $(pwd) \
run --rm --no-deps \
topiclist
```

## Listen for Kafka Topic

```bash
docker-compose -f $(pwd)/docker/compose/kafka.yaml \
--project-directory $(pwd) \
exec kafka \
/usr/bin/kafka-console-consumer --bootstrap-server localhost:9092 --topic test
```

## Overloading Xdebug configuration

```bash
$ XDEBUG_CONFIG="remote_enable=1 remote_connect_back=0 remote_autostart=1 remote_host=host.docker.internal idekey=XDEBUG" docker-compose up php
```