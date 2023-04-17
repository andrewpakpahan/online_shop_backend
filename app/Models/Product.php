<?php

// Import necessary classes
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Define the Product class, which extends the Eloquent Model class
class Product extends Model
{
    // Use the HasFactory trait
    use HasFactory;

    // Define the fillable attributes for this model
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
    ];
}
