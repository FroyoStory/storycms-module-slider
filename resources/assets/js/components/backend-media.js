/*jslint unparam: true */
/*global window, $ */
$(function () {
  'use strict';
  // Change this to the location of your server-side upload handler:
  var url = '/backend/upload';

  $('#fileupload').fileupload({
    formData: {
      _token: $('input[name=_token]').val(),
      _method: 'POST'
    },
    url: url,
    dataType: 'json',
    done: function (e, data) {
      $.each(data.result.files, function (index, file) {
        var str = '<tr><td>' + file.name + '</td><td>';
        if (file.mimes == 'mp4') {
          str = str  + '<video controls preload="none" style="width: 100%"><source src="' + file.url + '" class="img-responsive" type="video/mp4" /></video>';
        } else {
          str = str  + '<img src="' + file.thumbnailUrl + '" class="img-responsive" />';
        }

        str = str + '</td><td>' + file.mimes + '</td></tr><input type="hidden" name="media[]" value="' + file.name +'*' +file.mimes+' " />';

        $(str).appendTo('table.fileuploaded')
      });
    },
    progressall: function (e, data) {
      var progress = parseInt(data.loaded / data.total * 100, 10);
      $('#progress .progress-bar').css(
        'width',
        progress + '%'
      );
    }
  }).prop('disabled', !$.support.fileInput)
      .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
