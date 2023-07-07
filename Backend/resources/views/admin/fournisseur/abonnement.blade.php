@php
$title  = 'Liste Abonnement';
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
                        <span>Abonnement</span>
                    </li>
                </ol>
            </div>
        </section>
        <!-- end: PAGE TITLE -->
        <!-- start: FORM VALIDATION EXAMPLE 1 -->
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="display: inline" >Liste Abonnement</h2>
                    <button style="float: right; " id="ajoutAbonnement" type="button" data-toggle="modal" data-target="#addAbonnement" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Ajout Abonnement</button>

                    <hr>
                    <table class="table table-bordered" id="Abonnement-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Nombre de mois</th>
                                <th>Date de Creation</th>
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
        id="addAbonnement"
   
    tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Ajout Abonnement</h4>
                </div>
                <form action="{{ url('ajout/abonnement', []) }}" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            @if (!empty($errors->all()) && session('errorAjoutAbonnement'))
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
                                <input value="{{ old('nom') }}" type="text" placeholder="Nom de l'abonnement" class="form-control" name="nom">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                   Nombre de mois <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('nbr_mois') }}" type="number" placeholder="nombre de mois de l'abonnement " class="form-control"  name="nbr_mois">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                  Prix <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('prix') }}" type="text" placeholder="prix de l'abonnement " class="form-control"  name="prix">
                            </div>
                            @foreach ($services as $service)
                                <div class="checkbox clip-check check-primary">
                                    <input type="checkbox" value="{{$service->id}}" name="services[]" id="service{{$service->id}}">
                                    <label for="service{{$service->id}}">
                                        {{$service->nom}}
                                    </label>
                                </div>
                            @endforeach

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
    <div class="modal fade bs-example-modal-lg in" id="editAbonnement" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
        <div class="modal-dialog modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modifier Abonnement</h4>
            </div>
        <form name="editAbonnement" action="{{ url('/modifier/abonnement', []) }}/{{old('id')}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                <input type="text" name="id" style="display:none">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        @if (!empty($errors->all()) && session('errorModifierAbonnement') )
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
                                <input value="{{ old('nomedit') }}" type="text" placeholder="Nom de l'abonnement" class="form-control" name="nomedit">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                   Nombre de mois <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('nbr_mois_edit') }}" type="number" placeholder="nombre de mois de l'abonnement " class="form-control"  name="nbr_mois_edit">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                  Prix <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('prix_edit') }}" type="text" placeholder="prix de l'abonnement " class="form-control"  name="prix_edit">
                            </div>
                            @foreach ($services as $service)
                                <div class="checkbox clip-check check-primary">
                                    <input type="checkbox" value="{{$service->id}}" name="services[]" id="serviceEdit{{$service->id}}">
                                    <label for="serviceEdit{{$service->id}}">
                                        {{$service->nom}}
                                    </label>
                                </div>
                            @endforeach

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
    <button type="button" id="modifierAbonnement"  data-toggle="modal" data-target="#editAbonnement" style="display: none"></button>
@endsection


@push('scripts')
@if (session('errorAjoutAbonnement'))
    <script>
        document.getElementById('ajoutAbonnement').click();
    </script>
@endif
@if (session('errorModifierAbonnement'))
    <script>
        document.getElementById('modifierAbonnement').click();
    </script>
@endif
<script>

function setInfo (data) {
    console.log(data)
    formEdit = document.editAbonnement;
    formEdit.nomedit.value = data.nom;
    formEdit.prix_edit.value = data.prix;
    formEdit.nbr_mois_edit.value = data.nbr_mois;
    data.service.forEach(service => {
            document.getElementById('serviceEdit'+service.id).checked = true;
    });

    formEdit.id.value = data.id;

    formEdit.action = "{{url('modifier/abonnement')}}"+'/' + data.id

}
$(function() {
    $('#Abonnement-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{url('datatable/get/abonnement')}}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nom', name: 'nom' },
            { data: 'prix', name: 'prix' },
            { data: 'nbr_mois', name: 'nbr_mois' },
            { data: 'created_at', name: 'created_at' },
            {data: 'action', name: 'action', orderable: false, searchable: false , style: 'width:150px'}
        ]
    });
});
</script>
@endpush

