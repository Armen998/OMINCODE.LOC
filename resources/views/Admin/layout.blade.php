<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="/styles/layout.css">
    <link rel="stylesheet" href="/styles/modal.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a03cdb7d05.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Omnicode</title>
</head>
<body>
    @auth
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container">
            <a href="{{ route('admin.home') }}">
                <img class="home" src="{{asset('/storage/icon/home.png')  }}">
            </a>
            <a class="dropdown " id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if (!empty(auth('admin')->user()->avatar))
                <div class="d-flex">
                    <img src="{{ asset('/storage/' . auth('admin')->user()->avatar) }}" class="avatar">
                    <p class=" my-auto h4 text-info font-italic">
                        {{ auth('admin')->user()->name }}
                    </p>
                </div>
                @else
                <div class="btn btn-warning text-white">
                    {{ auth('admin')->user()->name }}
                </div>
                @endif
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ route('admin.admin-profile', [($id = auth('admin')->id())]) }}">Profile </a>
                <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
            </div>
        </div>
    </nav>
    <div class="split left">
        <div>
            @if (auth('admin')->user()->avatar !== null)
            <img class="image " src="{{ asset('/storage/' . auth('admin')->user()->avatar) }}">
            @else
            <a class="" href="{{ route('admin.avatar-add') }}">
                <img class="image " src="{{ asset('/storage/icon/images.png') }}">
            </a>
            @endif
            <center class=" text-info font-italic"> Admin: {{ auth('admin')->user()->name }} </center>
            <a href="{{ route('user-articles') }}" style="text-decoration: none">
            </a>
        </div>
    </div>
    <div class="split right ">
        @yield('content')
    </div>
    <div>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLongTitle"> Are you sure you want to delete avatar </h4>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-outline-success" data-dismiss="modal">No</a>
                        <a class="btn btn-outline-danger" href="{{ route('admin.avatar-destroy') }}">Yes</a>
                        @csrf
                        @method('Delete')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        @if (!empty($articles))
        @foreach ( $articles as $article )
        <div class="modal fade " id="exampleModalCenter{{ $article->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLongTitle">Are you sure you want to delete Article </h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-success" data-dismiss="modal"> No </button>
                        <form action="{{ route('admin.articles-destroy', $article->id) }}" method="post">
                            <input class="btn btn-outline-danger" type="submit" value="Yes" />
                            @method('delete')
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    <div>
        @if (!empty($regularUsers))
        @foreach ($regularUsers as $regularUser )
        <div class="modal fade " id="exampleModalCenter{{$regularUser->id}}" tabindex="1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLongTitle">Are you sure you want to delete Article </h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-success" data-dismiss="modal"> No </button>
                        <form action="{{ route('admin.urers-destroy',  $regularUser->id ) }}" method="post">
                            <input class="btn btn-outline-danger" type="submit" value="Yes" />
                            @method('delete')
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    @endauth
</body>
</html>
