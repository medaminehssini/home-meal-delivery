@php
$title  = 'Liste Client';
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
                        <span>Client</span>
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
                    <h2 style="display: inline" >Liste Client</h2>

                    <hr>
                    <table class="table table-bordered" id="Client-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>adresse</th>
                                <th>telephone</th>
                                <th>ville</th>
                                <th>code postale</th>
                                <th>Email</th>
                                <th>Date de Creation</th>
                                <th>Date de modification </th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- end: FORM VALIDATION EXAMPLE 1 -->

    </div>
</div>




    <div class="modal fade bs-example-modal-lg in"
        id="addClient"
   
    tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
		<div class="modal-dialog modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Ajout Client</h4>
                </div>
                <form action="{{ url('ajout/client', []) }}" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            @if (!empty($errors->all()) && session('errorAjouclient'))
                                <div class="errorHandler alert alert-danger">
                                    <i class="fa fa-times-sign"></i> 
                                    Vous avez des erreurs de formulaire. S'il te plaît vérifie le.
                                    @foreach ($errors->all() as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach

                                </div>
                            @endif

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">
                                   Nom <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('nom') }}" type="text" placeholder="Votre nom" class="form-control" id="firstname" name="nom">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Prénom <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('prenom') }}" type="text" placeholder="votre prénom" class="form-control" id="lastname" name="prenom">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Email <span class="symbol required"></span>
                                </label>
                                <input type="email" value="{{ old('email') }}" placeholder="Votre adresse email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Photo
                                </label>
                                <input type="file"   class="form-control" id="image" name="image">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Adresse <span class="symbol required"></span>
                                </label>
                                <input type="text" value="{{ old('adresse') }}"   placeholder="Votre adresse" class="form-control" id="adresse" name="adresse">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Ville <span class="symbol required"></span>
                                </label>
                                <input type="text" value="{{ old('ville') }}"   placeholder="ville" class="form-control" id="ville" name="ville">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Code Postale <span class="symbol required"></span>
                                </label>
                                <input type="text" value="{{ old('codePostale') }}"   placeholder="Votre code Postale" class="form-control" id="codePostale" name="codePostale">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Telephone <span class="symbol required"></span>
                                </label>
                                <input type="text" value="{{ old('telephone') }}"   placeholder="Votre numero telephone" class="form-control" id="telephone" name="telephone">
                            </div>

                            <div class="form-group">
                                <label class="control-label">
                                    Mot de passe <span class="symbol required"></span>
                                </label>
                                <input type="password"  placeholder="Votre mot de passe" class="form-control" name="mot_de_passe" id="password">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Confirmez Mot de passe <span class="symbol required"></span>
                                </label>
                                <input type="password" class="form-control" id="password_again" name="mot_de_passe_confirmation">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <span class="symbol required"></span>Champs obligatoires
                                <hr>
                            </div>
                        </div>
                    </div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
						Close
					</button>
					<button type="submit" class="btn btn-primary">
						Ajouter
					</button>
                </div>
            </form>
			</div>
		</div>
    </div>
    <div class="modal fade bs-example-modal-lg in" id="editClient" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
        <div class="modal-dialog modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modifier Client</h4>
            </div>
        <form name="editClient" action="{{ url('/modifier/client', []) }}/{{old('id')}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                <input type="text" name="id" style="display:none">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        @if (!empty($errors->all()) && session('errorModifierClient') )
                            <div class="errorHandler alert alert-danger">
                                <i class="fa fa-times-sign"></i> 
                                Vous avez des erreurs de formulaire. S'il te plaît vérifie le.
                                @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach

                            </div>
                        @endif

                    </div>
                    <style>
                        .col-md-6{
                            padding : 0;
                            padding-right: 10px;
                        }
                    </style>
                    <div class="col-md-12">
                        <div class="col-md-6">
                          <div class="form-group">
                                <label class="control-label">
                                Nom <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('nomedit') }}"   type="text" placeholder="Votre nom" class="form-control" id="firstnameedit" name="nomedit">
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">
                                    Prénom <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('prenomedit') }}"   type="text" placeholder="votre prénom" class="form-control" id="lastnameedit" name="prenomedit">
                            </div>
                        </div>
                        <div style="                        padding : 0;
                        padding-right: 10px;"  class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">
                                    Adresse <span class="symbol required"></span>
                                </label>
                                <input type="text" value="{{ old('adresseedit') }}"   placeholder="Votre adresse" class="form-control" id="adresseedit" name="adresseedit">
                            </div>   
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">
                                    Ville <span class="symbol required"></span>
                                </label>
                                <input type="text" value="{{ old('villeedit') }}"   placeholder="ville" class="form-control" id="villeedit" name="villeedit">
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label class="control-label">
                                    Code Postale <span class="symbol required"></span>
                                </label>
                                <input type="text" value="{{ old('codePostaleedit') }}"   placeholder="Votre code Postale" class="form-control" id="codePostaleedit" name="codePostaleedit">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">
                                    Email <span class="symbol required"></span>
                                </label>
                                <input type="email" value="{{ old('emailedit') }}"   placeholder="Votre adresse email" class="form-control" id="emailedit" name="emailedit">
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">
                                    Telephone <span class="symbol required"></span>
                                </label>
                                <input type="text" value="{{ old('telephoneedit') }}"   placeholder="Votre numero telephone" class="form-control" id="telephoneedit" name="telephoneedit">
                            </div>
                        </div>
                        <div style="padding: 0" class="col-md-12"> 
                        <div style="    overflow: hidden;" class="form-group">
                                <div style="padding: 0" class="col-md-8">
                                    <label class="control-label">
                                        Image <span class="symbol required"></span>
                                    </label>
                                    <input type="file"  class="form-control" name="imageedit" id="imageedit">
                                </div>
                                <div style="padding-top: 5px" class="col-md-4">
                                    <img id="imageedits" style="    width: 50px;
                                    height: 50px;" src="" alt="">
                                </div>
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div  class="form-group">
                                <label class="control-label">
                                    Mot de passe <span class="symbol required"></span>
                                </label>
                                <input type="password"  placeholder="Votre mot de passe" class="form-control" name="mot_de_passe" id="passwordedit">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">
                                    Confirmez Mot de passe <span class="symbol required"></span>
                                </label>
                                <input type="password" class="form-control" id="password_againedit" name="mot_de_passe_confirmation">
                            </div>
                        </div>
                    </div>
                </div>
                     <div class="row">
                        <div class="col-md-12">
                         <div>
                              <span class="symbol required"></span>Champs obligatoires
                               <hr>
                         </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Modifier
                    </button>
                </div>
            </form>
        </div>
        </div>
    </div>
    <button type="button" id="modifierClient"  data-toggle="modal" data-target="#editClient" style="display: none"></button>
@endsection


@push('scripts')
@if (session('errorAjouclient'))
    <script>
        document.getElementById('ajoutClient').click();
    </script>
@endif
@if (session('errorModifierClient'))
    <script>
        document.getElementById('modifierClient').click();
    </script>
@endif
<script>

function setInfo (data) {
    console.log(data)
    formEdit = document.editClient;
    formEdit.nomedit.value = data.nom;
    formEdit.prenomedit.value = data.prenom;
    formEdit.emailedit.value = data.email;
    formEdit.adresseedit.value = data.adresse;
    formEdit.villeedit.value = data.ville;
    formEdit.codePostaleedit.value = data.codePostale;
    formEdit.telephoneedit.value = data.telephone;
    formEdit.id.value = data.id;
    document.getElementById('imageedits').src = "{{url('')}}"+'/' + data.image

    formEdit.action = "{{url('modifier/client')}}"+'/' + data.id

}
$(function() {
    $('#Client-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{url('datatable/get/users')}}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nom', name: 'nom' },
            { data: 'prenom', name: 'prenom' },
            { data: 'adresse', name: 'adresse' },
            { data: 'telephone', name: 'telephone' },
            { data: 'ville', name: 'ville' },
            { data: 'codePostale', name: 'codePostale' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            {data: 'action', name: 'action', orderable: false, searchable: false , style: 'width:150px'}

        ]
    });
});
</script>
@endpush

