<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@@page-discription">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>Login | Admin</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/dashlite.css?ver=1.4.0')}}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('admin_assets/assets/css/theme.css?ver=1.4.0')}}">
</head>

<body class="nk-body npc-crypto ui-clean pg-auth">
    <!-- app body @s -->
    <div class="nk-app-root">
        <div class="nk-split nk-split-page nk-split-md">
            <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container">
                <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                    <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
                </div>
                <div class="nk-block nk-block-middle nk-auth-body">
                    <div class="brand-logo pb-5">
                        <a href="{{ url('/') }}" class="logo-link">
                            <img class="logo-light logo-img logo-img-lg" src="{{ asset('admin_assets/images/logo.png')}}" srcset="{{ asset('admin_assets/images/logo2x.png')}}" alt="logo">
                            <img class="logo-dark logo-img logo-img-lg" src="{{ asset('admin_assets/images/logo-dark.png')}}" srcset="{{ asset('admin_assets/images/logo-dark2x.png')}}" alt="logo-dark">
                        </a>
                    </div>
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title">Sign-In</h5>
                            <div class="nk-block-des">
                                <p>Access the Admin panel using your email and password.</p>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif
                    <form action="{{ route('adminLoginPost')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="default-01">Email</label>
                            </div>
                            <input type="email" name="email" class="form-control form-control-lg" id="default-01" placeholder="Enter your email address or username">
                        </div><!-- .foem-group -->
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password">Password</label>
                                {{-- <a class="link link-primary link-sm" tabindex="-1" href="html/general/pages/auths/auth-reset.html">Forgot Code?</a> --}}
                            </div>
                            <div class="form-control-wrap">
                                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                </a>
                                <input type="password" name="password"  class="form-control form-control-lg" id="password" placeholder="Enter your password">
                            </div>
                        </div><!-- .foem-group -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
                        </div>
                    </form><!-- form -->
                </div><!-- .nk-block -->
            </div><!-- .nk-split-content -->
        </div><!-- .nk-split -->
    </div><!-- app body @e -->
    <!-- JavaScript -->
    <script src="{{ asset('admin_assets/assets/js/bundle.js?ver=1.4.0')}}"></script>
    <script src="{{ asset('admin_assets/assets/js/scripts.js?ver=1.4.0')}}"></script>
</body>

</html>