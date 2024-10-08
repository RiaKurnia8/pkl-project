{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ADMIN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-link nav-link" type="submit">{{ __('Log Out') }}</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 --}}

 @extends('layouts.admin')

 @section('content')

 <h1 class="mt-4">Dashboard</h1>
 <ol class="breadcrumb mb-4">
     <li class="breadcrumb-item active">Dashboard</li>
 </ol>
 
 <div class="row">
     <div class="col-xl-3 col-md-6">
         <div class="card bg-primary text-white mb-4">
             <div class="card-body">Primary Card</div>
             <div class="card-footer d-flex align-items-center justify-content-between">
                 <a class="small text-white stretched-link" href="#">View Details</a>
                 <div class="small text-white"><i class="fas fa-angle-right"></i></div>
             </div>
         </div>
     </div>
     <div class="col-xl-3 col-md-6">
         <div class="card bg-warning text-white mb-4">
             <div class="card-body">Warning Card</div>
             <div class="card-footer d-flex align-items-center justify-content-between">
                 <a class="small text-white stretched-link" href="#">View Details</a>
                 <div class="small text-white"><i class="fas fa-angle-right"></i></div>
             </div>
         </div>
     </div>
     <div class="col-xl-3 col-md-6">
         <div class="card bg-success text-white mb-4">
             <div class="card-body">Success Card</div>
             <div class="card-footer d-flex align-items-center justify-content-between">
                 <a class="small text-white stretched-link" href="#">View Details</a>
                 <div class="small text-white"><i class="fas fa-angle-right"></i></div>
             </div>
         </div>
     </div>
     <div class="col-xl-3 col-md-6">
         <div class="card bg-danger text-white mb-4">
             <div class="card-body">Danger Card</div>
             <div class="card-footer d-flex align-items-center justify-content-between">
                 <a class="small text-white stretched-link" href="#">View Details</a>
                 <div class="small text-white"><i class="fas fa-angle-right"></i></div>
             </div>
         </div>
     </div>
 </div>

 @endsection
