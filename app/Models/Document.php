<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Document extends Model
{
    // product_name	product_type	product_measure	product_amount	product_price	total_price
   
    protected $fillable=['auction_id', 'product_name','product_type','product_measure', 'product_amount', 'product_price','user_id'];
    public static function getAllDocument(){
        return Document::orderBy('id','DESC')->paginate(10);
    }
}
