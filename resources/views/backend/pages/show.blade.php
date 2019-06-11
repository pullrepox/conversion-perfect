@extends('backend.app')
@section('description',$page->excerpt)

@section('metas')
    <meta property="og:title" content="{{$page->title}}">
    <meta property="og:description" content="{{$page->excerpt}}">
    <meta property="og:url" content="{{route('pages.show',$page->slug)}}">
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card-wrapper">
                <!-- Custom form validation -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">{!! $page->title !!}</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                {!! $page->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection