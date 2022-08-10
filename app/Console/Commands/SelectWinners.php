<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Winner;
use App\SubmitedDocuement;
use App\Models\Auction;
use Carbon\Carbon;

class SelectWinners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'winners:select';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Select Winner of The Auction';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return 'Winner is selected';
        $mytime = Carbon::now()->format('y, m,d');
        $auctions=Auction::where('status','active')
        ->where('endDate', $mytime)->get();
        // $newestCliente = Cliente::orderBy('id', 'desc')->first();
        // $newestCliente = Cliente::orderBy('id', 'desc')->first();
        foreach($auctions as $auction){
            if($auction->purpose='sale'){
                $WinnerUsers = SubmitedDocument::orderBy('totla_price','desc')
                ->where('auction_id', $auctions->id)->first();

               }
            else{
            if($auction->purpose='buy'){
                $WinnerUsers = SubmitedDocument::orderBy('totla_price','asc')
                ->where('auction_id', $auctions->id)->first();
            }
        }
        $winner=new Winner();
        $winner->user_id=$WinnerUsers->user_id;
        $winner->auction_id=$WinnerUsers->auction_id;
        $winner->total_price=$WinnerUsers->total_price;
        $winner->save();
        Auction::where('id', $auction->id)
      ->update(['status' => 'deactivated']);
        // $auction->status='deactivated';



        }



        // foreach ($inactiveUsers as $user) {
        //     Mail::to($user)->send(new InactiveUsers($order));
        // }
        return 'winner is selected successfuly';
    }
}
