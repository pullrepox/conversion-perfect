@extends('layouts.base')
@section('title', 'Integration Edit - ' . config('app.name'))
@section('content')
    <div class="main-content" id="autoresponder-edit-page">
        @include('layouts.page-header', ['data' => $header_data])
        {{-- Page content --}}
        <div class="container-fluid mt--8">
            <form action="{{ $flag ? route('autoresponder.store') : route('autoresponder.update', $integration->id) }}"
                  method="POST" class="needs-validation" novalidate>
                @csrf
                @if(!$flag) @method('PUT') @endif
                {{-- bar Base Content --}}
                <div class="card">
                    <div class="card-header">
                        <div class="form-row">
                            <h3 class="mb-0 col">{{ $flag ? 'New' : 'Edit' }} Integration</h3>
                            <div class="col text-right">
                                <button type="submit" class="btn btn-success btn-sm text-capitalize" id="edit-button">{{ $flag ? 'Create' : 'Update' }}</button>
                                <button type="button" class="btn btn-success btn-sm text-capitalize" id="connect-button">Connect To Aweber</button>
                                <a href="{{ secure_redirect(route('autoresponder.index')) }}" class="btn btn-light btn-sm text-capitalize">Cancel</a>
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
                                                    value="{{$list->id}}">{{ ucfirst($list->title) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 responder-group" id="friendly-name">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="name">
                                        Friendly Name
                                    </label>
                                    <input type="text" value="{{isset($integration) && $integration->name ? $integration->name: old('name')}}"
                                           name="name" id="name" class="@error('name') is-invalid @enderror form-control" required autocomplete="name"/>
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
                            
                            <div class="col-md-4 responder-group" id="api-key_div">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="api_key">
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
                            
                            <div class="col-md-4 responder-group" id="hash_div">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="hash" id="hash_label">
                                        {{ !$flag && $integration->responder->title == 'Campaign Monitor' ? 'Client ID' : 'Hash Key' }}
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
                            
                            <div class="col-md-4 responder-group" id="url_div">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="url">
                                        URL
                                    </label>
                                    <input type="text" value="{{isset($integration) && $integration->url ? $integration->url : old('url')}}"
                                           class="@error('url') is-invalid @enderror form-control" name="url" id="url"/>
                                    @if ($errors->has('url'))
                                        @error('url')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <script type="text/javascript">
        $('#responder_id').select2({});
        const capitalize = (s) => {
            if (typeof s !== 'string') return '';
            return s.charAt(0).toUpperCase() + s.slice(1)
        };
        var create_edit = '{!! $flag !!}';
    </script>
    {{--edit--}}
    @if(!$flag)
        <script type="text/javascript">
            $(function () {
                var responder_id = '{!! $integration->responder->id !!}';
                var responder = JSON.parse('{!! json_encode($integration->responder) !!}');
                $('#responder_id').select2('val', responder_id);
                adjustChanges(capitalize(responder.title));
            })
        </script>
    @else
        <script type="text/javascript">
            $(function () {
                var data = JSON.parse('{!! json_encode(old()) !!}');
                var responder = $("#responder_id  option[value=" + data.responder_id + "]").text();
                if (responder !== '') {
                    $('#responder_id').select2('val', data.responder_id);
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
    
    <script type="text/javascript">
        function adjustChanges(value) {
            $('#edit-button').show();
            $('#connect-button').hide();
            if (value === 'Sendlane') {
                $('#friendly-name').show();
                $('#api-key_div').show();
                $('#hash_div').show();
                $('#hash_label').html('Hash Key');
            } else if (value === 'MailChimp') {
                $('#friendly-name').show();
                $('#api-key_div').show();
            } else if (value === 'ActiveCampaign') {
                $('#friendly-name').show();
                $('#url_div').show();
                $('#api-key_div').show();
            } else if (value === 'Sendy') {
                $('#friendly-name').show();
                $('#url_div').show();
                $('#api-key_div').show();
            } else if (value === 'MailerLite') {
                $('#friendly-name').show();
                $('#api-key_div').show();
            } else if (value === 'GetResponse') {
                $('#friendly-name').show();
                $('#api-key_div').show();
            } else if (value === 'Send In Blue') {
                $('#friendly-name').show();
                $('#api-key_div').show();
            } else if (value === 'Campaign Monitor') {
                $('#friendly-name').show();
                $('#api-key_div').show();
                $('#hash_label').html('Client ID');
                $('#hash_div').show();
            } else if (value === 'Aweber') {
                $('#friendly-name').show();
                if (create_edit === '1') {
                    $('#edit-button').hide();
                    $('#connect-button').show();
                } else {
                    $('#edit-button').show();
                    $('#connect-button').hide();
                }
            }
        }

        $('#connect-button').on('click', function () {
            if ($('#name').val() === '') {
                window.commonNotify('top', 'right', 'fas fa-bug', 'danger', null, 'Please insert a friendly name', '', 'animated fadeInDown', 'animated fadeOutUp');
                return false;
            }
            
            var url = '{{ secure_redirect(route('integration.aweber-connect')) }}' + '?name=' + $('#name').val() + '&responder_id=' + $('#responder_id').val();
            url += '&_token=' + '{{ csrf_token() }}&number_key=' + '{{ auth()->user()->id }}';
            window.open(url, 'Aweber Authentication', 'width=700,height=700');
        });
    </script>
@endsection
