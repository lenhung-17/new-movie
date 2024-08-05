@if ($entities->isNotEmpty())
    <div class="category">
        <a href="{{ route('category.show', ['category_id' => $categoryId]) }}">
            <h3>{{ $title }}</h3>
        </a>
{{--        <div class="entities">--}}
{{--            @foreach ($entities as $entity)--}}
{{--                @include('entities._preview', ['entity' => $entity])--}}
{{--            @endforeach--}}
{{--        </div>--}}
    </div>
@endif
