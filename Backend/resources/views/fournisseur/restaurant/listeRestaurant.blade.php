@php
$title  = 'Liste Restaurant';
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
                        <span>Restaurant</span>
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
                    <h2 style="display: inline" >Liste Restaurant</h2>
                    <button style="float: right; " id="ajoutRestaurant" type="button" data-toggle="modal" data-target="#addRestaurant" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Ajout Restaurant</button>

                    <hr>
                    <table class="table table-bordered" id="Restaurant-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>adresse</th>
                                <th>telephone</th>
                                <th>ville</th>
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




    <div class="modal fade bs-example-modal-lg in" id="addRestaurant" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
		<div class="modal-dialog modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Ajout Restaurant</h4>
                </div>
                <form action="{{ url('fournisseur/ajout/restaurant', []) }}" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            @if (!empty($errors->all()) && session('errorAjoutRestaurant'))
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
                            <input hidden type="text" id="latAjout" name="latAjout">
                            <input hidden type="text" id="lngAjout" name="lngAjout">

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
                                    Photo <span class="symbol required"></span>
                                </label>
                                <input type="file"   class="form-control" id="image" name="image">
                            </div>
                            
                            <div class="form-group">
                                <h5 class="over-title margin-bottom-15">Adresse sur Google map  <span class="symbol required"></span></h5>
                                <div class="map" id="map" style="z-index: 99999999"></div>
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
    <div class="modal fade bs-example-modal-lg in" id="editRestaurant" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
        <div class="modal-dialog modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modifier Restaurant</h4>
            </div>
        <form name="editRestaurant" action="{{ url('fournisseur/modifier/Rrestaurant', []) }}/{{old('id')}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                <input type="text" name="id" style="display:none">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        @if (!empty($errors->all()) && session('errorModifierRestaurant') )
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
                                Nom <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('nomedit') }}"   type="text" placeholder="Votre nom" class="form-control" id="firstnameedit" name="nomedit">
                            </div> 
                        </div>
                        <div  class="col-md-12">
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
                                    Telephone <span class="symbol required"></span>
                                </label>
                                <input type="text" value="{{ old('telephoneedit') }}"   placeholder="Votre numero telephone" class="form-control" id="telephoneedit" name="telephoneedit">
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
                         <input hidden type="text" id="latEdit" name="latEdit">
                         <input hidden type="text" id="lngEdit" name="lngEdit">
                         <div  class="col-md-12">
                            <h5 class="over-title margin-bottom-15">Adresse sur Google map  <span class="symbol required"></span></h5>
                            <div class="map" id="mapEdit" ></div>
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
    <button type="button" id="modifierRestaurant"  data-toggle="modal" data-target="#editRestaurant" style="display: none"></button>
@endsection


@push('scripts')
@if (session('errorAjoutRestaurant'))
    <script>
        document.getElementById('ajoutRestaurant').click();
    </script>
@endif
@if (session('errorModifierRestaurant'))
    <script>
        document.getElementById('modifierRestaurant').click();
    </script>
@endif
<script>

function setInfo (data) {
    formEdit = document.editRestaurant;
    formEdit.nomedit.value = data.nom;
    formEdit.adresseedit.value = data.adresse;
    formEdit.villeedit.value = data.ville;
    formEdit.telephoneedit.value = data.telephone;
    formEdit.id.value = data.id;
    document.getElementById('imageedits').src = "{{url('')}}"+'/' + data.logo
    initializeEdit( data.lng , data.lat)
    formEdit.action = "{{url('fournisseur/modifier/restaurant')}}"+'/' + data.id
 
}
$(function() {
    $('#Restaurant-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{url('fournisseur/datatable/get/restaurant?restaurant=')}}{{request()->restaurant}}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nom', name: 'nom' },
            { data: 'image', name: 'image' },
            { data: 'adresse', name: 'adresse' },
            { data: 'telephone', name: 'telephone' },
            { data: 'ville', name: 'ville' },
            { data: 'created_at', name: 'created_at' },
            { data: 'statut', name: 'statut' },
            {data: 'action', name: 'action', orderable: false, searchable: false , style: 'width:150px'}

        ]
    });
});

var map;


function initialize() {
    var marker = new google.maps.Marker();
    var tunisie = new google.maps.LatLng(36.81897 ,10.16579);
    var mapOptions = {
        zoom: 10,
        center: tunisie
    };
     map = new google.maps.Map(document.getElementById("map"),mapOptions);
        google.maps.event.addListener(map, 'click', function(event) {
        marker.setMap(null);
        marker = new google.maps.Marker({
              position: event.latLng,
              map: map
            });
          
                 document.getElementById('latAjout').value  =  marker.getPosition().lat();
                 document.getElementById('lngAjout').value  =  marker.getPosition().lng();
         
      });
}
function initializeEdit(lngEdit , latEdit) {
    pos1 = {}
    if(lngEdit != null && latEdit != null) {
        pos1 = pos =
        {lat: parseFloat(latEdit), lng: parseFloat(lngEdit )};

    } else {
        pos = {
            lat :36.81897 ,
             lng : 10.16579
        }
    }
    var tunisie = new google.maps.LatLng(pos.lat , pos.lng);
    var mapOptions = {
        zoom: 10,
        center: tunisie
    };
     map = new google.maps.Map(document.getElementById("mapEdit"),mapOptions);
  
     var marker = new google.maps.Marker( {
            position:pos1,
            map: map}
            );
        google.maps.event.addListener(map, 'click', function(event) {
        marker.setMap(null);
        marker = new google.maps.Marker({
              position: event.latLng,
              map: map
            });
          
                 document.getElementById('latEdit').value  =  marker.getPosition().lat();
                 document.getElementById('lngEdit').value  =  marker.getPosition().lng();
         
      });
}
google.maps.event.addDomListener(window, 'load', initialize);

</script>
@endpush

