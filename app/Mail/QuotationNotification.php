<?php 

namespace App\Mail;

use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class QuotationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $quotation;

    public function __construct(Quotation $quotation)
    {
        $this->quotation = $quotation;
    }

    public function build()
    {
        $email = $this->subject('New Quotation Created')
                      ->view('emails.quotation_notification') 
                      ->with([
                          'quotation' => $this->quotation,
                      ]);

        // Attach prescription images if available
        if ($this->quotation->prescription->images) {
            foreach ($this->quotation->prescription->images as $image) {
                $email->attach(storage_path('app/public/' . $image), [
                    'as' => basename($image),
                    'mime' => 'image/jpeg',
                ]);
            }
        }

        return $email;
    }
}
