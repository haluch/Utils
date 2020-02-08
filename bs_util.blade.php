@php
    isset($type) ? $type : $type = 'newline';
@endphp
@switch($type)

    @case('newline')
        <div class="clearfix hidden-xs hidden-sm">&nbsp;</div>
    @break

    @case('hidden')
        @php 
            isset($name)  ? $name  : $name  = ''; 
            isset($value) ? $value : $value = ''; 
        @endphp
            <input type="hidden" id="{{$name}}" name="{{$name}}" value="{{$value}}">
    @break

    @case('input')
        @php 
            isset($name)  ? $name  : $name  = ''; 
            isset($placeholder) ? $placeholder : $placeholder = ''; 
            isset($title) ? $title : $title = "" ; 
            isset($col) ? $col : $col = '12'; 
            isset($extra) ? $extra : $extra = ''; 
            isset($value) ? $value : $value = ''; 
            isset($selector) ? $selector : $selector = ''; 
            isset($color) ? $color : $color = 'dark'; 
            isset($color2) ? $color2 : $color2 = 'dark'; 
            isset($disabled ) ? $disabled : $disabled = ''; 
        @endphp
        <div class="form-group col-{{$col}} "  style="padding-left:2px; padding-right:2px; ">
            <label for="{{$name}}" class='small text-{{$color}}'  >{{$title}}</label>
            <input type="text" {{$disabled}} class="form-control form-control-sm text-{{$color2}} {{$selector}}" id="{{$name}}" name="{{$name}}" autocomplete="off" placeholder="{{$placeholder}}" {{$extra}} value="{{$value}}">
            @error($name) <small class="text-danger small">{{ $message }}</small> @enderror
        </div>
    @break

    @case('textarea')
        @php 
            isset($name)  ? $name  : $name  = ''; 
            isset($title) ? $title : $title = ''; 
            isset($col) ? $col : $col = '12'; 
            isset($value) ? $value : $value = ''; 
            isset($selector) ? $selector : $selector = ''; 
            isset($rows) ? $rows : $rows = '3'; 

        @endphp

            <div class="form-group col-{{$col}} " style="padding-left:2px; padding-right:2px;resize:none;">
                <label for="{{$name}}" class="small">{{ $title }}</label>
                <textarea class="form-control form-control-sm {{$selector}}" id="{{$name}}"  name="{{$name}}" rows="{{$rows}}" style="resize:none;" >{{$value}}</textarea>
            </div>
    @break


    @case('button')
        @php 
            isset($btnClass)  ? $btnClass = 'btn btn-outline-'. $btnClass  : $btnClass = 'btn btn-sm btn btn-outline-primary'; 
            isset($name)      ? $name   : $name  = 'btnSend' ;
            isset($title)     ? $title  : $title = 'Enviar'; 
            isset($col)       ? $col    : $col = '2'; 
          
        @endphp
        <div class="form-group col-{{$col}}" style="padding-left:2px; padding-right:2px; ">
            <label>&nbsp;</label>
            <button type="submit" class="{{$btnClass}}  col-12" name="{{$name}}" id="{{$name}}">{{$title}}</button>
        </div>
    @break

    @case('action')
        @php 
            isset($link) ? $link   : $link  = '/#' ;
            isset($class) ? $class : $class  = 'primary' ;
            isset($icon) ? $icon : $icon  = '' ;
            isset($title) ? $title : $title  = '' ;
            isset($extra) ? $extra : $extra  = '' ;
        @endphp
        <a href="{{ $link }}" {{$extra}} class="btn btn-sm btn-outline-{{$class}}"><i class="{{$icon }}" aria-hidden="true"></i>{{$title}}</a>
    @break


    @case('alert')
        @php 
            isset($alert)  ? $alert  : $alert = 'primary'; 
            isset($action) ? $action : $action = $alert; 
            isset($msg)    ? $msg    : $msg = 'Aviso'; 
        @endphp

        <div class="alert alert-{{$alert}} alert-dismissible fade show" role="alert">
            <strong>{{ $action }}</strong> {{ $msg }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @break

    @case('card')
        @php 
            isset($col)        ? $col       : $col       = 'col-12'; 
            isset($pathImage)  ? $pathImage : $pathImage = NULL; 
            isset($title)      ? $title     : $title     = 'Title'; 
            isset($msg)        ? $msg       : $msg       = ''; 
            isset($type)       ? $type      : $type      = 'primary btn-xs'; 
            isset($msgButton)  ? $msgButton : $msgButton = 'Enviar'; 
            isset($linkButton) ? $linkButton : $linkButton = '#'; 
        @endphp

        <div class="card {{$col}}">
            @if(isset($pathImage))
                <img class="card-img-top" src="{{$pathImage}}">
            @endif  
            <div class="card-body">
                <h5 class="card-title">{{$title}}</h5>
                <p class="card-text">{{$msg}}</p>
                <a href="{{$linkButton}}" class="btn btn-{{$type}}">{{$msgButton}}</a>
            </div>
        </div>
    @break

    @case('checkbox')
        @php 
            isset($name)  ? $name  : $name  = ''; 
            isset($value) ? $value : $value = ''; 
            isset($title) ? $title : $title = ''; 
        @endphp

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="{{$name}}" value="{{$value}}">
            <label class="form-check-label" for="{{$name}}">{{$title}}</label>
        </div>
    @break

    @case('radio')
        @php 
            isset($name)  ? $name  : $name  = ''; 
            isset($value) ? $value : $value = ''; 
            isset($title) ? $title : $title = ''; 
        @endphp

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="{{$name}}" id="{{$name}}" value="{{$value}}">
            <label class="form-check-label" for="{{$name}}">{{$title}}</label>
        </div>
    @break

    @case('select')
        @php 
            isset($name)  ? $name  : $name  = ''; 
            isset($title) ? $title : $title = '';
            isset($disable) ? $disable : $disable = 'Selecione';
            isset($col) ? $col : $col = '12';
            isset($arrOptions) ? $arrOptions : $arrOptions = ['M'=>'Masculino','F'=>'Feminino'];
        @endphp

      <div class="form-group col-{{$col}}"  style="padding-left:2px; padding-right:2px;">
            <label for="{{$name}}" class="small">{{$title}}</label>
            <select class="form-control form-control-sm " name="{{$name}}" id="{{$name}}">
                <option disabled>{{$disable}}</option>
                @foreach ($arrOptions as $k=>$v)
                    <option value="{{$k}}">{{$v}}</option>
                @endforeach
            </select>
        </div>
    @break

    @case('text')
        @php 
            isset($title) ? $title : $title = ''; 
            isset($col) ? $col : $col = 'col-12';
            isset($extra) ? $extra : $extra = ''; 
        @endphp
        
        <div class="{{$col}}" > <span {{$extra}}>{{$title}}</span>   </div>
    @break


    @case('upload')
    @php
        isset($title) ? $title : $title = 'Selecionar arquivo'; 
        isset($name) ?  $name : $name = 'btn';
        isset($col) ?  $col : $col = '12';
        isset($accept) ?  $accept : $accept = '.jpg';
        isset($class) ?  $class : $class = 'dark';

    @endphp
    <div class="col-12" style="padding-left:2px; padding-right:2px;">
        <label class="btn btn-outline-{{$class}} col-{{$col}}" for="{{ $name }}">{{ $title }}
            <input type="file" name="{{ $name }}" placeholder='a' id="{{ $name }}" accept="{{$accept}}" style="display:none1;"/>
        </label>
    </div>
@endswitch


