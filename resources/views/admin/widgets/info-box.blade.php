<div {!! $attributes !!}>
    <div class="inner text-center">
        <p>{{ $name }}</p>
        <h3>{{ $info }}</h3>
    </div>
    <div class="icon">
        <i class="fa fa-{{ $icon }}"></i>
    </div>
    <a href="{{ $link }}" class="small-box-footer">
        {{ trans('admin.more') }}&nbsp;
        <i class="fa fa-arrow-circle-right"></i>
    </a>
</div>