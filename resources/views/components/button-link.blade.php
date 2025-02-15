@props(['url'=>'/','icon'=>null,'bgColor'=>'white','hoverColor'=>'bg-gray-400','textColor'=>'text-orange-500','textHoverColor'=>'text-black'])
<a
href="{{$url}}"
class="block px-4 py-2 bg-{{$bgColor}} hover:{{$hoverColor}} {{$textColor}} hover:{{$textHoverColor}}"
>
   @if($icon)
   <i class="fa fa-{{$icon}}"></i>
   @endif
    {{$slot}}
</a>