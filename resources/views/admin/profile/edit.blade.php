@extends('front.layouts.master')

@section('contenu')
    <!-- section begin -->
    <section id="subheader" class="jarallax text-light">
        <img src="{{ asset('front/images/background/2.jpg') }}" class="jarallax-img" alt="">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>Profil</h1>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="section-cars" class="bg-gray-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 mb30">
                    @include('front.client.include.side')
                </div>
                <div class="col-lg-9">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card p-4 rounded-5 mb25">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('front.client.profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>
                    <div class="card p-4 rounded-5 mb25">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('front.client.profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card p-4 rounded-5 mb25">
                    <div class="row">
                        <div class="col-lg-12">
                            @include('front.client.profile.partials.delete-user-form')
                        </div>
                    </div>
                </div> --}}
                </div>
            </div>
        </div>
    </section>
@endsection
