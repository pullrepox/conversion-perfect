<!-- Header -->
<div class="header bg-cp pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-5">
{{--                <div class="col-lg-6 col-7">--}}
{{--                    <h6 class="h2 text-white d-inline-block mb-0">{{ $data['main_name'] }}</h6>--}}
{{--                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">--}}
{{--                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">--}}
{{--                            <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>--}}
{{--                            @foreach($data['parent_data'] as $row)--}}
{{--                                <li class="breadcrumb-item">--}}
{{--                                    @if ($row['parent_url'] != '')--}}
{{--                                        <a href="{{ $row['parent_url'] }}">{{ $row['parent_name'] }}</a>--}}
{{--                                    @else--}}
{{--                                        <a href="#">{{ $row['parent_name'] }}</a>--}}
{{--                                    @endif--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                            <li class="breadcrumb-item active" aria-current="page">--}}
{{--                                {{ $data['main_name'] }}--}}
{{--                            </li>--}}
{{--                        </ol>--}}
{{--                    </nav>--}}
{{--                </div>--}}
{{--                <div class="col-lg-6 col-5 text-right">--}}
{{--                    @if ($data['button_show'])--}}
{{--                        @foreach($data['button_data'] as $row)--}}
{{--                            @if ($row['button_url'] != '' && $row['button_text'] != '')--}}
{{--                                <a href="{{ $row['button_url'] }}" class="btn btn-sm btn-neutral">{!! $row['button_text'] !!}</a>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>
