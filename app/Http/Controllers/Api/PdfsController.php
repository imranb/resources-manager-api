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

    public function __construct(PdfService $pdfService) {
        $this->pdfService = $pdfService;
    }

    public function index() {

        return response()->json(['result' => $this->pdfService->getAll()]);
    }

    public function store(CreatePdfRequest $request) {

        $createdPdf = $this->pdfService->add($request);
        return response()->json($createdPdf);
    }

    public function update(UpdatePdfRequest $request, Pdf $pdf) {

        $updatedPdf = $this->pdfService->edit($request, $pdf);
        return response()->json($updatedPdf);
    }

    public function destroy(Pdf $pdf) {

        $deletedLink = $this->pdfService->delete($pdf);
        return response()->json($deletedLink);
    }
}
