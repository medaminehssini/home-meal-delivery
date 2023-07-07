@php
$title  = 'Liste Repas | Pack';
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
                        <span>Repas | Pack</span>
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
                <h2 style="display: inline" >Liste Repas : {{ $restaurant->nom}}</h2>
                    <button style="float: right; " id="ajoutRepas" type="button" data-toggle="modal" data-target="#addRepas" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Ajout Repas</button>

                    <hr>
                    <table class="table table-bordered" id="Repas-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th>Spécialité</th>
                                <th>Date de Creation</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- end: FORM VALIDATION EXAMPLE 1 -->
        <!-- start: FORM VALIDATION EXAMPLE 1 -->
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-12">
                <h2 style="display: inline" >Liste Pack : {{ $restaurant->nom}}</h2>
                    <button style="float: right; " id="ajoutPack" type="button" data-toggle="modal" data-target="#addPack" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Ajout Pack</button>

                    <hr>
                    <table class="table table-bordered" id="Pack-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th>Spécialité</th>
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




    <div class="modal fade bs-example-modal-lg in" id="addRepas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
		<div class="modal-dialog modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Ajout Repas</h4>
                </div>
            <form action="{{ url('fournisseur/ajout/repas', []) }}/{{request()->id}}" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            @if (!empty($errors->all()) && session('errorAjoutrepas'))
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
                                    Libellé <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('libelle') }}" type="text" placeholder="libellé " class="form-control" id="firstname" name="libelle">
                            </div>

                            <div class="form-group">
                                <label class="control-label">
                                    Description <span class="symbol required"></span>
                                </label>
                                <textarea name="description" id="description"  class="form-control">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Specialité <span class="symbol required"></span>
                                </label>
                                <select class="form-control" name="specialite" >
                                    <option  value=''>choisir une spécialité</option>
                                    @foreach ($specialite as $item)
                                        @if ($item->id  == old('specialite') )
                                               <option selected value="{{$item->id}}">{{$item->libelle}}</option>
                                            @else
                                                <option value="{{$item->id}}">{{$item->libelle}}</option>
                                        @endif
                                    
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Prix <span class="symbol required"></span>
                                </label>
                                <input type="text" value="{{ old('prix') }}"   placeholder="" class="form-control" id="prix" name="prix">
                            </div>

                            <div class="form-group">
                                <label class="control-label">
                                    Image
                                </label>
                                <input type="file"   class="form-control" id="image" name="image">
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





    <div class="modal fade bs-example-modal-lg in" id="addPack" tabindex="-1" role="dialog" aria-labelledby="pack" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
		<div class="modal-dialog modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Ajout Pack</h4>
                </div>
                <form action="{{ url('fournisseur/ajout/pack', []) }}/{{request()->id}}" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            @if (!empty($errors->all()) && session('errorAjoutpack'))
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
                                    Libellé <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('libelle') }}" type="text" placeholder="libellé " class="form-control" name="libelle">
                            </div>

                            <div class="form-group">
                                <label class="control-label">
                                    Description <span class="symbol required"></span>
                                </label>
                                <textarea name="description"   class="form-control">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Specialité <span class="symbol required"></span>
                                </label>
                                <select class="form-control" name="specialite" >
                                    <option  value=''>choisir une spécialité</option>
                                    @foreach ($specialite as $item)
                                        @if ($item->id  == old('specialite') )
                                               <option selected value="{{$item->id}}">{{$item->libelle}}</option>
                                            @else
                                                <option value="{{$item->id}}">{{$item->libelle}}</option>
                                        @endif
                                    
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Prix <span class="symbol required"></span>
                                </label>
                                <input type="text" value="{{ old('prix') }}"   placeholder="" class="form-control" name="prix">
                            </div>

                            <div class="form-group">
                                <label class="control-label">
                                    Image
                                </label>
                                <input type="file"   class="form-control"  name="image">
                            </div>

                            <div style="overflow: hidden" class="form-group">
                                    <label style="    display: block;" class="control-label">
                                       Choisir repas :
                                    </label>
                                
                                @foreach ($restaurant->repas as $item)       
                                <div class=" col-md-4">
                                    <div class="checkbox clip-check check-primary">
                                        <input type="checkbox" name="repas[]" id="repas{{$item->id}}" value="{{$item->id}}">
                                        <label for="repas{{$item->id}}">
                                            {{$item->libelle}}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
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




    <div class="modal fade bs-example-modal-lg in" id="editRepas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
        <div class="modal-dialog modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modifier Repas</h4>
            </div>
        <form name="editRepas" action="{{ url('fournisseur/modifier/repas', []) }}/{{old('id')}}/{{request()->id}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                <input type="text" name="id" style="display:none">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        @if (!empty($errors->all()) && session('errorModifierrepas') )
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
                        <div class="col-md-12">
                          <div class="form-group">
                                <label class="control-label">
                                    Libellé <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('libelledit') }}"   type="text" class="form-control" id="libelledit" name="libelledit">
                            </div> 
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">
                                    Description <span class="symbol required"></span>
                                </label>
                                <textarea name="descriptionedit" id="descriptionedit"  class="form-control">{{ old('descriptionedit') }}</textarea>
                            </div>
                         </div>
                         <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">
                                    Specialité <span class="symbol required"></span>
                                </label>
                                <select class="form-control" name="specialiteedit" >
                                    <option  value=''>choisir une spécialité</option>
                                    @foreach ($specialite as $item)
                                        @if ($item->id  == old('specialiteedit') )
                                            <option selected value="{{$item->id}}">{{$item->libelle}}</option>
                                            @else
                                                <option value="{{$item->id}}">{{$item->libelle}}</option>
                                        @endif
                                    
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">
                                    Prix <span class="symbol required"></span>
                                </label>
                                <input type="text" value="{{ old('prixedit') }}"   class="form-control" id="prixedit" name="prixedit">
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

    
    <div class="modal fade bs-example-modal-lg in" id="editPack" tabindex="-1" role="dialog" aria-labelledby="packhg" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
        <div class="modal-dialog modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modifier Pack</h4>
            </div>
        <form name="editPack" action="{{ url('fournisseur/modifier/pack', []) }}/{{old('id')}}/{{request()->id}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                <input type="text" name="id" value="" style="display:none">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        @if (!empty($errors->all()) && session('errorModifierpack') )
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
                        <div class="col-md-12">
                          <div class="form-group">
                                <label class="control-label">
                                    Libellé <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('libelledit') }}"   type="text" class="form-control"  name="libelledit">
                            </div> 
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">
                                    Description <span class="symbol required"></span>
                                </label>
                                <textarea name="descriptionedit"   class="form-control">{{ old('descriptionedit') }}</textarea>
                            </div>
                         </div>
                         <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">
                                    Specialité <span class="symbol required"></span>
                                </label>
                                <select class="form-control" name="specialiteedit" >
                                    <option  value=''>choisir une spécialité</option>
                                    @foreach ($specialite as $item)
                                        @if ($item->id  == old('specialiteedit') )
                                            <option selected value="{{$item->id}}">{{$item->libelle}}</option>
                                            @else
                                                <option value="{{$item->id}}">{{$item->libelle}}</option>
                                        @endif
                                    
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div  class="form-group">
                                <label style="    display: block;" class="control-label">
                                Choisir repas :
                                </label>
                                @foreach ($restaurant->repas as $item)       
                                <div class=" col-md-4">
                                    <div class="checkbox clip-check check-primary">
                                        <input type="checkbox" name="repas[]" id="repasedit{{$item->id}}" value="{{$item->id}}">
                                        <label for="repasedit{{$item->id}}">
                                            {{$item->libelle}}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">
                                    Prix <span class="symbol required"></span>
                                </label>
                                <input type="text" value="{{ old('prixedit') }}"   class="form-control" name="prixedit">
                            </div>
                        </div>
                        <div class="col-md-12"> 
                            <div style="    overflow: hidden;" class="form-group">
                                    <div  style="    padding: 0;" class="col-md-8">
                                        <label class="control-label">
                                            Image <span class="symbol required"></span>
                                        </label>
                                        <input type="file"  class="form-control" name="imageedit" >
                                    </div>
                                    <div class="col-md-4">
                                        <img id="imageeditspack" style="    width: 50px;
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
    <button type="button" id="modifierRepas"  data-toggle="modal" data-target="#editRepas" style="display: none"></button>
    <button type="button" id="modifierPack"  data-toggle="modal" data-target="#editPack" style="display: none"></button>

@endsection


@push('scripts')
@if (session('errorAjoutrepas'))
    <script>
        document.getElementById('ajoutRepas').click();
    </script>
@endif

@if (session('errorAjoutpack'))
    <script>
        document.getElementById('ajoutPack').click();
    </script>
@endif


@if (session('errorModifierrepas'))
    <script>
        document.getElementById('modifierRepas').click();
    </script>
@endif

@if (session('errorModifierpack'))
    <script>
        document.getElementById('modifierPack').click();
    </script>
@endif
<script>

function setInforepas (data) {
    formEdit = document.editRepas;
    formEdit.libelledit.value = data.libelle;
    formEdit.descriptionedit.value = data.description;
    formEdit.prixedit.value = data.prix;
    formEdit.id.value = data.id;
    document.getElementById('imageedits').src = "{{url('')}}"+'/' + data.image

    formEdit.action = "{{url('fournisseur/modifier/repas')}}"+'/' + data.id + '/' + "{{request()->id}}"

}

function setInfopack (data) {
    formEdit = document.editPack;
    formEdit.libelledit.value = data.libelle;
    formEdit.descriptionedit.value = data.description;
    formEdit.prixedit.value = data.prix;
    formEdit.id.value = data.id;
    document.getElementById('imageeditspack').src = "{{url('')}}"+'/' + data.image
    data.repas.forEach(repas => {
            document.getElementById('repasedit'+repas.id).checked = true;
    });

    formEdit.action = "{{url('fournisseur/modifier/pack')}}"+'/' + data.id + '/' + "{{request()->id}}"

}
$(function() {
    $('#Repas-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{url('fournisseur/datatable/get/repas')}}/{{request()->id}}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'image', name: 'image' },
            { data: 'libelle', name: 'libelle' },
            { data: 'description', name: 'description' },
            { data: 'prix', name: 'prix' },
            { data: 'specialite.libelle', name: 'specialite.libelle' },
            { data: 'created_at', name: 'created_at' },
            {data: 'action', name: 'action', orderable: false, searchable: false , style: 'width:150px'}
        ]
    });
    $('#Pack-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{url('fournisseur/datatable/get/pack')}}/{{request()->id}}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'image', name: 'image' },
            { data: 'libelle', name: 'libelle' },
            { data: 'description', name: 'description' },
            { data: 'prix', name: 'prix' },
            { data: 'specialite.libelle', name: 'specialite.libelle' },
            { data: 'created_at', name: 'created_at' },
            {data: 'action', name: 'action', orderable: false, searchable: false , style: 'width:150px'}
        ]
    });
});
</script>
@endpush

