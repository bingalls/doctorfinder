# Doctor Finder
A Demo that displays doctors. Uses open data from the USA

## Demo Credentials
| user | password |
|---|---|
| admin@admin.com | secret
| user@user.com | secret

## Install
[Detailed Install](https://laravel.com/docs/8.x)

* Php 7.4+  # tested on v8.0
* Node 14+  # tested on v16
* sqlite3 (and PHP driver) # see also *Custom Database*
* [git clone doctorfinder](https://github.com/bingalls/doctorfinder)
* `cd doctorfinder/`
* `composer install`
* `npm install`  # or `yarn`
* `cp .env.example .env` # and edit
* `php artisan key:generate`
* `npm run development`   # or yarn
* `php artisan storage:link`

### Custom Database (optional)
Sqlite DB provided with data. 
Otherwise, install another DB & driver & continue

**Notice** Seeding all the doctor data may take about 30 minutes!
CSV files are converted to PHP arrays in memory.
* create empty database & grant privileges
* Edit DB_* settings in .env
* Edit php.ini (typically /etc/php.ini); change to
  * `memory_limit = 1500M`
* `php artisan migrate`
* `php artisan db:seed`

## Testing
* `cd doctorfinder/`
* `composer validate`
* `composer diagnose`
* `composer test`
* `npm audit`
* `npm doctor`
* `yarn check`        # if available; just accept typical errors in vendor libs :(
* `phpcs --standard=PSR2 -n app`  # requires Codesniffer global install. See also PSR12

## Notes
This loads the first 30,000 doctors for performance. Until true pagination is
implemented, tweak the limit in app/Models/Doctor.php, or filter for your USA State.

You can run `php artisan schedule:work` to simulate running cron jobs on your
development server. This will update the database annually from
[Socrates Open Payments](https://www.cms.gov/OpenPayments/Data/Dataset-Downloads) .
Updating all 25M of data on every doctor in the USA takes roughly 20 minutes.
New data is supposed to be marked with **NEW**, not to be found in this dataset.
Feel free contact me with an optimized (smaller update) data set.

Use your database native import for twice the performance, such as
* sqlite `.import`
* mysql `load data`

## License
Copyright 2021 Bruce Ingalls. Permission granted under the [Hippocratic License](https://firstdonoharm.dev/)

The following MIT licensed software was used:
* [Laravel Boilerplate](https://github.com/rappasoft/laravel-boilerplate)
* [Vuetify](https://vuetifyjs.com/)
