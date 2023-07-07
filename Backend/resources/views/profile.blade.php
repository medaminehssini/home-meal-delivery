@php
$title  = 'Modifier profile';
@endphp
	
@extends('index')
@section('content')

<div class="main-content" >
    <div class="wrap-content container" id="container">
        <!-- start: PAGE TITLE -->
        <section id="page-title">
            <div class="row">
                <ol class="breadcrumb"> 
                    <li>
                        <span>Commande</span>
                    </li>
                    <li class="active">
                        <span>Liste</span>
                    </li>
                </ol>
            </div>
        </section>
        <!-- end: PAGE TITLE -->
        <!-- start: FORM VALIDATION EXAMPLE 1 -->
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-12">
                    <div id="panel_edit_account" class="tab-pane">
                        <form action="" method="POST"  role="form" id="form" enctype="multipart/form-data">
                            
                            @csrf

                            @if (!empty($errors->all()) )
                                <div class="errorHandler alert alert-danger">
                                    <i class="fa fa-times-sign"></i> 
                                    Vous avez des erreurs de formulaire. S'il te plaît vérifie le.
                                    @foreach ($errors->all() as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach

                                </div>
                            @endif
                            <fieldset>
                                <legend>
                                    Informations de compte
                                </legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Nom :
                                            </label>
                                        <input value="{{Auth::user()->nom}}" type="text" placeholder="Votre nom" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Prénom :
                                            </label>
                                            <input  value="{{Auth::user()->prenom}}" type="text" placeholder="Votre prénom" class="form-control" id="lname" name="lname">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Email :
                                            </label>
                                            <input  disabled value="{{Auth::user()->email}}"  type="email" placeholder="exemple@exemple.com" class="form-control" id="email" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Téléphone :
                                            </label>
                                            <input value="{{Auth::user()->telephone}}" type="text" placeholder="votre téléphone" class="form-control" id="tele" name="tele">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Ancien mot de passe :
                                            </label>
                                            <input type="password" placeholder="" class="form-control" name="ancien_mot_de_passe" id="ancien_mot_de_passe">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">
                                                Mot de passe :
                                            </label>
                                            <input type="password" placeholder="" class="form-control" name="mot_de_passe" id="mot_de_passe">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Confirmez le mot de passe :
                                            </label>
                                            <input type="password"  placeholder="" class="form-control" id="confirmation_mot_de_passe" name="mot_de_passe_confirmation">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Adresse :
                                                    </label>
                                                    <input  value="{{Auth::user()->adresse}}" class="form-control tooltips" placeholder="Votre adresse" type="text"   name="adresse" id="adresse">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Code Postale : 
                                                    </label>
                                                    <input  value="{{Auth::user()->codePostale}}" class="form-control" placeholder="12345" type="text" name="zipcode" id="zipcode">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Ville : 
                                                    </label>
                                                    <input  value="{{Auth::user()->ville}}" class="form-control tooltips" placeholder=" Votre ville" type="text" name="ville" id="ville">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>
                                               Photo de profile : 
                                            </label>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail"><img src="
                                                    @if (Auth::user()->image != '')
                                                    {{ url('', []) }}/{{Auth::user()->image}}
                                                    @else
                                                        {{ url('', []) }}/assets/images/avatar-1-xl.jpg
                                                    @endif
                                                    
                                                    " alt="">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                <div class="user-edit-image-buttons">
                                                    <span class="btn btn-azure btn-file"><span class="fileinput-new"><i class="fa fa-picture"></i> Sélectionnez l'image                                                    </span><span class="fileinput-exists"><i class="fa fa-picture"></i> change</span>
                                                        <input type="file"  name="image">
                                                    </span>
                                                    <a href="#" class="btn fileinput-exists btn-red" data-dismiss="fileinput">
                                                        <i class="fa fa-times"></i> Retirer
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        Champs obligatoires
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <p>
                                        En cliquant sur MISE À JOUR, vous acceptez la politique  &amp; les conditions.                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary pull-right" type="submit">
                                        Mise à jour <i class="fa fa-arrow-circle-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end: FORM VALIDATION EXAMPLE 1 -->

    </div>
</div>
@endsection


