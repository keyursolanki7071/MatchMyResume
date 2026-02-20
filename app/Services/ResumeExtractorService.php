<?php

namespace App\Services;

use Smalot\PdfParser\Parser;


class ResumeExtractorService
{

    public function extract($filePath)
    {
        $parser = new Parser();
        $pdf = $parser->parseFile($filePath);
        return $pdf->getText();
    }
}
