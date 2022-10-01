<p align="center">
  <img width="450px" src="https://getparthenon.com/images/logo.svg">
</p>

## Local Development Environment

Requirements:

* docker
* yarn
* php 8.1
* composer

### Setup

The first step is to set up the environment.

```
composer install
yarn install
```

### Run

To start up the local development environment you

```
cd docker
docker-compose up -d
cd ..
yarn encore dev-server
```

Then visit https://localhost