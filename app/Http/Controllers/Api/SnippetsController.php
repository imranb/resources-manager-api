<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSnippetRequest;
use App\Models\Snippet;
use App\Services\SnippetService;
use Illuminate\Http\Request;

class SnippetsController extends Controller
{
    /**
     * @var SnippetService
     */
    private $snippetService;

    /**
     * @param SnippetService $snippetService
     */
    public function __construct(SnippetService $snippetService) {
        $this->snippetService = $snippetService;
    }

    /**
     * List all the snippets
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {

        $snippets = $this->snippetService->getAll();
        return response()->json($snippets);
    }

    /**
     * Create a new snippet
     * @param CreateSnippetRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateSnippetRequest $request) {

        $createdSnippet = $this->snippetService->add($request);
        return response()->json($createdSnippet);
    }

    /**
     * Update an existing snippet
     * @param CreateSnippetRequest $request
     * @param Snippet $snippet
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateSnippetRequest $request, Snippet $snippet) {

        $updatedSnippet = $this->snippetService->edit($request, $snippet);
        return response()->json($updatedSnippet);
    }

    /**
     * Remove a snippet
     * @param Snippet $snippet
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Snippet $snippet) {

        $deletedSnippet = $this->snippetService->delete($snippet);
        return response()->json($deletedSnippet);
    }
}
