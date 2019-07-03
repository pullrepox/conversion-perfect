@extends('layouts.base')
@section('styles')

@endsection
@section('title', 'Auto Responder Edit - ' . config('app.name'))
@section('content')
    <div class="main-content" id="autoresponder-edit-page">
        @include('layouts.page-header', ['data' => $header_data])
        {{-- Page content --}}
        <div class="container-fluid mt--8">
            <form action="{{$flag ? route('autoresponder.store') : route('autoresponder.update', $integration->id)}}"
                  method="POST" class="needs-validation" novalidate>
                @if(!$flag) @method('PUT') @endif
                @csrf
                {{-- bar Base Content --}}
                <div class="card">
                    <div class="card-header">
                        <div class="form-row">
                            <h3 class="mb-0 col">{{ $flag ? 'New' : 'Edit' }} Autoresponder</h3>
                            <div class="col text-right">
                                <button type="submit" class="btn btn-success btn-sm text-capitalize">{{ $flag ? 'Create' : 'Update' }}</button>
                                <a href="{{ secure_redirect(route('autoresponder.index')) }}" class="btn btn-light btn-sm text-capitalize">Cancel</a>
                                @if (!$flag)
                                    <button type="button" class="btn btn-sm btn-primary text-capitalize">Archive</button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body pb-0">
                        <div class="form-row">
                            <div class="col-md-4" id="auto-responder">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="auto-responder">
                                        Provider
                                    </label>
                                    <select data-toggle="select" class="form-control" name="responder_id" id="responder_id">
                                        <option value="" selected disabled>Select Provider</option>
                                        @foreach($responders as $list)
                                            <option {{'selected' ? isset($integration) && $integration->responder_id === $list->id : old('responder_id') === $list->id}}
                                                    value="{{$list->id}}">{{ucfirst($list->title)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4 responder-group" id="friendly-name" style="display: none">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="name" data-id="name">
                                        Friendly Name
                                    </label>
                                    <input type="text" value="{{isset($integration) && $integration->name ? $integration->name: old('name')}}"
                                           name="name" class="@error('name') is-invalid @enderror form-control required autocomplete="friendly_name"/>
                                    @if ($errors->has('name'))
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    @else
                                        <span class="invalid-feedback" role="alert">
                                            Please insert correct value.
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4 responder-group" id="api-key" style="display: none">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="api_key" data-id="api_key">
                                        API Key
                                    </label>
                                    <input type="text" value="{{isset($integration) && $integration->api_key ? $integration->api_key : old('api_key')}}"
                                           class="@error('api_key') is-invalid @enderror form-control" name="api_key" id="api_key"/>
                                    @if ($errors->has('api_key'))
                                        @error('api_key')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    @else
                                        <span class="invalid-feedback" role="alert">
                                            Please insert correct value.
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4 responder-group" id="hash" style="display:none;">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="hash_key" data-id="hash_key">
                                        Hash Key
                                    </label>
                                    <input type="text" value="{{isset($integration) && $integration->hash ? $integration->hash : old('hash')}}"
                                           class="@error('hash') is-invalid @enderror form-control" name="hash" id="hash"/>
                                    @if ($errors->has('hash'))
                                        @error('hash')
                                        <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                        @enderror
                                    @else
                                        <span class="invalid-feedback" role="alert">
                                        Please insert correct value.
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4 responder-group" id="url" style="display:none;">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="hash_key" data-id="hash_key">
                                        URL
                                    </label>
                                    <input type="text" value="{{isset($integration) && $integration->url ? $integration->url : old('url')}}"
                                           class="@error('hash') is-invalid @enderror form-control" name="url" id="url"/>
                                    @if ($errors->has('hash'))
                                        @error('hash')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    @else
                                        <span class="invalid-feedback" role="alert">
                                            Please insert correct value.
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        @include('layouts.footer')
    </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="{{asset('/assets/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script>
        $('#responder_id').select2({
        });
        const capitalize = (s) => {
            if (typeof s !== 'string') return ''
            return s.charAt(0).toUpperCase() + s.slice(1)
        }

    </script>
    {{--edit--}}
    @if(!$flag)
        <script>
            $(function () {
                var responder_id =  {!! json_encode($integration->responder->id) !!};
                var responder =  {!! json_encode($integration->responder) !!};
                console.log(responder_id);
                $('#responder_id').select2('val',responder_id.toString());
                adjustChanges(capitalize(responder.title));
            })
        </script>
    @else
        <script>
            $(function(){
                var data = {!! json_encode(old()) !!};
                var responder = $( "#responder_id  option[value="+data.responder_id+"]" ).text();
                if (responder !== ''){
                    $('#responder_id').select2('val',data.responder_id);
                    adjustChanges(responder);
                }
                $('#responder_id').change(function () {
                    $('.responder-group').hide();
                    var value = $('#responder_id option:selected').text();
                    adjustChanges(value)
                });

            })
        </script>
    @endif

    <script>
        function adjustChanges(value)
        {
            if (value === 'Sendlane'){
                $('#friendly-name').show();
                $('#api-key').show();
                $('#hash').show();
            } else if (value === 'Mailchimp'){
                $('#friendly-name').show();
                $('#api-key').show();
            } else if (value === 'Activecampaign'){
                $('#friendly-name').show();
                $('#url').show();
                $('#api-key').show();
            } else if (value === 'Sendy'){
                $('#friendly-name').show();
                $('#url').show();
                $('#api-key').show();
            } else if (value === 'Mailerlite'){
                $('#friendly-name').show();
                $('#api-key').show();
            } else if (value === 'Getresponse'){
                $('#friendly-name').show();
                $('#api-key').show();
            } else if (value === 'Sendinblue'){
                $('#friendly-name').show();
                $('#api-key').show();
            } else if (value === 'Campaignmonitor'){
                $('#friendly-name').show();
                $('#api-key').show();
            }
        }
    </script>

@endsection
