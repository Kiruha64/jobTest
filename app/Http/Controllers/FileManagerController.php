<?php

namespace App\Http\Controllers;

use App\Services\FileManagerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{

    public function __construct(protected FileManagerService $service)
    {
    }

    public function index()
    {
        $files = $this->service->getAll();
        return view('manager.index', compact('files'));
    }

    public function create(Request $request)
    {
        $file = $this->service->upload($request->file('file'));
        return back();
    }
    public function delete(int $id)
    {
        $file = $this->service->delete($id);
        return back();
    }

    public function download(int $id)
    {
        $fileData = $this->service->download($id);
        return response()->download($fileData['path'], $fileData['filename']);
    }
}
