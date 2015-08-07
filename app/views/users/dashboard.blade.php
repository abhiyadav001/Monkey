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
                    var mobile = $("#search").val();
                    if (mobile != "") {
                        $.ajax({
                            type: "post",
                            url: "/search-passcode",
                            data: "mobile=" + mobile,
                            success: function (data) {
                                var   trHTML='';
                                $("#userresult").empty();
                                //return false;
                                var jsonstring=$.parseJSON(data);
                                $.each(jsonstring, function( index, value ) {
  //alert( index + ": " + value.mobile_number );

                                //alert(index);
                                //return false;
                               trHTML += '<tr id='+value.mobile_number+'><td>' + value.mobile_number + '</td><td>' + value.passcode + '</td><td>' 
                                       + value.verified_status + '</td><td>'+value.created_at+'</td></tr>';
                               
                               });
                               $('#userresult').append(trHTML);
                                //alert(jstng.email);
                                //return false;
                                
                                //$("#result").html(data);
                                //$("#search").val("");
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
            @foreach ($order as $orders)
            <tr>
                <td><a href="/get-order/<?php echo $orders->id; ?>">{{ $orders->id }}</a></td>
                <td>{{ $orders->full_name}}</td>
                <td>₹{{ $orders->subtotal }}</td>
                <td>₹{{ $orders->discount }}</td>
                <td>₹{{ $orders->shipping_amount }}</td>
                <td>₹{{ $orders->charged_amount }}</td>
                <td>{{ $orders->created_at }}</td>
                <td>{{ $orders->status }}</td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>


