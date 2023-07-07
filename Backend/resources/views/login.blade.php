@php
    $title  = 'Login';
@endphp
@include('layouts.head')
<div class="row" style="background-image: url('{{ url('images/banner-3.jpg', []) }}'); background-position: center;background-size: cover;height: 100%;">
    <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="logo margin-top-30">
            <img style="max-width: 150px;" src="{{ url('images/kgsexpress.png', []) }}" alt="kgsexpress"/>
        </div>
        <!-- start: LOGIN BOX -->
        <div class="box-login">
            <form class="form-login" action="" method="post">
                @csrf
                <fieldset>
                    <legend>
                        Connectez-vous à votre compte
                    </legend>
                    <p>
                        Veuillez saisir votre nom et votre mot de passe pour vous connecter.
                    </p>
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                            <i class="fa fa-user"></i> </span>
                    </div>
                    <div class="form-group form-actions">
                        <span class="input-icon">
                            <input type="password" class="form-control password" name="password" placeholder="Mot de passe">
                            <i class="fa fa-lock"></i>
                            <a class="forgot" href="login_forgot.html">                              
                                j'ai oublié mon mot de passe
                            </a> </span>
                    </div>
                    <div class="form-actions">

                        <button type="submit" class="btn btn-primary pull-right">
                            Login <i class="fa fa-arrow-circle-right"></i>
                        </button>
                    </div>
                    <div class="new-account">
                              Vous n'avez pas encore de compte? 
                        <a href="login_registration.html">
                             Créer un compte
                        </a>
                    </div>
                </fieldset>
            </form>
            <!-- start: COPYRIGHT -->
            <div class="copyright">
                &copy; <span class="current-year"></span><span class="text-bold text-uppercase"> Kgsexpress</span>. <span>Tous les droits sont réservés</span>
            </div>
            <!-- end: COPYRIGHT -->
        </div>
        <!-- end: LOGIN BOX -->
    </div>
</div>

@include('layouts.scripts')