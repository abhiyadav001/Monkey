<h1 class="form-signin-heading text-center">Admin Dashboard</h1>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#passcodes">Users Passcodes</a></li>
    <li><a data-toggle="tab" href="#orders">Orders</a></li>
    <li><a data-toggle="tab" href="#medicines">Medicines</a></li>
    <li><a data-toggle="tab" href="#app-settings">App Settings</a></li>
</ul>


<div class="tab-content">
<div id="passcodes" class="tab-pane fade in active">
    <h3>Users</h3>
    <input type="text" id="search" placeholder="Enter Mobile Number"/>
    <input type="button" id="button" value="Search Passcode"/>

    <div id="result"></div>
    <script type="text/javascript">
        $(document).ready(function () {
            function search() {
                var mobile = $("#search").val();
                if (mobile != "") {
                    $.ajax({
                        type: "post",
                        url: "/search-passcode",
                        data: "mobile=" + mobile,
                        success: function (data) {
                            var trHTML = '';
                            $("#userresult").empty();
                            var jsonstring = $.parseJSON(data);
                            $.each(jsonstring, function (index, value) {
                                trHTML += '<tr id=' + value.mobile_number + '><td>' + value.mobile_number + '</td><td>' + value.passcode + '</td><td>'
                                    + value.verified_status + '</td><td>' + value.created_at + '</td></tr>';
                            });
                            $('#userresult').append(trHTML);

                        }
                    });
                }
            }

            $("#button").click(function () {
                search();
            });
            $('#search').keyup(function (e) {
                if (e.keyCode == 13) {
                    search();
                }
            });
        });
    </script>
    <table class="table table-striped table-bordered header-fixed">
        <thead>
        <tr>
            <th>Mobile</th>
            <th>Passcode</th>
            <th>Verified Status</th>
            <th>Created At</th>
        </tr>
        </thead>
        <tbody id="userresult">
        @foreach ($passcodes as $passcode)
        <tr>
            <td>{{ $passcode->mobile_number }}</td>
            <td>{{ $passcode->passcode}}</td>
            <td>{{ $passcode->verified_status }}</td>
            <td>{{ $passcode->created_at }}</td>

        </tr>
        @endforeach

        </tbody>
    </table>
    <?php echo $passcodes->links(); ?>
</div>

<div id="orders" class="tab-pane fade">
    <h3>Orders</h3>
    <table class="table table-striped table-bordered header-fixed">
        <thead>
        <tr>
            <th>Order ID</th>
            <th>Buyer Name</th>
            <th>Total Amt</th>
            <th>Discount</th>
            <th>Shipping Amt</th>
            <th>Charged Amt</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
        <tr>
            <td><a href="/get-order/<?php echo $order->id; ?>">{{ $order->id }}</a></td>
            <td>{{ $order->full_name}}</td>
            <td>₹{{ $order->subtotal }}</td>
            <td>₹{{ $order->discount }}</td>
            <td>₹{{ $order->shipping_amount }}</td>
            <td>₹{{ $order->charged_amount }}</td>
            <td>{{ $order->created_at }}</td>
            <?php
            $statusValues = array('created', 'delivered', 'canceled', 'closed');
            $key = array_search($order->status, $statusValues);

            if ($key == 0)
                $newStatusValue = array('delivered', 'canceled', 'closed');
            elseif ($key == 1)
                $newStatusValue = array('created', 'canceled', 'closed');
            elseif ($key == 2)
                $newStatusValue = array('created', 'delivered', 'closed');
            else
                $newStatusValue = array('created', 'delivered', 'canceled');
            ?>
            <td>
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" id="status-button" type="button"
                            data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true">
                        {{ $order->status }}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#" id="{{ $order->id }}">{{$newStatusValue[0]}}</a></li>
                        <li><a href="#" id="{{ $order->id }}">{{$newStatusValue[1]}}</a></li>
                        <li><a href="#" id="{{ $order->id }}">{{$newStatusValue[2]}}</a></li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>
    
    <?php echo $orders->links(); ?>
                    <script type="text/javascript">
                    $(document).ready(function () {
                        function updateValue(id,status) {
                            if (status != "") {
                                $.ajax({
                                    type: "post",
                                    url: "/update-status",
                                    data: {"status": status, "id": id},
                                    success: function (data) {
                                        if(data=='success'){
                                            alert('Status successfully updated.');
                                        }
                                    }
                                });
                            }
                        }
                    $(".dropdown-menu li a").click(function () {
                        var id = $(this).attr('id');
                        var status = $(this).text();
                        $(this).parents(".dropdown").find('.btn').html(status + ' <span class="caret"></span>');
                        $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
                        updateValue(id,status);
                    });
                    });
                </script>
</div>
<div id="medicines" class="tab-pane fade">
    <h3>Orders</h3>
    <table class="table table-striped table-bordered header-fixed">
        <thead>
        <tr>
            <th>Order ID</th>
            <th>Buyer Name</th>
            <th>Total Amt</th>
            <th>Discount</th>
            <th>Shipping Amt</th>
            <th>Charged Amt</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($medicines as $medicine)
        <tr>
            <td>{{ $medicine->name}}</td>
            <td>₹{{ $medicine->name }}</td>
            <td>₹{{ $medicine->name }}</td>
            <td>₹{{ $medicine->name }}</td>
            <td>₹{{ $medicine->name }}</td>
            <td>{{ $medicine->name }}</td>
            <td>{{ $medicine->name }}</td>
        </tr>
        @endforeach

        </tbody>
    </table>
    <?php echo $medicines->links(); ?>
</div>
<div id="app-settings" class="tab-pane fade">
    <h3>App Settings</h3>
    <table class="table table-striped table-bordered header-fixed">
        <thead>
        <tr>
            <th>Location</th>
            <th>Quick Delivery Status</th>
            <th>Discount%</th>
            <th>Minimum Order Amount</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($appSettings as $appsetting)
        <tr>
            <td>{{ $appsetting->location}}</td>
            <td>{{ $appsetting->quick_delivery_status }}</td>
            <td>{{ $appsetting->discount_percent }}</td>
            <td>{{ $appsetting->min_order }}</td>
            <td>{{ $appsetting->status }}</td>
        </tr>
        @endforeach

        </tbody>
    </table>
</div>
</div>


