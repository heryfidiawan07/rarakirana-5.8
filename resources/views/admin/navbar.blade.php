<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <span id="navbar-panel-name" class="parent-color bold text-size-15"></span>

        <button class="btn btn-primary d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ config('app.url') }}">Visit Website</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        {{Auth::user()->name}}
                        <img src="/users/{{Auth::user()->img}}" class="rounded-circle" height="25">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>