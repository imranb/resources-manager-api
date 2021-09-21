<?php

namespace App\Services;

use App\Models\Snippet;
use Exception;

class SnippetService
{
    /**
     * @var Snippet
     */
    protected $model;

    /**
     * @param Snippet $snippet
     */
    public function __construct(Snippet $snippet) {
        $this->model = $snippet;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll() {

        return $this->model::query()->paginate();
    }

    /**
     * @param $request
     * @return array
     */
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

    /**
     * @param $request
     * @param $snippet
     * @return array
     */
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

    /**
     * @param $snippet
     * @return array
     */
    public function delete($snippet) {

        $snippet->delete();
        return ['success' => true, 'message' => 'Snippet successfully deleted'];
    }
}
