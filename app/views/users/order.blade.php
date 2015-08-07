
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h2>Invoice</h2><h3 class="pull-right">Order # {{$orderDetail->id}}</h3>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Billed To:</strong><br/>
                        {{$orderDetail->full_name}}<br/>
                        {{$orderDetail->shippingAddress->address1}}<br/>
                        {{$orderDetail->shippingAddress->address2}}<br/>
                        {{$orderDetail->shippingAddress->city}}, {{$orderDetail->shippingAddress->zip}}<br/>
                        {{$orderDetail->shippingAddress->state}}, {{$orderDetail->shippingAddress->country}}
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Shipped To:</strong><br>
                        {{$orderDetail->full_name}}<br/>
                        {{$orderDetail->shippingAddress->address1}}<br/>
                        {{$orderDetail->shippingAddress->address2}}<br/>
                        {{$orderDetail->shippingAddress->city}}, {{$orderDetail->shippingAddress->zip}}<br/>
                        {{$orderDetail->shippingAddress->state}}, {{$orderDetail->shippingAddress->country}}
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 ">
                    <address>
                        <strong>Order Date:</strong>
                        {{$orderDetail->created_at}}<br><br>
                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td><strong>Item</strong></td>
                                <td class="text-center"><strong>Price</strong></td>
                                <td class="text-center"><strong>Quantity</strong></td>
                                <td class="text-right"><strong>Totals</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orderDetail->orderItems as $line)
                                                        <tr>
                                <td>{{$line->medicine}}</td>
                                <td class="text-center">₹{{$line->mrp}}</td>
                                <td class="text-center">{{$line->quantity}}</td>
                                <td class="text-right">₹{{$line->prize}}</td>
                            </tr>

                            @endforeach

                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                <td class="thick-line text-right">₹{{$orderDetail->subtotal}}</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Shipping</strong></td>
                                <td class="no-line text-right">₹{{$orderDetail->shipping_amount}}</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Discount</strong></td>
                                <td class="no-line text-right">₹{{$orderDetail->discount}}</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Total</strong></td>
                                <td class="no-line text-right">₹{{$orderDetail->charged_amount}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
