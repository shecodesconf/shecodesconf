(function($) {
  $(function() {
  var formfield = null,
    $list = $('#orginizers-list'),
    $media = $('<div class="media">'),
    $mediaBody = $('<div class="bd">'),
    $imgInput = $('<input type="hidden">'),
    $nameInput = $('<input type="hidden">'), 
    mediaLength;

  $('#add-headshot').on('click', function() {

    $('html').addClass('Image');
    tb_show('' , 'media-upload.php?type=image&TB_iframe=true');
    
    return false;
  }); 

  $('#add-o').on('click', function(e) {
    e.preventDefault();
    var name = $('#o-name').val();

    $nameInput
      .attr('name', 'o-name[' + mediaLength + ']')
      .attr('value', name);

    $mediaBody.append(name);

    $media.append($mediaBody, $nameInput);
    $list.append($media);

    // Reset
    $('#o-name').val('');
    $('#o-prev').html('');
    $media = $('<div class="media">');
    $mediaBody = $('<div class="bd">');
    $imgInput = $('<input type="hidden">');
    $nameInput = $('<input type="hidden">'); 

    return false;
  }); 

  window.original_send_to_editor = window.send_to_editor;
   window.send_to_editor = function(html){
    var $oPrev = $('#o-prev'), 
      $img = $(html),
      name = $('#o-name').val(),
      url,
      $newIMG;

    url = $img.attr('href');
    mediaLength = $('.media').length;

    $imgInput
      .attr('name', 'o-img[' + mediaLength + ']')
      .attr('value', url);

    $img
      .find('img')
      .attr('height', '32')
      .attr('width', '32');

    $img.addClass('img');
    $media.append($img, $imgInput);
    $oPrev.html($img.clone());

    tb_remove();
    $('html').removeClass('Image');
  };

  });
})(jQuery);
