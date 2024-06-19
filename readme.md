<p align="center">
  <img width="450px" src="https://getparthenon.com/images/logo.svg">
</p>

<p align="center"><strong>Parthenon Skeleton Application</strong></p>

A quick and easy way to start your next application.

## Get started

To get started you can either click the use template button \([click here](https://github.com/getparthenon/skeleton/generate)\) on GitHub that will create a repository for you which you can clone and use.

Or via composer using the `create-project` command.

`composer create-project parthenon/skeleton new-application`

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
docker-compose up -d
cd ..
bin/console doctrine:migrations:migrate
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


## Documentation

The documentation can be found on the Parthenon website https://getparthenon.com/docs/getting-started/.

If you wish to contribute to the documentation. Or just look at the raw files. They can be found at https://github.com/getparthenon/parthenon-docs.

## Support

Support is provided via GitHub, Slack, and Email.

If you have a commercial license you will be able to list the GitHub accounts that you want to link to the license. This
means when an issue is created by an account linked to a commercial license they will get priority support. All other
issues will be given best effort support.

* Github: You can make an issue on [getparthenon/monorepo](https://github.com/getparthenon/monorepo/issues/new/choose)
* Email: support@getparthenon.com
* Slack: [Click here](https://join.slack.com/t/parthenonsupport/shared_invite/zt-1gujl7xsw-OALGFlPs~_Vf1cw6zaEkdg) to signup

Issues we will provide support and fixes for:

* Defects/Bugs
* Performance issues
* Documentation fixes/improvements
* Lack of flexibility
* Feature requests

## FAQ

### Is Parthenon Open-Source?

Yes, it's released under GPLv3

### Can I use Parthenon for free?

Yes.

### Who is Parthenon for?

Parthenon is for people who want to operate a web company that doesn't focus on the boring tech that everyone has done.

From bootstraps that want to start their business on the right footing to companies that want to improve their tech to large companies that have new projects and don't want to rebuild the same features they've done so many times.

### Can I use Parthenon with my existing Symfony application?

Yes. Parthenon is a bundle that can be used with your existing Symfony application. All the modules are toggable. So if you only want to use one part, you can.

### Will I be able to grow with Parthenon?

Parthenon is designed to scale. It has been purposefully designed so that things are able to be replaced as you grow.

We know that as your system scales, there will be parts of Parthenon you'll want to replace with highly custom code, and we designed Parthenon to allow you to do it with ease.
