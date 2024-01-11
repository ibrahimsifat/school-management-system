 {{-- @props(['name' => '', 'htmlFor' => '', 'type' => '', 'label' => '', 'placeholder' => ' ']) --}}
 {{-- @props(['name' => '', 'htmlFor' => '', 'type' => '', 'label' => '', 'placeholder' => ' ', 'value' => '']) --}}

 <div class="form-group">
     <label for={{ $htmlFor }}>{{ $label }} </label>
     <input type={{ $type }} class="form-control" id={{ $htmlFor }} name={{ $name }}
         required={{ $required }} placeholder={{ $placeholder }} value={{ $value }}>
 </div>
