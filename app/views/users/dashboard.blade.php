<h1 class="form-signin-heading text-center">Admin Dashboard</h1>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#passcodes">Users Passcodes</a></li>
    <li><a data-toggle="tab" href="#orders">Orders</a></li>
    <li><a data-toggle="tab" href="#medicines">Medicines</a></li>
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
                <td>{{ $order->status }}</td>
            </tr>
            @endforeach

            </tbody>
        </table>
        <?php echo $orders->links(); ?>
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
</div>


