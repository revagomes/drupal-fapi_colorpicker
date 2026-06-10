# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.1.0] - 2026-06-09

### Added
- `src/Element/Colorpicker.php` — proper D10/11 `FormElementBase` plugin replacing all D7 procedural code
- `fapi_colorpicker.libraries.yml` — Drupal 8+ asset library definition
- `js/fapi_colorpicker.js` — progressive JS enhancement syncing the native colour picker with a companion hex text input
- `phpcs.xml.dist` scoping PHPCS to module source files
- `.github/workflows/ci.yml` CI pipeline (composer validate, PHP lint, PHPCS)
- `README.md` with usage examples and CI badge
- `.gitignore` excluding `/vendor/`

### Changed
- `fapi_colorpicker.module` stripped of all D7 code; reduced to `@file` docblock only
- `fapi_colorpicker.info.yml` description fixed (typo), `color_field` spurious dependency removed, package set to `Form`, `core_version_requirement` tightened to `^10.3 || ^11`
- `composer.json` description corrected (was Font Awesome copy-paste), `php: ^8.1` constraint added, support URLs updated to current drupal.org/GitLab paths

### Removed
- `LocaleApiAdapter` equivalent — all D7 private APIs removed
- `fapi_colorpicker.make` — D7 Drush make artifact
- `composer.libraries.json` — no longer needed; third-party jQuery colorpicker replaced by native HTML5 `<input type="color">`
- IE6 support code
- `drupal:color_field` dependency (was declared but never used)
