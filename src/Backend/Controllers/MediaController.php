<?php

namespace Story\Cms\Backend\Controllers;

use Jenssegers\Date\Date;
use Story\Cms\Contracts\StoryPost;
use Story\Cms\Contracts\StoryPostRepository;
use Story\Cms\Support\Facades\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MediaController extends Controller
{
    /**
     * The Media StoryPost implementation.
     *
     * @var Story\Cms\Contracts\StoryPostRepository
     */
    protected $post;

    /**
     * Create new media post controller
     *
     * @param StoryPost $post
     */
    public function __construct(StoryPostRepository $post)
    {
        $this->post = $post;
    }

    /**
     * Display
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medias = $this->post->media()->paginate();

        if ($request->ajax()) {
            return response()->json([
                'data' => $medias->items,
                'meta' => [
                    'pagination' => $medias->pagination
                ]
            ]);
        }

        return $this->view('cms::media.index', compact('medias'));
    }

    /**
     * Update media files
     *
     * @param  Request $request
     * @param  int     $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        if ($post = $this->post->findById($id)) {
            if ($post = $this->post->update($post, $request->only('title'))) {
                return response()->json([
                    'data' => $post,
                    'meta' => [ 'message' => 'Attachment is updated.' ]
                ]);
            }
        }

        return response()->json([
            'data' => $post,
            'meta' => [ 'message' => 'Unable to update a File' ]
        ]);
    }

    /**
     * Destroy media files
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($post = $this->post->findById($id)) {
            // deleting attachment files
            list($name, $extension) = explode('.', str_replace('/storage/', '/public/', $post->slug));
            Storage::delete([
                $name.'.'.$extension,
                $name.'-thumbnail.'.$extension,
                $name.'-medium.'.$extension,
                $name.'-large.'.$extension,
            ]);

            if ($this->post->destroy($post)) {
                return response()->json([
                    'data' => $post,
                    'meta' => [ 'message' => 'File is destroyed' ]
                ]);
            }
        }

        return response()->json([
            'data' => $post,
            'meta' => [ 'message' => 'Unable to destroy a File' ]
        ], 422);
    }

    /**
     * Process uploading files
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required'
        ]);

        if (!$request->hasFile('file')) {
            return response()->json([
                'meta' => [ 'message' => 'File is required.' ]
            ], 422);
        }

        $path_dir = 'public/uploads/'. Date::now()->format('Ym');
        $path = $request->file->storePublicly($path_dir);
        $data = $this->buildAttributeUpload($request, $path);

        // resize images
        $this->resiveImage($path);

        if ($this->post->create($data)) {
            return response()->json([
                'data' => $data,
                'meta' => [ 'message' => 'File is uploaded' ]
            ]);
        }
        return response()->json([
            'meta' => [ 'message' => 'Unable to upload file' ]
        ], 422);
    }

    /**
     * Build attribute data
     *
     * @param  Request $request
     * @return array
     */
    protected function buildAttributeUpload(Request $request, $path)
    {
        return [
            'slug' => Storage::url($path),
            'title' => collect(config('multilangual.locales'))->mapWithKeys(function($item) use ($request) {
                return [$item => $request->file->getClientOriginalName()];
            }),
            'type' => resolve(StoryPost::class)::TYPE_ATTACHMENT,
            'post_status' => resolve(StoryPost::class)::POST_PUBLISHED,
            'comment_status' => resolve(StoryPost::class)::COMMENT_DISABLE,
            'mime_type' => $request->file->getClientMimeType(),
            'user_id' => $request->user()->id
        ];
    }

    /**
     * Resize images
     *
     * @param  string $path
     * @return void
     */
    protected function resiveImage($path)
    {
        $config      = Configuration::instance();
        $contentType = mime_content_type(storage_path(). '/app/'. $path);
        $mimes       = ['image/jpeg', 'image/png', 'image/jpg'];
        @list($name, $extension) = explode('.', $path);

        if (in_array($contentType, $mimes)) {
            // thumbnail
            $thumbnail = $config->SITE_MEDIA_THUMBNAIL->toArray();
            Image::make(storage_path().'/app/'.$path)
                ->fit($thumbnail->width, $thumbnail->height)
                ->save(storage_path().'/app/'.$name .'-thumbnail.'.$extension);

            // thumbnail
            $medium = $config->SITE_MEDIA_MEDIUM->toArray();
            Image::make(storage_path().'/app/'.$path)
                ->fit($medium->width, $medium->height)
                ->save(storage_path().'/app/'.$name .'-medium.'.$extension);

            // large
            $large = $config->SITE_MEDIA_LARGE->toArray();
            Image::make(storage_path().'/app/'.$path)
                ->fit($large->width, $large->height)
                ->save(storage_path().'/app/'.$name .'-large.'.$extension);
        }
    }
}
