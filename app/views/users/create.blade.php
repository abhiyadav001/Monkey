@if(($user->id))
{{ Form::model($user, ['route' => ['app-users.update', $user->id], 'method' => 'PUT','class'=>'form-signup','enctype'=>'multipart/form-data']) }}
@else
{{ Form::open(array('url'=>'app-users', 'class'=>'form-signup','enctype'=>'multipart/form-data')) }}
@endif
<h2 class="form-signin-heading">Create User</h2>
<div class="form-group">
    <label for="User Type">User Type</label>
    {{ Form::select('type',array(''=>'--Select--','driver'=>'Driver','valet'=>'Valet'),null, array('class' => 'form-control'))}}
</div>
<div class="form-group">
    <label for="First Name">First Name</label>
    {{ Form::text('first_name', null, array('class'=>'input-block-level form-control', 'placeholder'=>'First Name')) }}
</div>
<div class="form-group">
    <label for="Last Name">Last Name</label>
    {{ Form::text('last_name', null, array('class'=>'input-block-level form-control', 'placeholder'=>'Last Name')) }}
</div>
<div class="form-group">
    <label for="Car Type">Car Type</label>
    {{ Form::select('car_type_id',$cars,null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    <label for="Image">Image(for best resolution 100*100)</label>
    {{ Form::file('image',array('id'=>'image','accept'=>"image/*"))}}
    @if(($user->image_hash))
    {{HTML::image("img/profile/$user->image_hash", "Profile Pic",array( 'width' => 100, 'height' => 100 ))}}
    @endif
</div>
<div class="form-group">
    <label for="Mobile Number">Mobile Number</label>
    @if(($user->id))
    {{ Form::text('mobile_number', null, array('class'=>'input-block-level form-control', 'disabled'=>'true','placeholder'=>'Mobile Number')) }}
    @else
    {{ Form::text('mobile_number', null, array('class'=>'input-block-level form-control','placeholder'=>'Mobile Number')) }}
    @endif
</div>
<div class="form-group">
    <label for="Address">Address</label>
    {{ Form::text('address',null, array('class'=>'input-block-level form-control', 'placeholder'=>'Address')) }}
</div>
<div class="form-group">
    <label for="Licence">Licence</label>
    {{ Form::text('licence',null, array('class'=>'input-block-level form-control', 'placeholder'=>'Licence'))
    }}
</div>
<div class="form-group">
    <label for="Status">Status</label>
    {{ Form::select('status',array('inactive'=>'inactive','deleted'=>'deleted'),null, array('class' => 'form-control'))}}
</div>
{{ Form::submit('Save', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}

<script type="text/javascript">
    $(document).ready(function () {
        if (window.File && window.FileList && window.FileReader) {
            $("#image").on("change", function (e) {
                $('img').remove();
                var files = e.target.files,
                        filesLength = files.length;
                for (i = 0; i < filesLength; i++) {
                    var f = files[i];
                    var fileReader = new FileReader();
                    fileReader.onload = (function (e) {
                        var file = e.target;
                        $("<img></img>", {
                            width: "100",
                            height: "100",
                            src: file.result,
                            title: file.name
                        }).insertAfter("#image");
                    });
                    fileReader.readAsDataURL(f);
                }
            });
        } else {
            alert("Your browser doesn't support to File API");
            return false;
        }
    });
</script>