<table class="table @if($model=='')table-striped @endif @if($model=='non-striped') @endif  table-bordered  table-condensed table-hover" id="{{$id}}" width="100%">
    <thead class="t-dark">
      <tr>
      	@foreach($field as $f)
        <th @if($f['width']!='')width="{{$f['width']}};"@endif><center>{{$f['name']}}</center></th>
        @endforeach
      </tr>
    </thead>
	<tbody></tbody>
</table>