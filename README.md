# Gacela API Skeleton

A minimal, production-ready starting point for building APIs with
[Gacela](https://gacela-project.com) and the Gacela [Router](https://github.com/gacela-project/router).

## Requirements

- PHP >= 8.1
- Composer

## Stack

| Package                        | Version |
|--------------------------------|---------|
| `gacela-project/gacela`        | ^1.19   |
| `gacela-project/router`        | ^0.13   |
| `gacela-project/container`     | ^0.10   |

## Usage / Development

Set up your custom config:

```bash
cp app-config.dist.php app-config.php
```

Run a local PHP server listening on `public/index.php`:

```bash
composer serve
```

### Endpoints

| Method | Path            | Description                                    |
|--------|-----------------|------------------------------------------------|
| GET    | `/health`       | Health check, returns `{"status":"ok"}`        |
| GET    | `/`             | Greets using the `?name=` query param (or asks for a name) |
| GET    | `/{name}`       | Greets the name from the path, e.g. `/bob`     |
| GET    | `/static`       | Returns a plain static page                    |

CORS headers are applied globally through `CorsMiddleware`
(see `src/Api/Infrastructure/Middleware`).

### Error handling

Unmatched routes and uncaught exceptions return JSON instead of empty HTML,
via the handlers in `src/Api/Infrastructure/Handler`:

```json
{ "error": "Not Found" }             // 404
{ "error": "Internal Server Error" } // 500 (details never leaked)
```

## Architecture

A Gacela module groups its classes by suffix convention:

- `Facade` — the module's public entry point
- `Factory` — wires domain objects together
- `Config` — typed access to the app config
- `Provider` — registers module dependencies in the container

Infrastructure (controllers, plugins, middlewares) lives under
`src/Api/Infrastructure`, and domain logic under `src/Api/Domain`.

## Performance

The bootstrap enables Gacela's file cache and Composer's optimized
autoloader, so class resolution and merged config are cached on disk:

```php
Gacela::bootstrap($cwd, static function (GacelaConfig $config): void {
    $config->enableFileCache();
    // ...
});
```

For production, enable OPcache preloading. Point PHP-FPM at Gacela's preload
script, and at this project's `config/app-preload.php` for the app classes:

```ini
opcache.enable=1
opcache.preload=/path/to/project/vendor/gacela-project/gacela/resources/gacela-preload.php
opcache.preload_user=www-data
env[GACELA_PRELOAD_USER_FILES]=/path/to/project/config/app-preload.php
```

Restart PHP-FPM after each deploy — preloaded files are snapshotted at startup.

## Docker

Production image (multi-stage, Apache + PHP 8.4 with OPcache preloading):

```bash
docker build -t gacela-api .
docker run --rm -p 8080:80 gacela-api
curl http://localhost:8080/health
```

`public/` is the document root and a front-controller rewrite routes every
non-file request through `public/index.php`.

## Quality

```bash
composer test-all       # run coding-standards, static analysis and tests
composer quality        # php-cs-fixer (dry-run) + psalm + phpstan
composer phpunit        # run the test suite
composer csfix          # auto-fix coding standards
composer test-coverage  # HTML coverage report (needs Xdebug)
```

## Contributions

Feel free to open issues & PRs if you want to contribute to this project.
