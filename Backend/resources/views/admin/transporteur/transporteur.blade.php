@php
$title  = 'Liste Transporteurs';
@endphp
	
@extends('index')
@section('content')
<style>
    .dataTables_wrapper {
        padding: 10px
    }
    td.details-control {
        border-right: 1px solid #e2e2e4 !important;
    }
</style>
<div class="main-content" >
    <div class="wrap-content container" id="container">
        <!-- start: PAGE TITLE -->
        <section id="page-title">
            <div class="row">
                <ol class="breadcrumb">
                    <li>
                        <span>Transporteur</span>
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
                    <h2 style="display: inline" >Liste Transporteur</h2>
                    <button style="float: right; " id="ajoutTransporteur" type="button" data-toggle="modal" data-target="#addTransporteur" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Ajout Transporteur</button>

                    <hr>
                    <table style="border: 1px solid #e2e2e4;" class="table table-bordered" id="Transporteur-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>adresse</th>
                                <th>telephone</th>
                                <th>ville</th>
                                <th>Email</th>
                                <th>Statut</th>
                                <th>Date de Creation</th>
                                <th>Historique</th>
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
        id="addTransporteur"
   
    tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
		<div class="modal-dialog modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Ajout Transporteur</h4>
                </div>
                <form action="{{ url('ajout/transporteur', []) }}" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            @if (!empty($errors->all()) && session('errorAjoutTransporteur'))
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
    <div class="modal fade bs-example-modal-lg in" id="editTransporteur" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
        <div class="modal-dialog modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modifier Transporteur</h4>
            </div>
        <form name="edittransporteur" action="{{ url('/modifier/transporteur', []) }}/{{old('id')}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                <input type="text" name="id" style="display:none">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        @if (!empty($errors->all()) && session('errorModifierTransporteur') )
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
    <button type="button" id="modifierTransporteur"  data-toggle="modal" data-target="#editTransporteur" style="display: none"></button>

@endsection


@push('scripts')
@if (session('errorAjoutTransporteur'))
    <script>
        document.getElementById('ajoutTransporteur').click();
    </script>
@endif
@if (session('errorModifierTransporteur'))
    <script>
        document.getElementById('modifierTransporteur').click();
    </script>
@endif
<script>

function setInfo (data) {
 
    formEdit = document.forms[1];
    formEdit.nomedit.value = data.nom;
    formEdit.prenomedit.value = data.prenom;
    formEdit.emailedit.value = data.email;
    formEdit.adresseedit.value = data.adresse;
    formEdit.villeedit.value = data.ville;
    formEdit.telephoneedit.value = data.telephone;
    formEdit.id.value = data.id;

    formEdit.action = "{{url('modifier/transporteur')}}"+'/' + data.id

}
$(function() {
    var template = Handlebars.compile($("#details-template").html());

    var table = $('#Transporteur-table').DataTable({

        processing: true,
        serverSide: true,
        ajax: "{{url('datatable/get/transporteur')}}",
        columns: [

            { data: 'id', name: 'id' },
            { data: 'nom', name: 'nom' },
            { data: 'prenom', name: 'prenom' },
            { data: 'adresse', name: 'adresse' },
            { data: 'telephone', name: 'telephone' },
            { data: 'ville', name: 'ville' },
            { data: 'email', name: 'email' },
            { data: 'statut', name: 'statut' },
            { data: 'created_at', name: 'created_at' },
            {
                "className":      'details-control',
                "orderable":      false,
                "searchable":      false,
                "data":           null,
                "defaultContent": ''
            },
            {data: 'action', name: 'action', orderable: false, searchable: false , style: 'width:150px'}

        ]
            
    });

    $('#Transporteur-table tbody').on('click', 'td.details-control', function () {
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
            ajax: "{{url('datatable/get/transporteur/commande')}}/"+data.id,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'user.nom', name: 'user.nom' },
                { data: 'adresse', name: 'adresse' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false  },

            ]
        })
    }
</script>


<script    id="details-template" type="text/x-handlebars-template">
    <div style="padding-top: 10px;padding-left: 10px; ">
        <div  class="label label-info">Commande Livré</div>
     </div> 
     <table  class="table details-table" id="posts-@{{id}}">
         <thead>
         <tr>
             <th>Id</th>
             <th>Nom Client</th>
             <th>adresse</th>
             <th>Date de Creation</th>
             <th>Etat</th>

         </tr>
         </thead>
     </table>
 </script>
@endpush

