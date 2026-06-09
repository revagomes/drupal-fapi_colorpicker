<?php

namespace Drupal\fapi_colorpicker\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\FormElementBase;
use Drupal\Core\Render\Element\RenderElementBase;

/**
 * Provides a colorpicker form element.
 *
 * Usage:
 * @code
 * $form['color'] = [
 *   '#type' => 'colorpicker',
 *   '#title' => $this->t('Colour'),
 *   '#default_value' => '#1a2b3c',
 * ];
 * @endcode
 *
 * The submitted value is a 7-character lowercase hex string including the
 * leading '#' (e.g. '#1a2b3c').
 *
 * @FormElement("colorpicker")
 */
class Colorpicker extends FormElementBase {

  /**
   * {@inheritdoc}
   */
  public function getInfo(): array {
    return [
      '#input' => TRUE,
      '#default_value' => '#000000',
      '#process' => [
        [RenderElementBase::class, 'processAjaxForm'],
      ],
      '#pre_render' => [
        [static::class, 'preRenderColorpicker'],
      ],
      '#theme' => 'input__color',
      '#theme_wrappers' => ['form_element'],
      '#attached' => ['library' => ['fapi_colorpicker/colorpicker']],
      '#element_validate' => [
        [static::class, 'validateColorpicker'],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function valueCallback(&$element, $input, FormStateInterface $form_state): string {
    if ($input !== FALSE && $input !== NULL) {
      return static::normalizeHex((string) $input);
    }
    return static::normalizeHex((string) ($element['#default_value'] ?? '#000000'));
  }

  /**
   * Prepares the colorpicker element for rendering.
   *
   * @param array $element
   *   The element render array.
   *
   * @return array
   *   The modified element render array.
   */
  public static function preRenderColorpicker(array $element): array {
    $element['#attributes']['type'] = 'color';
    $element['#attributes']['value'] = $element['#value'];
    $hex = htmlspecialchars($element['#value'], ENT_QUOTES, 'UTF-8');
    $element['#suffix'] = '<input type="text"'
      . ' class="fapi-colorpicker-hex"'
      . ' maxlength="7"'
      . ' value="' . $hex . '"'
      . ' aria-label="Hex value"'
      . ' />';
    return $element;
  }

  /**
   * Validates that the submitted value is a valid hex colour.
   *
   * @param array $element
   *   The element render array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public static function validateColorpicker(array &$element, FormStateInterface $form_state): void {
    $value = $element['#value'];
    if ($value === '') {
      return;
    }
    if (!preg_match('/^#[0-9a-fA-F]{6}$/', $value)) {
      $form_state->setError($element, t('Enter a valid hex colour (e.g. #1a2b3c).'));
    }
  }

  /**
   * Normalises a colour value to a 7-char lowercase hex string.
   *
   * @param string $value
   *   Raw input value.
   *
   * @return string
   *   Lowercase hex string with leading '#', e.g. '#1a2b3c'.
   */
  protected static function normalizeHex(string $value): string {
    $value = strtolower(trim($value));
    if ($value !== '' && !str_starts_with($value, '#')) {
      $value = '#' . $value;
    }
    return preg_match('/^#[0-9a-f]{6}$/', $value) ? $value : '#000000';
  }

}
