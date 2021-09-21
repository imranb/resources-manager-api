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

    public function __construct(SnippetService $snippetService) {
        $this->snippetService = $snippetService;
    }

    public function index() {

        return response()->json($this->snippetService->getAll());
    }

    public function store(CreateSnippetRequest $request) {

        $createdSnippet = $this->snippetService->add($request);
        return response()->json($createdSnippet);
    }

    public function update(CreateSnippetRequest $request, Snippet $snippet) {

        $updatedSnippet = $this->snippetService->edit($request, $snippet);
        return response()->json($updatedSnippet);
    }

    public function destroy(Snippet $snippet) {

        $deletedSnippet = $this->snippetService->delete($snippet);
        return response()->json($deletedSnippet);
    }
}
