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

    /**
     * @param LinkService $linkService
     */
    public function __construct(LinkService $linkService) {
        $this->linkService = $linkService;
    }

    /**
     * List all the links
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {

        $links = $this->linkService->getAll();
        return response()->json($links);
    }

    /**
     * Create a new link
     * @param CreateLinkRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateLinkRequest $request) {

        $createdLink = $this->linkService->add($request);
        return response()->json($createdLink);
    }

    /**
     * Update an existing link
     * @param CreateLinkRequest $request
     * @param Link $link
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateLinkRequest $request, Link $link) {

        $updatedLink = $this->linkService->edit($request, $link);
        return response()->json($updatedLink);
    }

    /**
     * Remove a link
     * @param Link $link
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Link $link) {

        $deletedLink = $this->linkService->delete($link);
        return response()->json($deletedLink);
    }
}
