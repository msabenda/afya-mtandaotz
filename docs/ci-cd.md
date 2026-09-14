# CI/CD

## Continuous integration

`.github/workflows/ci.yml` runs for pushes and pull requests targeting `main`.

It validates:

- Composer configuration and locked dependencies
- Laravel Pint formatting
- Laravel tests with an in-memory SQLite database
- Production PHP dependency advisories
- Reproducible npm installation and Vite production build
- Production frontend dependency advisories

## Continuous delivery

`.github/workflows/release.yml` runs when a tag matching `v*` is pushed. It can also be started manually from GitHub Actions.

The workflow installs production PHP dependencies, builds frontend assets, removes development-only and sensitive files, and creates a versioned `.tar.gz` artifact. Tagged runs attach the artifact to a GitHub Release.

Example release:

```bash
git tag -a v1.0.0 -m "Release v1.0.0"
git push origin v1.0.0
```

The artifact deliberately contains no `.env`. Configure the environment, application key, database, writable storage directories, web-server document root (`public/`), migrations, queues, and scheduler on the deployment platform.

Automatic production deployment should be added only after choosing a hosting target and configuring protected GitHub environment secrets.
