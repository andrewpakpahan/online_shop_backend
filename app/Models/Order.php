<?php

// Import necessary classes
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Define the Order class, which extends the Eloquent Model class
class Order extends Model
{
    // Use the HasFactory trait
    use HasFactory;

    // Define the fillable attributes for this model
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'total_price',
        'status',
    ];

    // Define the user method to establish a belongs-to relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the product method to establish a belongs-to relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
