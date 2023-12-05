@extends('layouts.app')
@section('title', 'order')
@section('content')
    <div class="bg-white woocommerce-order-received">
        <!-- SHOP ORDER COMPLETED
                                                            ================================================== -->
        <div class="container py-8 py-lg-11">
            <div class="row">
                <div class="col-xl-8 mx-xl-auto">
                    <header class="entry-header">
                        <h1 class="entry-title">Order received</h1>
                    </header>

                    <div class="entry-content">
                        <div class="woocommerce">
                            <div class="woocommerce-order">
                                <section class="woocommerce-order-details">
                                    <h2 class="woocommerce-order-details__title">Order details</h2>
                                    <table
                                        class="woocommerce-table woocommerce-table--order-details shop_table order_details">
                                        <thead>
                                            <tr>
                                                <th class="woocommerce-table__product-name product-name">Course</th>
                                                <th class="woocommerce-table__product-table product-total">Total</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($orders as $order)
                                                @php
                                                    $discountedPrice = data_get($order, 'course.discounted_price', 0);
                                                @endphp
                                                <tr class="woocommerce-table__line-item order_item">
                                                    <td class="woocommerce-table__product-name product-name">
                                                        <a href="#">{{ $order->course->title }}</a>
                                                    </td>

                                                    <td class="woocommerce-table__product-total product-total">
                                                        <span class="woocommerce-Price-amount amount"><span
                                                                class="woocommerce-Price-currencySymbol">$</span>{{ number_format($discountedPrice, 2) }}</span>
                                                    </td>
                                                </tr>
                                                @php
                                                    $total += number_format($discountedPrice, 2);
                                                @endphp
                                            @endforeach
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th scope="row">Payment method:</th>
                                                <td>Paypal payments</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Total:</th>
                                                <td><span class="woocommerce-Price-amount amount"><span
                                                            class="woocommerce-Price-currencySymbol">$</span>{{ $total }}</span>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
