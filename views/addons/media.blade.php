<!-- The global progress bar -->
<div id="progress" class="progress">
    <div class="progress-bar progress-bar-success"></div>
</div>

<div class="row">
  <div class="col-md-4">
    <span class="btn btn-success fileinput-button">
      <span>Select files...</span>
      <!-- The file input field used as target for the file upload widget -->
      <input id="fileupload" type="file" name="upload[]" multiple>
    </span>
  </div>
  <div class="col-md-8">
    <table class="table fileuploaded">
      <thead>
        <tr>
          <th>Name</th>
          <th>Image</th>
          <th>File type</th>
        </tr>
      </thead>
      <tbody>
        @if (isset($post))
          @foreach($post->media as $media)
            <tr>
              <td>{{ $media->name }}</td>
              <td>
                @if ($media->type == 'mp4')
                  <video controls preload="none" style="width: 100%">
                    <source src="{{ $media->url }}" type="video/mp4">
                  </video>
                @else
                  <img src="{{ $media->url }}" class="img-responsive" />
                @endif

              </td>
              <td>{{ $media->type }}</td>
            </tr>
            <input type="hidden" name="media[]" value="{{ $media->name .'*'. $media->type}}">
          @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>
