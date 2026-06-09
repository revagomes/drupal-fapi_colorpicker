(function ($, Drupal) {
  Drupal.behaviors.fapiColorpicker = {
    attach: function (context, settings) {
      $(context).find('input[type="color"].fapi-colorpicker-widget').each(function () {
        var $color = $(this);
        var $hex = $color.next('.fapi-colorpicker-hex');

        $color.on('input change', function () {
          $hex.val($color.val());
        });

        $hex.on('input', function () {
          var val = $hex.val();
          if (/^#[0-9a-fA-F]{6}$/.test(val)) {
            $color.val(val.toLowerCase());
          }
        });
      });
    }
  };
}(jQuery, Drupal));
