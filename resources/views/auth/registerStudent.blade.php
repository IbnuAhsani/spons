@extends('layouts.app')

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/registerStudent.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@endpush

@push('styles')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li><a href="#studentIndividual" data-toggle="tab">Student Individual</a></li>
                    <li><a href="#studentOrganization" data-toggle="tab">Student Organization</a></li>
                </ul>

                <div class="tab-content pt-5 pb-5">
                    <div class="tab-pane active" id="studentIndividual">
                        <form id="studentIndividual" class="tabcontent" method="POST" action="{{ route('registerStudent') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                <div class="col-md-6">
                                    <input id="dob" type="date" class="form-control" name="dob" required>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                                <div class="col-md-6">
                                    <input id="city" type="text" name="city" class="form-control" required>

                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="major" class="col-md-4 col-form-label text-md-right">{{ __('Major') }}</label>

                                <div class="col-md-6">
                                    <input id="major" type="text" class="form-control" name="major" required>

                                    @if ($errors->has('major'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('major') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="faculty" class="col-md-4 col-form-label text-md-right">{{ __('Faculty') }}</label>

                                <div class="col-md-6">
                                    <input id="faculty" type="text" class="form-control" name="faculty" required>

                                    @if ($errors->has('faculty'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('faculty') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="university" class="col-md-4 col-form-label text-md-right">{{ __('University') }}</label>

                                <div class="col-md-6">
                                    <input id="university" type="text" class="form-control" name="university" required>

                                    @if ($errors->has('university'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('university') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <input id="role" type="hidden" name="role" value={{ Constant::ROLE_STUDENT_INDIVIDUAL }}>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                    <a class="btn btn-outline-success my-2 my-sm-0" role="button" href="{{ route('registerCompany') }}">{{ __('Register as Company') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="studentOrganization">
                        <form id="studentOrganization" class="tabcontent" method="POST" action="{{ route('registerStudent') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="established_in" class="col-md-4 col-form-label text-md-right">{{ __('Established In') }}</label>

                                <div class="col-md-6">
                                    <input id="established_in" type="date" class="form-control" name="established_in" required>

                                    @if ($errors->has('established_in'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('established_in') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" required>

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="major" class="col-md-4 col-form-label text-md-right">{{ __('Major') }}</label>

                                <div class="col-md-6">
                                    <input id="major" type="text" class="form-control" name="major" required>

                                    @if ($errors->has('major'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('major') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="university" class="col-md-4 col-form-label text-md-right">{{ __('University') }}</label>

                                <div class="col-md-6">
                                    <input id="university" type="text" class="form-control" name="university" required>

                                    @if ($errors->has('university'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('university') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="text" class="form-control" name="description" required></textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <input id="role" type="hidden" name="role" value={{ Constant::ROLE_STUDENT_ORGANIZATION }}>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                    <a class="btn btn-outline-success my-2 my-sm-0" role="button" href="{{ route('registerCompany') }}">{{ __('Register as Company') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
