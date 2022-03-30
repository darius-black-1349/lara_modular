<textarea class="mt-2 mb-0" placeholder="{{  $placeholder  }}" name="{{  $name  }}" {{ $attributes }}>
    {!! isset($value) ? $value : old($name) !!}
</textarea>
<x-validation-error field="{{  $name  }}"></x-validation-error>
