@php
$title  = 'Liste Spécialité';
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
                        <span>Spécialité</span>
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
                    <h2 style="display: inline" >Liste Spécialité</h2>
                    <button style="float: right; " id="ajoutSpecialite" type="button" data-toggle="modal" data-target="#addSpecialite" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Ajout Spécialité</button>

                    <hr>
                    <table class="table table-bordered" id="specialite-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>libellé </th>
                                <th>description</th>  
                                <th>Date de Creation</th>
                                <th>Modifier</th>
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
        id="addSpecialite"
   
    tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
		<div class="modal-dialog modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Ajout Spécialité</h4>
                </div>
                <form action="{{ url('ajout/specialite', []) }}" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            @if (!empty($errors->all()) && session('errorAjoutSpecialite'))
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
                                    Libellé  <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('libelle') }}" type="text" placeholder="libelle" class="form-control" id="libelle" name="libelle">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Description <span class="symbol required"></span>
                                </label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Image <span class="symbol required"></span>
                                </label>
                                <input type="file"  class="form-control" id="image" name="image">
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
						Fermer
					</button>
					<button type="submit" class="btn btn-primary">
						Ajouter
					</button>
                </div>
            </form>
			</div>
		</div>
    </div>
    <div class="modal fade bs-example-modal-lg in" id="editSpecialite" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
        <div class="modal-dialog modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modifier Spécialité</h4>
            </div>
        <form name="editSpecialite" action="{{ url('/modifier/specialite', []) }}/{{old('id')}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                <input type="text" name="id" style="display:none">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        @if (!empty($errors->all()) && session('errorModifierSpecialite') )
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
                        <div class="col-md-12">
                          <div class="form-group">
                                <label class="control-label">
                                    Libellé <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('libelleedit') }}"   type="text"  class="form-control" id="libelleedit" name="libelleedit">
                            </div> 
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">
                                    Description <span class="symbol required"></span>
                                </label>
                                <textarea class="form-control" name="descriptionedit" id="descriptionedit" cols="30" rows="10">{{ old('descriptionedit') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div style="    overflow: hidden;" class="form-group">
                                <div  style="    padding: 0;" class="col-md-8">
                                    <label class="control-label">
                                        Image <span class="symbol required"></span>
                                    </label>
                                    <input type="file"  class="form-control" name="imageedit" id="imageedit">
                                </div>
                                <div class="col-md-4">
                                    <img id="imageedits" style="    width: 50px;
                                    height: 50px;" src="" alt="">
                                </div>
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
    <button type="button" id="modifierSpecialite"  data-toggle="modal" data-target="#editSpecialite" style="display: none"></button>
@endsection


@push('scripts')
@if (session('errorAjoutSpecialite'))
    <script>
        document.getElementById('ajoutSpecialite').click();
    </script>
@endif
@if (session('errorModifierSpecialite'))
    <script>
        document.getElementById('modifierSpecialite').click();
    </script>
@endif
<script>

function setInfo (data) {
    console.log(data)
    formEdit = document.editSpecialite;
    formEdit.descriptionedit.value = data.description;
    formEdit.libelleedit.value = data.libelle;
    formEdit.id.value = data.id;
    document.getElementById('imageedits').src = "{{url('')}}"+'/' + data.image

    formEdit.action = "{{url('modifier/specialite')}}"+'/' + data.id

}
$(function() {
    $('#specialite-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{url('datatable/get/specialite')}}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'photo', name: 'photo' },
            { data: 'libelle', name: 'libelle' },
            { data: 'description', name: 'description' },
            { data: 'created_at', name: 'created_at' },
            {data: 'action', name: 'action', orderable: false, searchable: false , style: 'width:150px'}

        ]
    });
});
</script>
@endpush

