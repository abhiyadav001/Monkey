<h1 class="form-signin-heading text-center">Admin Dashboard</h1>

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
<h2>Users</h2>
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

