@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
		@lang('messages.new_form')
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
		    @include('common.errors')
<div id="ajax-error" class="collapse alert alert-danger">
@lang('messages.whoops')
</div>

@if (isset($form))
		    <form action="{{ url('forms/' . $form->id)}}" method="POST" class="form-horizontal">
{{ method_field('PUT') }}
@else
		    <form action="{{ url('forms')}}" method="POST" class="form-horizontal">
@endif
		     {{ csrf_field() }}
<div class="form-group">
<label for="name" class="col-sm-3 control-label mandatory">
@lang('messages.name')
</label>
	    <div class="col-sm-6">
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', isset($form) ? $form->name : null) }}">
            </div>
</div>
<div class="form-group">
    <label for="measured_type" class="col-sm-3 control-label mandatory">
@lang('messages.form_type')
</label>
        <a data-toggle="collapse" href="#hintd" class="btn btn-default">?</a>
<div class="col-sm-6">
	<?php $selected = old('measured_type', isset($form) ? $form->measured_type : null); ?>
	<select name="measured_type" id="measured_type" class="form-control" >
	@foreach ( App\ODBTrait::OBJECT_TYPES as $type )
		<option value="{{$type}}" {{ $type == $selected ? 'selected' : '' }}>
            @lang ('classes.'.$type)
		</option>
	@endforeach
	</select>
</div>
  <div class="col-sm-12">
    <div id="hintd" class="panel-collapse collapse">
@lang('messages.hint_form_type')
    </div>
  </div>
</div>
<?php 
// Loop and create boxes for all traits
// how many traits do we have? 3 for default
$length = isset($form) ? count($form->traits) : 3;
for ($i = 1; $i <= $length; $i++) {
?>
<div class="form-group">
    <label for="trait.{{$i}}" class="col-sm-3 control-label mandatory">
@lang('messages.trait') {{ $i }}
</label>
    <div class="col-sm-6" id="trait.{{$i}}">
    <input type="text" name="trait_autocomplete[{{$i}}]" id="trait_autocomplete[{{$i}}]" class="form-control autocomplete"
    value="{{ old('trait_autocomplete.'.$i, (isset($form) and $form->traits) ? $form->getTrait($i)->name : null) }}">
    <input type="hidden" name="trait_id[{{$i}}]" id="trait_id[{{$i}}]"
    value="{{ old('trait_id.'.$i, (isset($form) and $form->trait) ? $form->getTrait($i)->id : null) }}">
    </div>
    <div class="col-sm-2">
        <i class="glyphicon glyphicon-minus"></i>
        @if ($i != 1)
        <i class="glyphicon glyphicon-chevron-up"></i>
        @endif
        @if ($i != $length)
        <i class="glyphicon glyphicon-chevron-down"></i>
        @endif
    </div>
</div>

<?php } ?>

<div class="form-group">
<div class="col-sm-offset-3 col-sm-6">
        <i class="glyphicon glyphicon-plus"></i>
</div>
</div>

<div class="form-group">
<label for="notes" class="col-sm-3 control-label">
@lang('messages.notes')
</label>
	    <div class="col-sm-6">
    <textarea name="notes" id="notes" class="form-control">{{ old('notes', isset($form) ? $form->notes : null) }}</textarea>
            </div>

		        <div class="form-group">
			    <div class="col-sm-offset-3 col-sm-6">
				<button type="submit" class="btn btn-success" name="submit" value="submit">
				    <i class="fa fa-btn fa-plus"></i>
@lang('messages.add')
				</button>
				<a href="{{url()->previous()}}" class="btn btn-warning">
				    <i class="fa fa-btn fa-plus"></i>
@lang('messages.back')
				</a>
			    </div>
			</div>
		    </form>
        </div>
    </div>
@endsection
@push ('scripts')
<script>
$(document).ready(function() {
    // Sets the autocomplete on the previously available elements
<?php for ($i = 1; $i <= $length; $i++) { ?>
    $("#trait_autocomplete\\[{{$i}}\\]").odbAutocomplete("{{url('traits/autocomplete')}}","#trait_id\\[{{$i}}\\]", "@lang('messages.noresults')", null,
        {'type': $("#measured_type option:selected").val() }
    );
<?php } ?>
});
</script>
@endpush
