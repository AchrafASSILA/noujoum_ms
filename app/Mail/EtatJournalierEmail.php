<?php

namespace App\Mail;

use App\Models\Config\Config;
use App\Models\Fnc\FncEncaissementLine;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use PDF;

class EtatJournalierEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Etat Journalier Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.etat_journalier',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {

        $date =   date('Y-m-d');



        $fnc_inscriptions = FncEncaissementLine::where('created_at', 'like', $date . '%')->orderBy('created_at')->get();




        $filename = 'etat_journalier_' . $date . time() . '.pdf';

        $html = view()->make('impressions/etat_journalier', [
            'fnc_inscriptions' => $fnc_inscriptions,
            'date' => $date,
            'config' => Config::first(),
        ])->render();
        Storage::disk('local')->put($filename, $html);
        PDF::SetTitle('Etat journalier');
        PDF::AddPage();
        PDF::writeHTML($html);

        PDF::Output(public_path($filename), 'F');
        // $path =   'http://127.0.0.1:8000/storage/email/'  . $filename;
        return [public_path($filename)];
    }
}
