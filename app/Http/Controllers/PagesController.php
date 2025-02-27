<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }
    public function about(){
        return view('pages.shop-about');
    }

    public function account(){
        return view('pages.shop-account');
    }

    public function checkout(){
        return view('pages.shop-checkout');
    }

    public function faq(){
        return view('pages.shop-faq');
    }

    public function contacts(){
        return view('pages.contacts');
    }

    public function goodsCompare(){
        return view('pages.shop-goods-compare');
    }
    public function items(){
        return view('pages.shop-item');
    }
    public function privacyPolicy(){
        return view('pages.shop-privacy-policy');
    }
    public function productList(){
        return view('pages.shop-product-list');
    }

    public function search(){
        return view('pages.shop-search-result');
    }

    public function shoppingCart(){
        return view('pages.shop-shopping-cart');
    }

    public function shoppingCartNull(){
        return view('pages.shop-shopping-cart-null');
    }

    public function standartForms(){
        return view('pages.shop-standart-forms');
    }

    public function termsCondition(){
        return view('pages.shop-terms-conditions');
    }
    public function wishlist(){
        return view('pages.shop-wishlist');
    }
}
