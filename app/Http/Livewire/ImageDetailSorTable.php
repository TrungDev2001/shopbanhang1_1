<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Product;

class ImageDetailSorTable extends Component
{
    public $product_id;
    public function __construct($product_id)
    {
        $this->product_id = $product_id;
    }
    public function render()
    {
        $product = Product::find($this->product_id);
        $imageDetails = $product->ProductImages;
        return view('livewire.image-detail-sor-table', compact('imageDetails'));
    }
    public function updateTaskOrder($imageProductDetails)
    {
        dd($imageProductDetails);
    }
}
