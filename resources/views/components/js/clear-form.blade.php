@if($tag=='input') $("#{{$id}} input[name={{$name}}]").val(''); @endif
@if($tag=='textarea') $("#{{$id}} textarea[name={{$name}}]").text(''); @endif
@if($tag=='select') $("#{{$id}} select[name={{$name}}]").val(''); $("#{{$id}} select[name={{$name}}]").trigger('change');@endif