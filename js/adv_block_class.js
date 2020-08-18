/**
 * @file
 * Global utilities.
 *
 */
(function ($, Drupal) {
  $('.abc-collapse').next().hide();
  $('.abc-collapse').next().addClass('class-set');
  $('.abc-collapse').click(function() {
    if ($(this).next().hasClass('abc-open')) {
      $(this).next().removeClass('abc-open');
      $(this).next().hide();
    } else {
      $('.abc-open').hide();
      $('.abc-open').removeClass('abc-open');
      $(this).next().show();
      $(this).next().addClass('abc-open');
    }
  });
})(jQuery, Drupal);