@php
$title  = 'Liste Services d\'abonnements';
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
                        <span>Service d'abonnement</span>
                    </li>
                </ol>
            </div>
        </section>
        <!-- end: PAGE TITLE -->
        <!-- start: FORM VALIDATION EXAMPLE 1 -->
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="display: inline" >Liste Services d'abonnements</h2>
                    <button style="float: right; " id="ajoutOption" type="button" data-toggle="modal" data-target="#addOption" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Ajout Service</button>

                    <hr>
                    <table class="table table-bordered" id="Option-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
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




    <div class="modal fade bs-example-modal-lg in"
        id="addOption"
   
    tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
		<div class="modal-dialog modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Ajout Service</h4>
                </div>
                <form action="{{ url('ajout/abonnement/option', []) }}" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            @if (!empty($errors->all()) && session('errorAjouOption'))
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
                                <input value="{{ old('nom') }}" type="text" placeholder="nom Service" class="form-control" id="firstname" name="nom">
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
    <div class="modal fade bs-example-modal-lg in" id="editOption" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
        <div class="modal-dialog modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modifier Service</h4>
            </div>
            <form name="editOption" action="{{ url('/modifier/abonnement/option', []) }}/{{old('id')}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                <input type="text" name="id" style="display:none">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            @if (!empty($errors->all()) && session('errorModifierOption') )
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
    <button type="button" id="modifierOption"  data-toggle="modal" data-target="#editOption" style="display: none"></button>
@endsection


@push('scripts')
@if (session('errorAjoutOption'))
    <script>
        document.getElementById('ajoutOption').click();
    </script>
@endif
@if (session('errorModifierOption'))
    <script>
        document.getElementById('modifierOption').click();
    </script>
@endif
<script>

function setInfo (data) {
    console.log(data)
    formEdit = document.editOption;
    formEdit.nomedit.value = data.nom;
    formEdit.id.value = data.id;
    formEdit.action = "{{url('modifier/abonnement/option')}}"+'/' + data.id

}
$(function() {
    $('#Option-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{url('datatable/get/abonnement/options')}}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nom', name: 'nom' },
            { data: 'created_at', name: 'created_at' },
            {data: 'action', name: 'action', orderable: false, searchable: false , style: 'width:150px'}
        ]
    });
});
</script>
@endpush

