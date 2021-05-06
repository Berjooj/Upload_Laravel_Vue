<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArquivoService {

    public function validadorArquivo(Request $request) {
        return Validator::make(
            $request->all(),
            [
                'arquivo' => 'max:5000|required',
            ],
            [
                'max' => 'O arquivo não pode ter mais de :max KB.',
                'required' => 'Por favor, passe um arquivo válido.'
            ]
        );
    }
}
