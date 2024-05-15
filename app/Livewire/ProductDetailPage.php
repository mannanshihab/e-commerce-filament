<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

class ProductDetailPage extends Component
{
    #[Title('Product Details - SliceTech')]

    public $slug;
    public $quantity =  1;

    public function mount($slug){
        $this->slug = $slug;
    }

    public function increseQty(){
        $this->quantity++;
    }
    public function decreseQty(){
        if($this->quantity > 1){
            $this->quantity--;
        }
    }
    #add to cart
    public function addToCart($product_id){
        $total_count = CartManagement::addItemToCart($product_id);
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);
    }
    public function render()
    {
        return view('livewire.product-detail-page',[
            'product' => Product::where('slug', $this->slug)->firstOrFail(),
        ]);
    }
}
