<p align="left">
    <br>
    <a href="https://travis-ci.org/Laravel-Backpack/Demo" title="Build Status"><img src="https://img.shields.io/travis/com/Laravel-Backpack/demo"></a>
    <a href="https://styleci.io/repos/61656673" title="Style CI"><img src="https://styleci.io/repos/61656673/shield"></a>
    <a href="https://scrutinizer-ci.com/g/laravel-backpack/demo" title="Quality Score"><img src="https://img.shields.io/scrutinizer/g/laravel-backpack/demo.svg?style=flat-square"></a>
    <a href="https://scrutinizer-ci.com/g/laravel-backpack/demo/code-structure" title="Coverage Status"><img src="https://img.shields.io/scrutinizer/coverage/g/laravel-backpack/demo.svg?style=flat-square"></a>
    <a href="LICENSE.md" title="Software License"><img src="https://img.shields.io/badge/License-dual-blue"></a>
    <br><br>
    <a href="https://backpackforlaravel.com/">Website</a> |
    <a href="https://backpackforlaravel.com/docs/">Documentation</a> |
    <a href="https://backpackforlaravel.com/addons">Add-ons</a> |
    <a href="https://backpackforlaravel.com/pricing">Pricing</a> |
    <a href="https://backpackforlaravel.com/need-freelancer-or-development-team">Services</a> |
    <a href="https://stackoverflow.com/questions/tagged/backpack-for-laravel">Stack Overflow</a> |
    <a href="https://www.reddit.com/r/BackpackForLaravel/">Reddit</a> |
    <a href="https://backpackforlaravel.com/articles">Blog</a> |
    <a href="https://backpackforlaravel.com/newsletter">Newsletter</a>
</p>

# Backpack\Demo

Laravel BackPack's demo, which includes all Backpack packages.


> ### Security updates and breaking changes
> Please **[subscribe to the Backpack Newsletter](http://backpackforlaravel.com/newsletter)** so you can find out about any security updates, breaking changes or major features. We send an email every 1-2 months.


![image](https://github.com/Laravel-Backpack/demo/assets/7188159/a8caa891-75fe-4df5-bf97-5593a334540b)

## How to Use

You can find the demo online at [demo.backpackforlaravel.com](https://demo.backpackforlaravel.com/admin), and play around. But some functionality is disabled, for security reasons (uploads, edits to users). If you want to run the demo without restrictions and/or make code edits and see how they're applied, you can install it on your own machine. See below.


## Install

> **IMPORTANT**. This demo requires ALL our premium packages. If you _do not_ have access to one of them, you will _not_ be able to install it. To install this demo yourself, make sure you've purchased all our premium add-ons individually, or our GOLD bundle - https://backpackforlaravel.com/pricing

1) Run in your terminal:

``` bash
git clone https://github.com/Laravel-Backpack/demo.git backpack-demo
```

2) Set your database information in your .env file (use the .env.example as an example);

3) Make sure the `APP_URL` in your .env file is correctly pointing to the URL you use to access your application in the browser, for example: `http:127.0.0.1:8000` or `http://something.test`

4) Run in your backpack-demo folder:
``` bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
```

## Usage

1. Your admin panel is available at http://localhost/backpack-demo/admin
2. Login with email ```admin@example.com```, password ```admin```
3. [optional] You can register a different account, to check out the process and see your gravatar inside the admin panel.
4. By default, registration is open only in your local environment. Check out ```config/backpack/base.php``` to change this and other preferences.

Note: Depending on your configuration you may need to define a site within NGINX or Apache; Your URL domain may change from localhost to what you have defined.

![Example generated CRUD interface](https://backpackforlaravel.com/uploads/docs-4-0/getting_started/tag_crud_list_entries.png)

## How the demo is organized

The menu has five entries. Greyed-out items marked _soon_ are pages we still have to build.

- **Dashboard** - a realistic Pet Shop dashboard (`resources/views/admin/dashboard.blade.php`, numbers from `App\View\Composers\DashboardComposer`).
- **Core Features** - one page per Backpack feature: UI (Widgets, Themes, Skins, Alerts, Components, Design) and CRUD operations. The CRUD operations link to live CRUD pages with `?explainer=<key>`, which shows an explainer card at the top; the texts live in `config/demo.php`.
- **Free Add-ons** - every free package, each with its live page.
- **Paid Add-ons** - every paid package. Those with a live example in the demo link straight to it, with an explainer card on top; the others get a page at `/admin/paid/<key>` (content in `config/demo.php`, under `paid_addons`).
- **Examples** - Pet Shop (a small realistic app) and Crazy Stuff (every field, column, filter and button in one place). This is where Backpack maintainers check that nothing broke.

The **Customize** button (bottom-right, on the login page too) opens a drawer where visitors pick a skin, a layout and the text direction. Choices are kept in a cookie, so they survive logging out, and are applied by `App\Http\Middleware\Theme`; the options live in `config/demo.php`. Add `?open_drawer=true` to any URL to open the drawer on page load (the website links to the demo this way). Legacy CoreUI themes are behind a collapsed section, for maintainers only.

Local-only helper routes (not available in production):

- `/dev/login-as/{email?}` - log in without a password (defaults to `admin@example.com`)
- `/dev/preview/{skin}/{layout?}` - log in with a given skin and layout, handy for screenshots

## If using docker

This package provides an example `docker-compose.yml` to launch your database and web server easily

```
composer install
cp .env.example .env
php artisan key:generate
```

Use these parameters in your .env file

```
APP_URL=http://localhost
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=backpackdemo
DB_USERNAME=root
DB_PASSWORD=asdf
```

Launch docker

```
docker-compose up -d
```

Create your database with following command

```
docker-compose exec db mysql -u root -pasdf -e "create database if not exists backpackdemo;"
```

Migrate and seed

```
php artisan migrate --seed
```

You should see the demo in your browser now

```
http://localhost/admin
```

To stop the server simply run

```
docker-compose down
```

Note:

In docker, to connect to your database from your GUI use `127.0.0.1` as your database host, instead of `localhost`

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email tabacitu@backpackforlaravel.com instead of using the issue tracker.

Please **[subscribe to the Backpack Newsletter](http://backpackforlaravel.com/newsletter)** so you can find out about any security updates, breaking changes or major features. We send an email every 1-2 months.

## Credits

- [Cristian Tabacitu][link-author]
- [All Contributors][link-contributors]

## License

Backpack is free for non-commercial use and 69 EUR/project for commercial use. Please see [License File](LICENSE.md) and [backpackforlaravel.com](https://backpackforlaravel.com/#pricing) for more information.

## Hire us

We've spend more than 10.000 hours creating, polishing and maintaining administration panels on Laravel. We've developed e-Commerce, e-Learning, ERPs, social networks, payment gateways and much more. We've worked on admin panels _so much_, that we've created one of the most popular software in its niche - just from making public what was repetitive in our projects.

If you are looking for a developer/team to help you build an admin panel on Laravel, look no further. You'll have a difficult time finding someone with more experience & enthusiasm for this. This is _what we do_. [Contact us - let's see if we can work together](https://backpackforlaravel.com/need-freelancer-or-development-team).

[link-author]: http://tabacitu.ro
[link-contributors]: ../../contributors
