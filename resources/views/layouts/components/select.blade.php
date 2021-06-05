<link rel="stylesheet" href="/plugins/select2/select2.min.css">
<script src="/plugins/select2/select2.full.js"></script>

<label for="description" class="col-md-2 col-form-label text-md-right">{{$title}}</label>

<div class="col-md-6">
    <select name="{{$name?$name:''}}"
            {{isset($required)?'required':'' }} class="form-control select2 {{$class?$class:''}}">
        <option disabled="true" value="" {{!$selectedId ? 'selected="selected"' : ''}}>Selecione</option>
        @foreach( $values as $value )
            <option
                {{$selectedId && $selectedId == $value->id ? 'selected="selected"' : ''}} value="{{$value->id}}">{{$value->title}}</option>
        @endforeach
    </select>
</div>

<script type="text/javascript">
    $(document).ready( function ()
    {
        $('.select2').select2();
    });
</script>
