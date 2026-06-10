# Colorpicker form element (`fapi_colorpicker`)

[![CI](https://github.com/revagomes/drupal-fapi_colorpicker/actions/workflows/ci.yml/badge.svg)](https://github.com/revagomes/drupal-fapi_colorpicker/actions/workflows/ci.yml)
[![Drupal 10.3+](https://img.shields.io/badge/Drupal-10.3%2B-blue)](https://www.drupal.org/project/fapi_colorpicker)
[![Drupal 11](https://img.shields.io/badge/Drupal-11-blue)](https://www.drupal.org/project/fapi_colorpicker)
[![License: GPL v2](https://img.shields.io/badge/License-GPL%20v2-blue.svg)](https://www.gnu.org/licenses/gpl-2.0)

Provides a `colorpicker` Form API element backed by the native HTML5
`<input type="color">` picker, with a companion hex text input for direct
entry.

## Installation

```bash
composer require drupal/fapi_colorpicker
drush en fapi_colorpicker -y
```

## Usage

```php
$form['brand_color'] = [
  '#type' => 'colorpicker',
  '#title' => $this->t('Brand colour'),
  '#default_value' => '#1a73e8',
  '#required' => TRUE,
];
```

Submitted values are 7-character lowercase hex strings including the `#`
prefix (e.g. `#1a73e8`).

## Supported properties

| Property | Type | Default | Description |
|---|---|---|---|
| `#default_value` | string | `#000000` | Initial hex colour |
| `#title` | string | — | Field label |
| `#required` | bool | `FALSE` | Whether a value is required |
| `#description` | string | — | Help text below the element |
