<?php

namespace App\Http\Controllers;

use App\Error;
use App\Services\ArquivoService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArquivoController extends Controller {

    private $arquivoService;
    private $error;

    public function __construct() {
        $this->error = new Error();
        $this->arquivoService = new ArquivoService();
    }

    public function uploadArquivo(Request $request) {
        try {
            $validador = $this->arquivoService->validadorArquivo($request);

            if ($validador->fails()) {
                //422 = Unprocessable Entry
                return $this->error->setMensagem($request->arquivo, 422);
            }

            $agora = Carbon::now();
            $arquivo = $request->file('arquivo');
            $caminhoArquivo = "documentos/" . sha1($agora) . $arquivo->getClientOriginalName();

            //Salva o arquivo
            try {
                Storage::put($caminhoArquivo, $arquivo);

                return $this->error->setMensagem("Arquivo salvo com sucesso!", 200);
            } catch (\Throwable $exception) {
                //500 = Internal Server Error
                return $this->error->setMensagem("Erro ao salvar a imagem", 500, $exception, false);
            }
        } catch (\Throwable $exception) {
            return $this->error->setMensagem("Erro ao salvar a imagem", 500, $exception, false);
        }
    }
}
