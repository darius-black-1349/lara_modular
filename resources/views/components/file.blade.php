<div class="file-upload mb-0 mt-2">
    <div class="i-file-upload">
        <span>{{  $placeholder  }}</span>
        <input type="file" class="file-upload" id="files"  name="{{  $name  }}" {{  $attributes  }}/>
    </div>
    <span class="filesize"></span>
    @if(isset($value))
        <span class="selectedFiles">
            <img src="{{  $value->thumb  }}" width="150" alt="">
        </span>
    @else
        <span class="selectedFiles">فایلی انتخاب نشده است</span>
    @endif
    <x-validation-error field="{{  $name  }}"></x-validation-error>
</div>
