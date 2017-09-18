<?php

namespace Story\Cms\Backend\Controllers;

use Illuminate\Http\Request;
use Story\Cms\Contracts\StoryMenuRepository;

class MenuController extends Controller
{
    /**
     * The StoryMeuRepository implementation.
     *
     * @var Story\Cms\Contracts\StoryMenuRepository
     */
    protected $menu;

    /**
     * Create new controller.
     *
     * @param StoryMenuRepository $menu
     */
    public function __construct(StoryMenuRepository $menu)
    {
        $this->menu = $menu;
    }

    /**
     * Display all menu
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = $this->menu->all();
        return $this->view('cms::menu.index', compact('menus'));
    }

    /**
     * Create a new menu
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'translatable_required',
            'url'  => 'required'
        ]);

        if ($request->has(['parent_id', 'post_id'])) {
            $data = $request->only('name', 'url', 'parent_id', 'post_id', 'active');
        } elseif ($request->has('parent_id')) {
            $data = $request->only('name', 'url', 'parent_id', 'active');
        } elseif ($request->has('post_id')) {
            $data = $request->only('name', 'url', 'post_id', 'active');
        } else {
            $data = $request->only('name', 'url', 'active');
        }

        $current_user = $request->user();
        $datas = array_merge($data, [
            'user_id' => $current_user->id
        ]);

        $menu = $this->menu->create($datas);

        if (!$menu) {
            return response()->json([
                'meta' => ['message' => 'Unable to create menu']
            ], 422);
        }

        return response()->json([
            'data' => $menu,
            'meta' => ['message' => 'Menu was created']
        ]);
    }

    /**
     * Update a menu
     *
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Request
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'translatable_required',
            'url'  => 'required'
        ]);

        if ($request->has(['parent_id', 'post_id'])) {
            $data = $request->only('name', 'url', 'parent_id', 'post_id', 'active');
        } elseif ($request->has('parent_id')) {
            $data = $request->only('name', 'url', 'parent_id', 'active');
        } elseif ($request->has('post_id')) {
            $data = $request->only('name', 'url', 'post_id', 'active');
        } else {
            $data = $request->only('name', 'url', 'active');
        }

        $current_user = $request->user();
        $datas = array_merge($data, [
            'user_id' => $current_user->id
        ]);

        if ($menu = $this->menu->findById($id)) {
            $menu = $this->menu->update($menu, $datas);
            if (!$menu) {
                return response()->json([
                    'meta' => ['message' => 'Unable to update menu']
                ], 422);
            }
            return response()->json([
                'data' => $menu,
                'meta' => ['message' => 'Menu was updated']
            ]);
        }
        return response()->json([
            'data' => [],
            'meta' => ['message' => 'Unable to found menu']
        ], 422);
    }

    /**
     * Destroy menu
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if ($menu = $this->menu->findById($id)) {
            if ($this->menu->destroy($menu)) {
                return response()->json([
                    'meta' => ['message' => 'Menu was destroyed']
                ]);
            }
        }

        return response()->json([
            'meta' => ['message' => 'Unable to destroy menu']
        ]);
    }

}
