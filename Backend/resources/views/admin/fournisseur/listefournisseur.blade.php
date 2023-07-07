@php
$title  = 'Liste Fournisseur';
@endphp
	
@extends('index')
@section('content')
<style>
    .dataTables_wrapper {
        padding: 10px
    }
</style>
<div class="main-content" >
    <div class="wrap-content container" id="container">
        <!-- start: PAGE TITLE -->
        <section id="page-title">
            <div class="row">
                <ol class="breadcrumb">
                    <li>
                        <span>Fournisseur</span>
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
                    <h2 style="display: inline" >Liste Fournisseur</h2>
                    <button style="float: right; " id="ajoutFournisseur" type="button" data-toggle="modal" data-target="#addFournisseur" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Ajout Fournisseur</button>

                    <hr>
                    <table class="table table-bordered" id="Fournisseur-table">
                        <thead>
                            <tr>
                                <th></th>
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
                                <th>Edit</th>
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
        id="addFournisseur"
   
    tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
		<div class="modal-dialog modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Ajout Fournisseur</h4>
                </div>
                <form action="{{ url('ajout/fournisseur', []) }}" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            @if (!empty($errors->all()) && session('errorAjouFournisseur'))
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
    <div class="modal fade bs-example-modal-lg in" id="editFournisseur" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
        <div class="modal-dialog modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modifier Fournisseur</h4>
            </div>
        <form name="editFournisseur" action="{{ url('/modifier/Fournisseur', []) }}/{{old('id')}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                <input type="text" name="id" style="display:none">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        @if (!empty($errors->all()) && session('errorModifierFournisseur') )
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
    <button type="button" id="modifierFournisseur"  data-toggle="modal" data-target="#editFournisseur" style="display: none"></button>

    <div class="modal fade in" id="refuserRestaurant" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
        <div class="modal-dialog modal-dialog ">
         <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Refuser Restaurant</h4>
            </div>
        <form name="refuserRestaurant"  method="POST" enctype="multipart/form-data">
                @method('PUT')
            <div class="modal-body">
                @csrf
                <div class="row">

                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">
                                    Note : <span class="symbol required"></span>
                                </label>
                                <textarea class="form-control" name="note" id="" cols="30" rows="10"></textarea>
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
                    <button type="submit" class="btn btn-danger">
                        Refuser
                    </button>
                </div>
            </form>
        </div>
        </div>
    </div>
@endsection


@push('scripts')
@if (session('errorAjoutFournisseur'))
    <script>
        document.getElementById('ajoutFournisseur').click();
    </script>
@endif
@if (session('errorModifierFournisseur'))
    <script>
        document.getElementById('modifierFournisseur').click();
    </script>
@endif
<script>

function setInfo (data) {
    formEdit = document.editFournisseur;
    formEdit.nomedit.value = data.nom;
    formEdit.prenomedit.value = data.prenom;
    formEdit.emailedit.value = data.email;
    formEdit.adresseedit.value = data.adresse;
    formEdit.villeedit.value = data.ville;
    formEdit.codePostaleedit.value = data.codePostale;
    formEdit.telephoneedit.value = data.telephone;
    formEdit.id.value = data.id;
    document.getElementById('imageedits').src = "{{url('')}}"+'/' + data.image

    formEdit.action = "{{url('modifier/fournisseur')}}"+'/' + data.id

}
function setInfoRefuser (data) {
    formRefuser = document.refuserRestaurant;

    formRefuser.action = "{{url('refuser/restaurant')}}"+'/' + data.id


}
$(function() {
    var template = Handlebars.compile($("#details-template").html());

    var table = $('#Fournisseur-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{url('datatable/get/fournisseurs?fournisseur=')}}{{request()->fournisseur}}",
        columns: [
            {
                "className":      'details-control',
                "orderable":      false,
                "searchable":      false,
                "data":           null,
                "defaultContent": ''
            },
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

    $('#Fournisseur-table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'posts-' + row.data().id;

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(template(row.data())).show();
            initTable(tableId, row.data());
            tr.addClass('shown');
            tr.next().find('td').addClass('no-padding bg-gray');
        }
    });


});

function initTable(tableId, data) {
        $('#' + tableId).DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{url('get/liste/restaurants')}}/"+data.id,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'img', name: 'img' },
                { data: 'nom', name: 'nom' },
                { data: 'telephone', name: 'telephone' },
                { data: 'adresse', name: 'adresse' },
                { data: 'created_at', name: 'created_at' },
                { data: 'etats', name: 'etats', orderable: false, searchable: false  },
                {data: 'action', name: 'action', orderable: false, searchable: false , style: 'width:150px'}

            ]
        })
    }
</script>


<script    id="details-template" type="text/x-handlebars-template">
   <div style="padding-top: 10px;padding-left: 10px; ">
       <div  class="label label-info">Liste Restaurants</div>
    </div> 
    <table  class="table details-table" id="posts-@{{id}}">
        <thead>
        <tr>
            <th>Id</th>
            <th>Image</th>
            <th>Nom</th>
            <th>Telephone</th>
            <th>Adresse</th>
            <th>Date de creation</th>
            <th>Etat</th>
            <th>Action</th>
        </tr>
        </thead>
    </table>
</script>
@endpush

