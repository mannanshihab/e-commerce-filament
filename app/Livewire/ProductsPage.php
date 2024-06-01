<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Products - SliceTech')]

class ProductsPage extends Component
{
    use WithPagination;

    #[Url]
    public $selected_categories = [];

    #[Url]
    public $selected_brands = [];

    #[Url]
    public $featured_product;

    #[Url]
    public $on_sale;

    #[Url]
    public $price_range= 300000;

    #[Url]
    public $sort;

    #add to cart
    public function addToCart($product_id){
        $total_count = CartManagement::addItemToCart($product_id);
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);
    }

    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);

        //FIlter Category
        if(!empty($this->selected_categories)){
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        //Filter Brands
        if(!empty($this->selected_brands)){
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }

        //Filter is_featured
        if($this->featured_product){
            $productQuery->where('is_featured', 1);
        }

        //Filter is_featured
        if($this->on_sale){
            $productQuery->where('on_sale', 1);
        }

        //Price Filter
        if($this->price_range){
            $productQuery->whereBetween('price', ['0', $this->price_range]);
        }

        //Sort
        if($this->sort == 'latest'){
            $productQuery->latest();
        }
        if($this->sort == 'price'){
            $productQuery->orderBy('price');
        }


        return view('livewire.products-page',[
            'products' => $productQuery->Paginate(9),
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
