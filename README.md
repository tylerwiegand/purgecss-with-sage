# PurgeCSS with Sage 10

Go through the database and create a file that PurgeCSS can read with [Sage 10](https://github.com/roots/sage).
Default location is theme/resources/views/vendor/purgecss-with-sage/classes.blade.php.
Configuration of output location is not available at this time.

## Requirements

- [Sage](https://github.com/roots/sage) >= 10.0
- [PurgeCSS](https://github.com/FullHuman/purgecss) >=2.0

## Installation

```bash
# /web/app/themes/sage

$ composer require tylerwiegand/purgecss-with-sage
```

## Usage

```bash
# web/app/themes/sage

wp acorn purgecss-with-sage
```

I'd also personally recommend a .gitignore addition of the generated file in Sage's .gitignore file:
```
# web/app/themes/sage/.gitignore

/resources/views/vendor/purgecss-with-sage/classes.blade.php
```

As of 1.1 it will also search the cssClass set in a GravityForm field if the plugin is active.

## Bug Reports

If you discover a bug in this package, please [open an issue](https://github.com/tylerwiegand/purgecss-with-sage/issues).

## Contributing

Contributions through PRs, issues or ideas are appreciated!

## License

PurgeCSS with Sage is provided under the [MIT License](https://github.com/tylerwiegand/purgecss-with-sage/blob/master/LICENSE.md).
