<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePdfRequest;
use App\Http\Requests\UpdatePdfRequest;
use App\Models\Pdf;
use App\Services\PdfService;
use Illuminate\Http\Request;

class PdfsController extends Controller
{
    /**
     * @var PdfService
     */
    private $pdfService;

    /**
     * @param PdfService $pdfService
     */
    public function __construct(PdfService $pdfService) {
        $this->pdfService = $pdfService;
    }

    /**
     * List all the pdfs
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {

        $pdfs = $this->pdfService->getAll();
        return response()->json($pdfs);
    }

    /**
     * Create a new pdf
     * @param CreatePdfRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreatePdfRequest $request) {

        $createdPdf = $this->pdfService->add($request);
        return response()->json($createdPdf);
    }

    /**
     * Update an existing pdf
     * @param UpdatePdfRequest $request
     * @param Pdf $pdf
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePdfRequest $request, Pdf $pdf) {

        $updatedPdf = $this->pdfService->edit($request, $pdf);
        return response()->json($updatedPdf);
    }

    /**
     * Remove a pdf
     * @param Pdf $pdf
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Pdf $pdf) {

        $deletedLink = $this->pdfService->delete($pdf);
        return response()->json($deletedLink);
    }
}
