# Backpack\Demo

Laravel BackPack's demo, which includes all Backpack packages.

**[Subscribe to the newsletter](http://eepurl.com/bUEGjf) to be announced of any major updates or breaking changes.** 

![Example generated CRUD interface](https://dl.dropboxusercontent.com/u/2431352/backpack_base_login.png)


## Install

1) Run in your terminal:

``` bash
$ git clone git@github.com:Laravel-Backpack/demo.git
```

2) Set your database information in your .env file

3) Run:
``` bash
$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed --class="Backpack\Settings\database\seeds\SettingsTableSeeder"
```

## Usage 

1. Register a new user at yourappname/admin/register
2. Your admin panel will be available at yourappname/admin or yourappname/login
3. [optional] If you're building an admin panel, you should close the registration. In config/backpack/base.php look for "registration_open" and change it to false.

![Example generated CRUD interface](https://dl.dropboxusercontent.com/u/2431352/backpack_base_dashboard.png)

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

// TODO

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email hello@tabacitu.ro instead of using the issue tracker.

## Credits

- [Cristian Tabacitu][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: http://tabacitu.ro
[link-contributors]: ../../contributors
