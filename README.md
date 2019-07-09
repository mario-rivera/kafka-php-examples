## Run PHP Console

```bash
$ docker-compose run --rm \
-e CONSUMER_PARTITION=0 php
```

## Installing Composer Dependencies

```bash
$ docker-compose -f $(pwd)/docker/compose/commands.yaml \
--project-directory $(pwd) \
run --rm --no-deps --user $(id -u):$(id -g) \
composer
```

#### Require a composer package

```bash
$ docker-compose -f $(pwd)/docker/compose/commands.yaml \
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

## Overloading Xdebug configuration

```bash
$ XDEBUG_CONFIG="remote_enable=1 remote_connect_back=0 remote_autostart=1 remote_host=host.docker.internal idekey=XDEBUG" docker-compose up php
```