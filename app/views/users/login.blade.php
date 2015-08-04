{{ Form::open(array('url'=>'admin-dashboard', 'class'=>'form-signin')) }}
    <h2 class="form-signin-heading">Please Login</h2>
    <div class="form-group">
    <label for="Username">Username</label>
    {{ Form::text('username', null, array('class'=>'input-block-level form-control', 'placeholder'=>'Email Address')) }}
    </div>
    <div class="form-group">
    <label for="Password">Password</label>
    {{ Form::password('password', array('class'=>'input-block-level form-control', 'placeholder'=>'Password')) }}
    </div>
    {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}