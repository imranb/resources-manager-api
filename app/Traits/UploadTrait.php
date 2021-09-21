<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait UploadTrait {

    /**
     * Store pdf file
     * @param UploadedFile $pdf
     * @param String $path
     * @param null $oldPdf
     * @return String
     */
    public function uploadPdf(UploadedFile $pdf, String $path, $oldPdf = null) : String {

        // if a file with the same name exists delete pdf
        $this->deletePdfFromStorage($path, $oldPdf);

        // Get full pdf name
        $filenameWithExt = $pdf->getClientOriginalName();

        // Get filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $filename = str_replace(' ', '_', $filename);
        // Get extension
        $extension = $pdf->getClientOriginalExtension();

        // Filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;

        // create dir if it doesn't exist
        if(!is_dir(storage_path('app/public/files/'.$path))) {
            if (!mkdir($concurrentDirectory = storage_path('app/public/files/' . $path), null, true) && !is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
        }

        // save new pdf
        $pdf->storeAs('public/files/' . $path, $fileNameToStore);

        // return filename
        return $fileNameToStore;
    }

    /**
     * Remove pdf from storage
     * @param $path
     * @param $pdf
     */
    public function deletePdfFromStorage($path, $pdf) {

        if (is_file(storage_path('app/public/files/'.$path.'/'.$pdf))) {
            unlink(storage_path('app/public/files/'.$path.'/'.$pdf));
        }
    }
}
