@extends('admin.admin_master')
@section('admin')

<div class="page-content">
<div class="container-fluid">
<div class="row">
    <div class="col-md-6 col-xl-6">

        <!-- Simple card -->
        <div class="card">
            <br>
            <center>
            <img class="rounded-circle avatar-xl" src="{{ (!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap">
          </center>
            <div class="card-body">
                <h4 class="card-title">Nama: {{$adminData->name}}</h4>
                <hr>
                <h4 class="card-title">Email: {{$adminData->email}}</h4>
                <hr>
                <h4 class="card-title">Username: {{$adminData->username}}</h4>
                <hr>
                <a  href="{{route('profile.edit')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Edit Profile</a>
            </div>
        </div>

    </div><!-- end col -->


</div>
</div>








@endsection