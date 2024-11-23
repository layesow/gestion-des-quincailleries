@extends('admin.layouts.master')
@section('contenu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Profil</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active">profil</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ asset('avatar/user.png') }}"
                         alt="User profile picture">
                  </div>

                  <h3 class="profile-username text-center mt-3">{{ ucfirst(Auth::user()->prenom) }} {{ strtoupper(Auth::user()->name) }}</h3>

                  <p class="text-muted text-center">{{ Auth::user()->email }}</p>

                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>Votre statut</b> : <a class="float-right">{{ Auth::user()->statut }}</a>
                    </li>
                    @php
                        use App\Models\Agence;
                        $agence_id = Auth::user()->agence_id;
                        $agence = Agence::find($agence_id);
                    @endphp

                    @if($agence)
                        <li class="list-group-item">
                            <b>Votre Agence</b>: <a class="float-right">{{ $agence->name }}</a>
                        </li>
                    @endif

                  </ul>

                  {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            {{-- <div class="col-md-9">
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
              <div class="card">
                <div class="card-header">
                    <h4 class="active"><span>Profil</span></h4>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                      <!-- Post -->
                      @include('admin.profil.partials.update-profile-information-form')
                      <!-- /.post -->
                  </div>
                </div><!-- /.card-body -->
              </div>

              <div class="card">
                <div class="card-header">
                    <h4 class="active"><span>Mettre à jour le mot de passe</span></h4>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                      <!-- Post -->
                      @include('admin.profil.partials.update-password-form')
                      <!-- /.post -->
                  </div>
                </div><!-- /.card-body -->

              </div>
              <!-- /.card -->
            </div> --}}

            <div class="col-md-9">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Modifier votre Profil</a></li>
                      {{-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Modifier votre mot de passe</a></li> --}}
                    </ul>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="active tab-pane" id="activity">
                            <div class="tab-content">
                                <!-- Post -->
                                @include('admin.profil.partials.update-profile-information-form')
                                <!-- /.post -->
                            </div>
                      </div>
                      <!-- /.tab-pane -->
                      {{-- <div class="tab-pane" id="timeline">
                        <div class="tab-content">
                            <!-- Post -->
                            @include('admin.profil.partials.update-password-form')
                            <!-- /.post -->
                        </div>
                      </div> --}}
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="active"><span>Mettre à jour le mot de passe</span></h4>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                    <div class="tab-content">
                        <!-- Post -->
                        @include('admin.profil.partials.update-password-form')
                        <!-- /.post -->
                    </div>
                    </div><!-- /.card-body -->

                </div>
                <!-- /.card -->
                </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
</div>
@endsection
