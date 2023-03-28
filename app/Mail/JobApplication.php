<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Offer;

class JobApplication extends Mailable
{
    use Queueable, SerializesModels;

    public $offer;
    public $data;

    public function __construct(Offer $offer, array $data)
    {
        $this->offer = $offer;
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('emails.job_application')
                    ->from($this->data['email'], $this->data['name'])
                    ->subject('Candidature pour l\'offre '.$this->offer->title)
                    ->attach($this->data['cv']->getRealPath(), [
                        'as' => 'CV.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}
