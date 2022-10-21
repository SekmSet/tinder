# Tinder : Back-end 

Copy/paste `.env.example` file and rename it into `.env` then add your database configuration

Users table, column `status`

- 1 user actif
- 0 user unactif

## Controller

https://symfony.com/doc/current/page_creation.html

`src/Controller`

## Routing

https://symfony.com/doc/current/routing.html

```bash
  # List all routes: 
  php bin/console debug:router
```

## Containte on entity

https://symfony.com/doc/current/reference/constraints.html

## Launch back-end 

```bash
    symfony serve
```

## Create entity and migration

```bash
    # Create entity
    php bin/console make:entity
```

```bash
    # Make migration
    php bin/console make:migration
```

```bash
    # Launch migration
    php bin/console doctrine:migrations:migrate
```

## Fake data in your table

[Github Faker documentation link](https://github.com/fzaninotto/Faker)

```bash
    # Install doctrine bundle
    composer req --dev make doctrine/doctrine-fixtures-bundle
```

```bash
    # Install Faker
    composer require --dev fzaninotto/faker
```

Then create or add your fixtures in `src/DataFixtures/AppFixtures.php`

```bash
    # Apply your fixture
    php bin/console doctrine:fixtures:load
    
    # If you have some problem to apply your fixture, and you need to debug you can add this following argument : -v
    php bin/console doctrine:fixtures:load -v
```

If you make the **authentication** at the end of you project :
- think to change in the `routes.yaml` file the default value of your route

```yaml
settings_list:
    path: /api/settings/{id}
    defaults:
        id: { CHANGE ME }
    controller: App\Controller\Profil\Settings
    methods: GET
```

I used default value for my URL param because I make authentication at the last step of my project.
But I wanted to test my routes and don't add the id parameter in the URL. Each time you make a fixture, **id** in database are changing.
If you don't define a default value for you route you have to add the value parameter in the URL.

**If you parameter are dynamic** you don't need to make this change.


## Reset databases

bin/console doctrine:database:drop --force
bin/console doctrine:database:create
bin/console doctrine:migrations:migrate --no-interaction
bin/console doctrine:fixtures:load --no-interaction