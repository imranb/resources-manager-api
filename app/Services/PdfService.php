<?php

namespace App\Services;

use App\Models\Pdf;
use App\Traits\UploadTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class PdfService
{
    use UploadTrait;

    protected $model;

    public function __construct(Pdf $pdf) {
        $this->model = $pdf;
    }

    public function getAll() {

        return $this->model::query()->paginate();
    }

    public function add($request) {

        try {
            DB::transaction(function () use ($request) {
                // upload file
                $pdfName = $this->uploadPdf($request->path, 'pdfs');
                // create model
                $this->model::create([
                    'title' => $request->title,
                    'path'  => $pdfName
                ]);

            });
            return ['success' => true, 'message' => 'Pdf successfully created'];
        }
        catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function edit($request, $pdf) {

        try {
            DB::transaction(function () use ($request, $pdf) {
                // upload file
                $pdfName = $pdf->path;
                if (!is_null($request->path))
                    $pdfName = $this->uploadPdf($request->path, 'pdfs', $pdf->path);
                // create model
                $pdf->update([
                    'title' => $request->title,
                    'path'  => $pdfName
                ]);

            });
            return ['success' => true, 'message' => 'Pdf successfully created'];
        }
        catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function delete($pdf) {

        DB::transaction(function () use ($pdf) {
            $this->deletePdfFromStorage('pdfs', $pdf->path);
            $pdf->delete();
        });
        return ['success' => true, 'message' => 'Pdf successfully deleted'];
    }
}
