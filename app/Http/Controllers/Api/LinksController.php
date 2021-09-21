<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLinkRequest;
use App\Models\Link;
use App\Services\LinkService;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    /**
     * @var LinkService
     */
    private $linkService;

    public function __construct(LinkService $linkService) {
        $this->linkService = $linkService;
    }

    public function index() {

        return response()->json($this->linkService->getAll());
    }

    public function store(CreateLinkRequest $request) {

        $createdLink = $this->linkService->add($request);
        return response()->json($createdLink);
    }

    public function update(CreateLinkRequest $request, Link $link) {

        $updatedLink = $this->linkService->edit($request, $link);
        return response()->json($updatedLink);
    }

    public function destroy(Link $link) {

        $deletedLink = $this->linkService->delete($link);
        return response()->json($deletedLink);
    }
}
