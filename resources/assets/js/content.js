const classes = 'col-md-3 col-sm-4 col-xs-12 content_item-list content_item-playing';

$('.content_item').on('click', (event) => {
  const $item = $(event.currentTarget);
  if (!$item.hasClass('content_item-list')) {
    return;
  }

  const $iframe = $item.find('iframe');
  if (!$iframe.attr('src')) {
    $iframe.on('load', () => {
      $item.find('.content_loading').fadeOut()
    });
    $iframe.attr('src', $iframe.data('src'));
  }

  $item.toggleClass(classes);
});

$('.content_close').on('click', (event) => {
  const $item = $(event.target).parents('.content_item-playing');
  $item.toggleClass(classes);
  $item.find('iframe').attr('src', '');

  event.stopPropagation();
});
