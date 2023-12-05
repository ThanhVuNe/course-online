@extends('layouts.app')
@section('title', 'cart')
@section('script')
    <script src="{{ asset('assets/js/checkbox.js') }}"></script>
    <script src="{{ asset('assets/js/toast.js') }}"></script>
    <script src="{{ asset('assets/js/deleteCartItem.js') }}"></script>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/toast.css') }}">
@endsection
@section('content')
    @include('layouts.message')
    <!-- Notification-->
    <div class="notification-toast toast-success" style="display: none">
        <div>
            <span class="alert-icon"><i class="fa-solid fa-thumbs-up"></i></span>
            <span class="alert-text"><strong class="me-2">{{ __('success') }}</strong><br></span>
        </div>
        <div><span class="messageNotice"></span></div>
        <button type="button" class="btn-close" aria-label="Close"></button>
    </div>
    <div class="notification-toast toast-error" style="display: none">
        <div>
            <span class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></i></span>
            <span class="alert-text"><strong class="me-2">{{ __('error') }}</strong><br></span>
        </div>
        <div><span class="messageNotice"></span></div>
        <button type="button" class="btn-close" aria-label="Close"></button>
    </div>
    <form class="woocommerce-cart-form table-responsive" action="{{ route('carts.delete-cart') }}" method="post">
        @csrf
        @method('DELETE')
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('delete_label') }}</h5>
                    </div>
                    <div class="modal-body delete_item">
                        Do you want to delete items?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('cancel') }}</button>
                        <button type="submit" class="btn btn-alizarin">{{ __('delete') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="selected_items" id="selectedItemsInput" value="">
    </form>
    <header class="py-8 py-md-10" style="background-image: none;">
        <div class="container text-center py-xl-2">
            <h1 class="display-4 fw-semi-bold mb-0"> {{ __('shop_cart') }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="#">
                            {{ __('home') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                        {{ __('shop_cart') }}
                    </li>
                </ol>
            </nav>
        </div>
        <!-- Img -->
    </header>
    <!-- SHOP CART
                                                                                                                                                                                                                                                                                                                                                    ================================================== -->
    <div class="container pb-6 pb-xl-10">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('checkouts.store') }}" method="post">
                @csrf
                <div id="primary" class="content-area">
                    <main id="main" class="site-main ">
                        <div class="page type-page status-publish hentry">
                            <div class="entry-content">
                                <div class="woocommerce">
                                    <div class="woocommerce-cart-form table-responsive">
                                        <table
                                            class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div class="form-check">
                                                            <input class="form-check-input header-checkbox" type="checkbox"
                                                                onchange="handleCheckboxClick()">
                                                            {{ __('select_all') }}
                                                        </div>
                                                    </th>
                                                    <th class="product-name">{{ __('product') }}</th>
                                                    <th class="product-price">{{ __('price') }}</th>
                                                    <th class="product-quantity">{{ __('quantity') }}</th>
                                                    <th class="product-remove">{{ __('acion') }}</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $total = 0;
                                                @endphp
                                                @if (count($cart) > 0)
                                                    @foreach ($cart as $item)
                                                        <tr class="woocommerce-cart-form__cart-item cart_item">
                                                            <td>
                                                                <div class="form-check">
                                                                    <input class="form-check-input flexCheckDefault"
                                                                        type="checkbox"
                                                                        data-price="{{ number_format($item->course->discounted_price, 2) }}"
                                                                        data-id="{{ $item->id }}"
                                                                        onchange="calculateTotal()" name="select_items[]"
                                                                        value="{{ $item->id }}">
                                                                </div>
                                                            </td>
                                                            <td class="product-name" data-title="Product">
                                                                <div class="d-flex align-items-center">
                                                                    <a href="shop-single.html">
                                                                        <img src="{{ $item->course->poster_url }}"
                                                                            class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image"
                                                                            alt="">
                                                                    </a>
                                                                    <div class="ms-6">
                                                                        <a
                                                                            href="shop-single.html">{{ $item->course->title }}</a>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td class="product-price" data-title="Price">
                                                                <span class="woocommerce-Price-amount amount"><span
                                                                        class="woocommerce-Price-currencySymbol">$</span>{{ number_format($item->course->discounted_price, 2) }}</span>
                                                            </td>

                                                            <td class="product-quantity" data-title="Quantity">
                                                                <!-- Quantity -->
                                                                <div class="border rounded mw-70p">
                                                                    <input
                                                                        class="form-control form-control-sm border-0 quantity px-2"
                                                                        readonly name="quantity" value="1"
                                                                        type="number">

                                                                </div>
                                                                <!-- End Quantity -->
                                                            </td>
                                                            <td class="product-remove">
                                                                <a data-bs-toggle="modal"
                                                                    data-bs-target="#confirmDeleteModal{{ $item->id }}"
                                                                    class="btn btn-alizarin"
                                                                    style="padding: 0.7rem 1.5rem">Delete</a>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="5" class="actions">
                                                            <input class="button" id="deleteSelected" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal" value="Delete selected"
                                                                onclick="handleDeleteButtonClick()">
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td colspan="5" class="text-center">Empty courses!</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- .entry-content -->
                        </div>
                    </main>
                </div>
                <div id="secondary" class="sidebar" role="complementary">
                    <div class="cart-collaterals">
                        <div class="cart_totals">
                            <h2>Cart totals</h2>

                            <table class="shop_table shop_table_responsive">
                                <tbody>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td data-title="Total"><strong><span class="woocommerce-Price-amount amount"><span
                                                        class="woocommerce-Price-currencySymbol">$</span>
                                                    {{ $total }}</span></strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="wc-proceed-to-checkout">
                                <button type="submit" class="checkout-button button alt wc-forward">
                                    Proceed to checkout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @foreach ($cart as $item)
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModal" aria-hidden="true"
            id="confirmDeleteModal{{ $item->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('delete_label') }}</h5>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this item?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-alizarin"
                            onclick="deleteItem({{ $item->id }}, '{{ csrf_token() }}')">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
