@props([
    'name','value','lable'=>false
])
@if ($lable)
<lable for=''>
    {{$lable}}
</lable>
@endif

<textarea
name="{{$name}}" @class([
'form-control','is-invaled'=>$errors->has('name')])
>{{old($name,$value)}}
</textarea>
@error($name)
<div
class="text-danger">
{{$message}}
</div>
@enderror