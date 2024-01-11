 @props(['type' => 'button', 'bgColor' => 'primary', 'label' => 'Submit'])

 <button type={{ $type }}
     {{ $attributes->merge(['class' => 'btn btn-' . $bgColor]) }}>{{ $label }}</button>
