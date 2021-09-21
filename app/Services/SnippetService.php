<?php

namespace App\Services;

use App\Models\Snippet;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SnippetService
{
    protected $model;

    public function __construct(Snippet $snippet) {
        $this->model = $snippet;
    }

    public function getAll() {

        return $this->model::query()->paginate();
    }

    public function add($request) {

        try {
            $this->model::create([
                'title'         => $request->title,
                'description'   => $request->description,
                'content'       => $request->content
            ]);

            return ['success' => true, 'message' => 'Snippet successfully created'];
        }
        catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function edit($request, $snippet) {

        try {
            $snippet->update([
                'title'         => $request->title,
                'description'   => $request->description,
                'content'       => $request->content
            ]);

            return ['success' => true, 'message' => 'Snippet successfully updated'];
        }
        catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function delete($snippet) {

        $snippet->delete();
        return ['success' => true, 'message' => 'Snippet successfully deleted'];
    }
}
