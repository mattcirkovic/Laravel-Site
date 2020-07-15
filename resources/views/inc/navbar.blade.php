<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed-top">
    <a class="navbar-brand" href="/"><img class="navbar-brand" src="../img/logo.jpg"></a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>

<div class="collapse navbar-collapse text-center" id="navbarNavDropdown">
 <ul class="navbar-nav mr-auto">
   <li class="nav-item active">
     <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
   </li>
  <li class="nav-item active">
      <a class="nav-link" href="/about">About <span class="sr-only">(current)</span></a>
     </li>
   <li class="nav-item active">
     <a class="nav-link" href="/posts">Archive <span class="sr-only">(current)</span></a>
    </li>
    @if(!Auth::guest())
      {{-- <li><a class="nav-link" href="{{ route('register') }}">Register</a></li> --}}
      <li>
        <a class="nav-link" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </li>
    @endif
    {{-- <form class="form-inline">
      <button class="btn btn-light" type="button">Donate</button>
    </form> --}}
  </li>
 </ul>
 <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
  <input type="hidden" name="cmd" value="_s-xclick">
  <input type="hidden" name="hosted_button_id" value="ETDDLHB8ZLZFL">
  <input type="submit" value="Donate" class="btn btn-success">
 </form>  
</div>
</nav>