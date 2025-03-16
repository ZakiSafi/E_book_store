<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\BorrowedBook;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\OverdueBookNotification;

class CheckOverdueBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-overdue-books';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'checks for overdue books and notify users via email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $overdueBooks = BorrowedBook::where('returned_at', null)
            ->where('due_date', '<', Carbon::now())
            ->get();

        foreach ($overdueBooks as $borrowedBook) {
            // send notification to the user via email
            Mail::to($borrowedBook->user->email)->send(new OverdueBookNotification($borrowedBook));
        }
        $this->info('Notifications sent successfully!');

    }
}
