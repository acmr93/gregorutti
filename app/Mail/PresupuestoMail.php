<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PresupuestoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($array)
    {
        $this->datos = $array;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(@$this->datos['file']){
            return $this->view('publica.layouts.cotizacion')
                    ->attach($this->datos['file']->getRealPath(), [
                            'as'    => $this->datos['file']->getClientOriginalName(),
                            'mime' => 'application/pdf',
                        ])
                    ->with([
                        'datos' => $this->datos
                    ]);
        } else {
            return $this->view('publica.layouts.cotizacion')->with(['datos' => $this->datos]);
        }
    }
}
