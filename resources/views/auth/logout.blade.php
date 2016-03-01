{!! Form::open(
     array(
         'route' => 'auth.logout',
         'class' => 'form',
         'novalidate' => 'novalidate')) !!}

<div class="form-group">
    {!! Form::submit('Logout',
            array('class'=>'btn btn-danger')) !!}
</div>
{!! Form::close() !!}