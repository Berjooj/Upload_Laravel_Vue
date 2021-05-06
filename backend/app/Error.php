<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Error extends Model {
    protected $fillable = [
        'mensagem',
        'status',
        'debug'
    ];

    public function setMensagem($msg, $status_code, $exception = null, $debug = false) {
        $this->error = new Error();
        $this->error->mensagem = $msg;

        $this->error->status = $status_code;

        if ($debug && $exception != null)
            $this->error->debug = $exception->getMessage();

        return response()->json($this->error, $status_code);
    }
}
