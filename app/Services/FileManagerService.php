<?php

namespace App\Services;

use App\Repository\FileRepository;
use Illuminate\Support\Facades\Storage;

class FileManagerService
{
    public function __construct(protected FileRepository $repository)
    {
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function upload($file)
    {
        $path = Storage::putFile('uploads', $file);
        $this->repository->create(['path'=>$path]);
        return $path;
    }

    public function delete(int $id)
    {
        $file = $this->repository->findById($id);

        // Delete the file from storage
        Storage::delete("uploads/{$file->path}");

        // Delete the file record from the database
        $file->delete();
//        $this->repository->delete($id);
    }

    public function download(int $id): array
    {
        $file = $this->repository->findById($id);
        $path = Storage::path($file['path']);

        return [
            'path' => $path,
            'filename' => $file->original_name,
        ];
    }


}
