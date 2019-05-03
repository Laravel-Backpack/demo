# Backpack\Demo

Laravel BackPack's demo, which includes all Backpack packages.


> ### Security updates and breaking changes
> Please **[subscribe to the Backpack Newsletter](http://backpackforlaravel.com/newsletter)** so you can find out about any security updates, breaking changes or major features. We send an email every 1-2 months.


![Example generated CRUD interface](https://dl.dropboxusercontent.com/u/2431352/backpack_base_login.png)


## Install

1) Run in your terminal:

``` bash
git clone https://github.com/Laravel-Backpack/demo.git backpack-demo
```

2) Set your database information in your .env file (use the .env.example as an example);

3) Run in your backpack-demo folder:
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

![Example generated CRUD interface](https://dl.dropboxusercontent.com/u/2431352/backpack_base_dashboard.png)

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email hello@tabacitu.ro instead of using the issue tracker.

Please **[subscribe to the Backpack Newsletter](http://backpackforlaravel.com/newsletter)** so you can find out about any security updates, breaking changes or major features. We send an email every 1-2 months.

## Credits

- [Cristian Tabacitu][link-author]
- [All Contributors][link-contributors]

## License

Backpack is free for non-commercial use and 49 EUR/project for commercial use. Please see [License File](LICENSE.md) and [backpackforlaravel.com](https://backpackforlaravel.com/#pricing) for more information.

## Hire us

We've spend more than 50.000 hours creating, polishing and maintaining administration panels on Laravel. We've developed e-Commerce, e-Learning, ERPs, social networks, payment gateways and much more. We've worked on admin panels _so much_, that we've created one of the most popular software in its niche - just from making public what was repetitive in our projects.

If you are looking for a developer/team to help you build an admin panel on Laravel, look no further. You'll have a difficult time finding someone with more experience & enthusiasm for this. This is _what we do_. [Contact us - let's see if we can work together](https://backpackforlaravel.com/need-freelancer-or-development-team).

[link-author]: http://tabacitu.ro
[link-contributors]: ../../contributors

