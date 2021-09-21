<?php

namespace App\Services;

use App\Models\Link;
use Exception;

class LinkService
{
    /**
     * @var Link
     */
    protected $model;

    /**
     * @param Link $link
     */
    public function __construct(Link $link) {
        $this->model = $link;
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
                'title' => $request->title,
                'url'   => $request->url
            ]);

            return ['success' => true, 'message' => 'Link successfully created'];
        }
        catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * @param $request
     * @param $link
     * @return array
     */
    public function edit($request, $link) {

        try {
            $link->update([
                'title' => $request->title,
                'url'   => $request->url
            ]);

            return ['success' => true, 'message' => 'Link successfully updated'];
        }
        catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * @param $link
     * @return array
     */
    public function delete($link) {

        $link->delete();
        return ['success' => true, 'message' => 'Link successfully deleted'];
    }
}
