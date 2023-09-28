@props(["route"=>"", "icon"=>"fas fa-copy", "title", "small"=>"", "class"=>"", "idModel"=>""])

@if($route)
<a href='{{$route}}&copy=1&idModel={{$idModel}}'
    class='btn btn-success {{($small=='true')? 'btn-sm' : ''}} {{$class}}'
    data-toggle="tooltip"
    title="{{ $title }}">
    <i class="{{$icon}}"></i>
    {{ $slot }}
</a>
@else
<button type="submit"
    class='btn btn-success {{($small=='true')? 'btn-sm' : ''}} {{$class}}'
    data-toggle="tooltip"
    title="{{ $title }}">
    <i class="{{$icon}}"></i>
    {{ $slot }}
</button>
@endif
