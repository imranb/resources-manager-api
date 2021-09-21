<?php

namespace App\Services;

use App\Models\Link;
use Exception;

class LinkService
{
    protected $model;

    public function __construct(Link $link) {
        $this->model = $link;
    }

    public function getAll() {

        return $this->model::query()->paginate();
    }

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

    public function delete($link) {

        $link->delete();
        return ['success' => true, 'message' => 'Link successfully deleted'];
    }
}
