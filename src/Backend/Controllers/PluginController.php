<?php

namespace Story\Cms\Backend\Controllers;

use Plugin;
use Illuminate\Http\Request;

class PluginController extends Controller
{
    /**
     * Display available plugins
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plugins = Plugin::all();

        return $this->view('cms::plugin.index', compact('plugins'));
    }

    /**
     * Install specific plugins
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|exists:plugins,name'
        ]);

        if (Plugin::install($request->input('name'))) {
            return response()->json([
                'meta' => ['message' => 'Plugins is installed.']
            ]);
        }

        return response()->json([
            'meta' => ['message' => 'Unable to install the plugins.']
        ]);
    }

    /**
     * Uninstall the specific plugins
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|exists:plugins,name'
        ]);

        if (Plugin::uninstall($request->input('name'))) {
            return response()->json([
                'meta' => ['message' => 'Plugins is uninstalled.']
            ]);
        }

        return response()->json([
            'meta' => ['message' => 'Unable to uninstall the plugins.']
        ]);
    }
}
