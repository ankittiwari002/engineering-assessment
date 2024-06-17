<?php

namespace App\Console\Commands;

use App\Models\SuccessfulEmail;
use Illuminate\Console\Command;

class ProcessEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process raw emails and save plain text content to database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $emails = SuccessfulEmail::where('processed', 0)->get();

        foreach ($emails as $email) {
            $plainText = $this->extractPlainText($email->email);
            $email->raw_text = $plainText;
            $email->processed = 1; // Mark as processed
            $email->save();
        }

        $this->info('Emails processed successfully.');
    }
    private function extractPlainText($rawContent)
    {    
        $emailData = json_decode($rawContent, true); 
        $plainText = $emailData['textmessage']; 
        return $plainText;
    }
}
