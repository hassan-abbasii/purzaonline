<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProcessExpiredReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    
    protected $signature = 'reservations:process-expired';
    /**
     * The console command description.
     *
     * @var string
     */
    


    protected $description = 'Process expired reservations';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

$expiredReservations = reservation::where('status', 'active')
            ->where('created_at', '<=', Carbon::now()->subHours(24))
            ->get();

        foreach ($expiredReservations as $reservation) {
            $product = inventoryProduct::find($reservation->prod_id);

            if ($product) {
                // Update product stock
                $product->increment('quantity', $reservation->quantity);
            }

            // Update reservation status and quantity
            $reservation->status = 'expired';
            $reservation->quantity = 0;
            $reservation->save();
        }

        $this->info('Expired reservations processed successfully.');

        return Command::SUCCESS;
    }
}
