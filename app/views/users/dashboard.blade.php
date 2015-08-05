<h1 class="form-signin-heading text-center">Admin Dashboard</h1>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#users">Users</a></li>
    <li><a data-toggle="tab" href="#orders">Orders</a></li>
</ul>


<div class="tab-content">
    <div id="users" class="tab-pane fade in active">
        <h3>Users</h3>
        <input type="text" id="search" placeholder="Enter Mobile Number"/>
        <input type="button" id="button" value="Search Passcode"/>

        <div id="result"></div>
        <script type="text/javascript">
            $(document).ready(function () {
                function search() {
                    var title = $("#search").val();
                    if (title != "") {
                        $("#result").html("<img alt=' ajax search ' src='ajax-loader.gif'/>");
                        $.ajax({
                            type: "post",
                            url: "/search-passcode",
                            data: "title=" + title,
                            success: function (data) {
                                $("#result").html(data);
                                $("#search").val("");
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
                <th>Full Name</th>
                <th>Email</th>
                <th>Passcode</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($user as $users)
            <tr>
                <td>{{ $users->mobile_number }}</td>
                <td>{{ $users->full_name}}</td>
                <td>{{ $users->email }}</td>
                <td>{{ $users->passcode }}</td>

            </tr>
            @endforeach

            </tbody>
        </table>

    </div>
    <div id="orders" class="tab-pane fade">
        <h3>Orders</h3>
        <table class="table table-striped table-bordered header-fixed">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Buyer ID</th>
                <th>Total Amt</th>
                <th>Tax</th>
                <th>Discount</th>
                <th>Shipping Amt</th>
                <th>Charged Amt</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($order as $orders)
            <tr>
                <td><a href="/get-order/<?php echo $orders->id; ?>">{{ $orders->id }}</a></td>
                <td>{{ $orders->user_id}}</td>
                <td>{{ $orders->subtotal }}</td>
                <td>{{ $orders->tax }}</td>
                <td>{{ $orders->discount }}</td>
                <td>{{ $orders->shipping_amount }}</td>
                <td>{{ $orders->charged_amount }}</td>
                <td>{{ $orders->created_at }}</td>
                <td>{{ $orders->status }}</td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>


