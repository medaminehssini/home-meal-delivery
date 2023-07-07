@php
$title  = 'Liste Abonnée';
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
                        <span>Fournisseur</span>
                    </li>
                    <li class="active">
                        <span>Abonnée</span>
                    </li>
                </ol>
            </div>
        </section>
        <!-- end: PAGE TITLE -->
        <!-- start: FORM VALIDATION EXAMPLE 1 -->
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="display: inline" >Liste Abonnée</h2>
                    <button style="float: right; " id="ajoutAbonnee" type="button" data-toggle="modal" data-target="#addAbonnee" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Ajout Abonnée</button>

                    <hr>
                    <table class="table table-bordered" id="Abonnee-table">
                        <thead>
                            <tr>
                                <th style="border-right:none"></th>
                                <th>Id</th>
                                <th>Nom Abonnement</th>
                                <th>Nom Fournisseur</th>
                                <th>Prix</th>
                                <th>Nombre de mois</th>
                                <th>Date de Creation</th>
                                <th>Etat</th>
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




    <div class="modal fade  in"
        id="addAbonnee"
   
    tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Ajout Abonnée</h4>
                </div>
                <form action="{{ url('ajout/abonnee', []) }}" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            @if (!empty($errors->all()) && session('errorAjoutAbonnee'))
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
                                    Fournisseur <span class="symbol required"></span>
                                </label>
                                <select name="fournisseur"  id=""  class="form-control">
                                    <option value="">Sélectionner fournisseur</option>
                                    @foreach ($fournisseurs as $fournisseur)
                                      <option value="{{$fournisseur->id}}">{{$fournisseur->nom}}</option>

                                    @endforeach
                                </select>                          
                             </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Abonnement <span class="symbol required"></span>
                                </label>
                                <select name="abonnemet"  onchange="setprix()" id="selectAbonnement"  class="form-control">
                                    <option value="" data-prix="0">Sélectionner abonnement</option>
                                    @foreach ($abonnements as $abonnemet)
                                      <option data-prix="{{$abonnemet->prix}}" value="{{$abonnemet->id}}">{{$abonnemet->nom}}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Coupon <span class="symbol required"></span>
                                </label>
                                <select name="coupon" onchange="setremise()"  id="selectCoupon"  class="form-control">
                                    <option value="" data-remise="0">Sélectionner Coupon</option>
                                    @foreach ($coupon as $item)
                                      <option  data-remise="{{$item->remise}}" value="{{$item->id}}">{{$item->code}}</option>
                                    @endforeach
                                </select>                          
                             </div>
                            <div class="form-group">
                                <label class="control-label">
                                   Nombre de mois <span class="symbol required"></span>
                                </label>
                                <input onchange="calculeprix(this.value)" value="{{ old('nbr_mois') }}" type="number" placeholder="nombre de mois de l'abonnée " class="form-control"  name="nbr_mois">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                  Prix <span class="symbol required"></span>
                                </label>
                                <input disabled   id="prixNow" value="{{ old('prix') }}" type="text" placeholder="prix de l'abonnée " class="form-control"  name="prix">
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
    <div class="modal fade bs-example-modal-lg in" id="editAbonnee" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
        <div class="modal-dialog modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modifier Abonnée</h4>
            </div>
        <form name="editAbonnee" action="{{ url('/modifier/abonnee', []) }}/{{old('id')}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                <input type="text" name="id" style="display:none">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        @if (!empty($errors->all()) && session('errorModifierAbonnee') )
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
                            <div class="form-group">
                                <label class="control-label">
                                   Nom <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('nomedit') }}" type="text" placeholder="Nom de l'abonnée" class="form-control" name="nomedit">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                   Nombre de mois <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('nbr_mois_edit') }}" type="number" placeholder="nombre de mois de l'abonnée " class="form-control"  name="nbr_mois_edit">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                  Prix <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('prix_edit') }}" type="text" placeholder="prix de l'abonnée " class="form-control"  name="prix_edit">
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
    <button type="button" id="modifierAbonnee"  data-toggle="modal" data-target="#editAbonnee" style="display: none"></button>
@endsection


@push('scripts')

@if (session('errorAjoutAbonnee'))
    <script>
        document.getElementById('ajoutAbonnee').click();
    </script>
@endif
@if (session('errorModifierAbonnee'))
    <script>
        document.getElementById('modifierAbonnee').click();
    </script>
@endif
<script>
 var prix  = 0 ; 
 var remise = 0 ; 
 function setprix () {
    this.prix = $('#selectAbonnement').find(':selected').data('prix') ;
 }
 function setremise () {
    this.remise = $('#selectCoupon').find(':selected').data('remise') ; 
    console.log(this.remise );
 }


 function calculeprix  (mois) {
    document.getElementById('prixNow').value =  (this.prix -  this.remise*this.prix/100) * mois;
 }
function setInfo (data) {
    console.log(data)
    formEdit = document.editAbonnee;
    formEdit.nomedit.value = data.nom;
    formEdit.prix_edit.value = data.prix;
    formEdit.nbr_mois_edit.value = data.nbr_mois;
    data.service.forEach(service => {
            document.getElementById('serviceEdit'+service.id).checked = true;
    });

    formEdit.id.value = data.id;

    formEdit.action = "{{url('modifier/abonnee')}}"+'/' + data.id

}
$(function() {
    var template = Handlebars.compile($("#details-template").html());

    var table = $('#Abonnee-table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        processing: true,
        serverSide: true,
        ajax: "{{url('datatable/get/abonnee')}}",
        columns: [
            {
                "className":      'details-control',
                "orderable":      false,
                "searchable":     false,
                "data":           null,
                "defaultContent": ''
            },
            { data: 'id', name: 'id' },
            { data: 'abonnement.nom', name: 'abonnement.nom' },
            { data: 'fournisseur.nom', name: 'fournisseur.nom' },
            { data: 'prix', name: 'prix' },
            { data: 'nbr_mois', name: 'nbr_mois' },
            { data: 'created_at', name: 'created_at' },
            {data: 'status', name: 'status', orderable: false, searchable: false , style: 'width:150px'},
            {data: 'action', name: 'action', orderable: false, searchable: false , style: 'width:150px'}
        ],     
        order: [[1, 'asc']]

    });

    $('#Abonnee-table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( template(row.data()) ).show();
            tr.addClass('shown');
        }
    });


});
</script>


<script id="details-template" type="text/x-handlebars-template">
    <table class="table">
        <tr>
            <td style="font-weight: bold">Nom Fournisseur:</td>
            <td>@{{fournisseur.nom}}</td>
            <td style="font-weight: bold" >Prénom Fournisseur:</td>
            <td>@{{fournisseur.prenom}}</td>
        </tr>
        <tr>
            <td style="font-weight: bold">Email Fournisseur:</td>
            <td>@{{fournisseur.email}}</td>
            <td style="font-weight: bold"> Adresse Fournisseur:</td>
            <td>@{{fournisseur.adresse}}</td>
        </tr>
        <tr>
            <td style="font-weight: bold">Nom abonnement:</td>
            <td>@{{abonnement.nom}}</td>
            <td style="font-weight: bold">Prix abonnement:</td>
            <td>@{{abonnement.prix}}</td>
        </tr>
        <tr>
            <td style="font-weight: bold">Code coupon:</td>
            <td>@{{coupon.code}}</td>
            <td style="font-weight: bold">Remise coupon:</td>
            <td>@{{coupon.remise}}%</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Date Debut:</td>
            <td style="color:green !important">@{{created_at}}</td>
            <td style="font-weight: bold;">Date expiration:</td>
            <td style="color:red !important">@{{date_fin}}</td>

        </tr>
    </table>
</script>

@endpush

