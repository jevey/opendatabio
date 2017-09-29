@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('messages.trait')
                </div>
		<div class="panel-body">
<p><strong>
@lang('messages.name')
: </strong>
{{ $odbtrait->name }}
</p>
<p><strong>
@lang('messages.description')
: </strong>
{{ $odbtrait->description }}
</p>
<p><strong>
@lang('messages.type')
: </strong>
@lang ('levels.traittype.' . $odbtrait->type)
</p>
<p><strong>
@lang('messages.export_name')
: </strong>
{{ $odbtrait->export_name }}
</p>

@if ($odbtrait->object_types) 
<p><strong>
    @lang('messages.object_types')
:</strong><ul>
@foreach ($odbtrait->object_types as $obtype)
    <li>@lang ('classes.' .  $obtype->object_type )</li>
@endforeach
</ul>
@endif

@if ( in_array( $odbtrait->type, [\App\ODBTrait::QUANT_INTEGER, \App\ODBTrait::QUANT_REAL]))
    @if ($odbtrait->unit)
    <p><strong>
    @lang('messages.unit')
    : </strong>
    {{ $odbtrait->unit }}
    </p>
    @endif
    @if ($odbtrait->range_min or $odbtrait->range_max)
    <p><strong>
    @lang('messages.range')
    : </strong>
    {{ $odbtrait->range_min }} - {{ $odbtrait->range_max }}
    </p>
    @endif
@endif

@if ( in_array( $odbtrait->type, [\App\ODBTrait::CATEGORICAL, \App\ODBTrait::CATEGORICAL_MULTIPLE, \App\ODBTrait::ORDINAL]) and $odbtrait->categories)
<p><strong>@lang('messages.categories'):</strong></p>
<table class="table table-striped"> <thead>
@if ($odbtrait->type == \App\ODBTrait::ORDINAL)
    <th>
@lang('messages.rank')</th>
@endif
 <th>
 @lang('messages.name')
</th>
 <th>
 @lang('messages.description')
</th>

</thead>
<tbody>
@foreach ($odbtrait->categories as $cat)
<tr>
@if ($odbtrait->type == \App\ODBTrait::ORDINAL)
    <td>{{$cat->rank}}</td>
@endif
    <td> {{$cat->name}}</td>
    <td> {{$cat->description}}</td>
</tr>
@endforeach
</tbody>
</table>
@endif

@can ('update', $odbtrait)
			    <div class="col-sm-6">
				<a href="{{ url('traits/'. $odbtrait->id. '/edit')  }}" class="btn btn-success" name="submit" value="submit">
				    <i class="fa fa-btn fa-plus"></i>
@lang('messages.edit')

				</a>
			    </div>
@endcan
                </div>
            </div>
<!-- Other details (specialist, herbarium, collects, etc?) -->
    </div>
@endsection