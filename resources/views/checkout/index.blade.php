@extends('layouts.app')
@section('title', 'checkout')

@section('content')
    <div class="bg-white woocommerce-order-received">
        <!-- SHOP ORDER COMPLETED
                                                                                                                                                                                        ================================================== -->
        <div class="container py-8 py-lg-11">
            <div class="row">
                <div class="col-xl-8 mx-xl-auto">
                    <div style="display:flex;justify-content: center; align-items:center">
                        <i class="fa-solid fa-cart-shopping" style="font-size:60px; color: green"></i>
                    </div>
                    <h1 class="entry-title my-5">Order List</h1>

                    <form action="{{ route('orders.store') }}" method="post">
                        @csrf
                        <div class="entry-content">
                            <div class="woocommerce">
                                <div class="woocommerce-order">
                                    <section class="woocommerce-order-details">
                                        <h2 class="woocommerce-order-details__title">Order details</h2>
                                        <table
                                            class="woocommerce-table woocommerce-table--order-details shop_table order_details">
                                            <thead>
                                                <tr>
                                                    <th class="woocommerce-table__product-name product-name">Courses</th>
                                                    <th class="woocommerce-table__product-table product-total">Total</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $total = 0;
                                                @endphp
                                                @foreach ($carts as $item)
                                                    <tr class="woocommerce-table__line-item order_item">
                                                        <td class="woocommerce-table__product-name product-name">
                                                            <a href="#">{{ $item->course->title }}</a>
                                                        </td>

                                                        <td class="woocommerce-table__product-total product-total">
                                                            <span class="woocommerce-Price-amount amount"><span
                                                                    class="woocommerce-Price-currencySymbol">$</span>{{ number_format($item->course->discounted_price, 2) }}</span>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $total += $item->course->discounted_price;
                                                    @endphp
                                                @endforeach

                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <th scope="row">Select Payment method:</th>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control" id="paymentMethod" name="payment_method">
                                                                <option value="paypal">Paypal</option>
                                                                <option value="vnpay">VN Pay</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Total:</th>
                                                    <td>
                                                        <span class="woocommerce-Price-amount amount"><span
                                                                class="woocommerce-Price-currencySymbol">$</span>{{ number_format($total, 2) }}</span>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </section>
                                    <button
                                        class="btn btn-primary btn-wide lift d-none d-lg-inline-block aos-init aos-animate"
                                        type="submit" data-aos-duration="200" data-aos="fade-up" style="width:100%">Pay the
                                        order</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
