@php
$title  = 'Liste Commande';
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
                    <h2 style="display: inline" >Liste Commande</h2>

                    <hr>
                    <table   class="table table-bordered" id="Commande-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Nom Client</th>
                                <th>adresse</th>
                                <th>Date de Creation</th>
                                <th>Edit</th>
                                <th >Detail</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- end: FORM VALIDATION EXAMPLE 1 -->

    </div>
</div>

<div class="modal fade bs-example-modal-lg in" id="openmaps" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
    <div class="modal-backdrop fade in" ></div>
    <div class="modal-dialog modal-dialog modal-lg">
     <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
                <h4 class="modal-title" id="myModalLabel">Modifier Restaurant</h4>
                <div style="position: absolute;
                right: 45px;
                top: 8px;">
                    <h4 class="modal-title" style="font-size: 15px;" >Distance en kilomètre : <span id="dist" style="font-weight: bold;
                        color: red;">  </span> Km</h4>
                    <h4 class="modal-title" style="font-size: 15px;" >Temps estimé : <span id="temps" style="font-weight: bold;
                        color: red;">  </span> </h4>
                    <h4>
                        
                    </h4>

                </div>

        </div>
        <div style="overflow: hidden" class="modal-body">
            <div class="col-md-12">
                <div class="map" id="map" style="z-index: 99999999"></div>
                <div style="padding: 20px;  text-align: right;" ><button type="button" onclick="document.getElementById('right-panel').style.display='block'" class="btn btn-info">Voir les détails</button></div>
                <div style="overflow-y: scroll;display: none" id="right-panel" >

                </div>
            </div>
        </div>
    </div>
    </div>
</div>




@endsection


@push('scripts')
<script>

$(function() {
    var template = Handlebars.compile($("#details-template").html());
    var templates = Handlebars.compile($("#details-templates").html());

    Handlebars.registerHelper('json', function(context) {
    return JSON.stringify(context);
        } );
    var table =  $('#Commande-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{url('transporteur/datatable/get/commande?commande=')}}{{request()->commande}}",
        columns: [
            {
                "className":      'details-controls',
                "orderable":      false,
                "searchable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { data: 'id', name: 'id' },
            { data: 'user.nom', name: 'user.nom' },
            { data: 'adresseMap', name: 'adresseMap' },
            { data: 'created_at', name: 'created_at' },
            {data: 'action', name: 'action', orderable: false, searchable: false , style: 'width:150px'},
            {
                "className":      'details-control',
                "orderable":      false,
                "searchable":     false,
                "data":           null,
                "defaultContent": ''
            },
        ]

        
      
    });
    $('#Commande-table tbody').on('click', 'td.details-control', function () {
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
    $('#Commande-table tbody').on('click', 'td.details-controls', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'posts-' + row.data().id;

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(templates(row.data())).show();
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
            ajax: "{{url('transporteur/get/transporteur/liste/item')}}/"+data.id,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'action', name: 'action' },
                { data: 'repas.libelle', name: 'repas.libelle' },
                { data: 'repas.description', name: 'repas.description' },
                { data: 'restaurant', name: 'restaurant' },
                { data: 'repas.prix', name: 'repas.prix' },
                { data: 'types', name: 'types' },
            ]
        })
}
</script>
<script    id="details-templates" type="text/x-handlebars-template">
    <div style="padding-top: 10px;padding-left: 10px; ">
        <div  class="label label-info">liste des articles
        </div>
     </div> 
     <table  class="table details-table" id="posts-@{{id}}">
         <thead>
         <tr>
            <th>Id</th>
            <th>Image</th>
            <th>Libelle</th>
            <th>Description</th>
            <th>Nom restaurant</th>
            <th>prix</th>
            <th>type</th>
             
         </tr>
         </thead>
     </table>
 </script>
<script id="details-template" type="text/x-handlebars-template">
    <table class="table">
        <tr>
            <td style="font-weight: bold">Nom client:</td>
            <td>@{{user.nom}}</td>
            <td style="font-weight: bold" >Prénom client:</td>
            <td>@{{user.prenom}}</td>
        </tr>
        <tr>
            <td style="font-weight: bold">Email client:</td>
            <td>@{{user.email}}</td>
            <td style="font-weight: bold"> Adresse client:</td>
            <td>@{{user.adresse}}</td>
        </tr>
        <tr>
            <td style="font-weight: bold">Code coupon:</td>
            <td>@{{coupon.code}}</td>
            <td style="font-weight: bold">Remise coupon:</td>
            <td >@{{coupon.remise}}%</td>
        </tr>
        <tr>
            <td onclick="initialize(@{{lat}} , @{{lng}} , @{{json rest}})"> <button   type="button" class="btn btn-success"   data-toggle="modal" data-target="#openmaps"  >Voir Map</button></td>

        </tr>

    </table>
  

    
</script>
<script>

var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;
var origin ;
var end;
var destinations = []
var marker ;

    service = new google.maps.DistanceMatrixService();

    function initialize(latparam , lngparam , rest) {

        document.getElementById('map').innerHTML ='';
        //ajouter les point et  (markers)
        origin = {
            lat : 34.8002879 , 
            lng : 10.6408087
        }
        directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
        directionsDisplay.setPanel(document.getElementById('right-panel'));

        var chicago = new google.maps.LatLng(origin);
        var mapOptions = {
            zoom: 7,
            center: chicago
        };
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        directionsDisplay.setMap(map);

        marker = new google.maps.Marker({
            position: origin,
            map: map,
            icon:  {
                    url: '{{ url('', []) }}'+'/images/maps/origin.png',
                    scaledSize : new google.maps.Size(50, 50),
                }
         });
         setMarkerContent(marker , 'KgsExpresse' , 'images/kgsexpress.png')
         end = {
                lat :latparam, 
                lng : lngparam
            }
        marker = new google.maps.Marker({
                position: end,
                map: map,
                icon:  {
                    url: '{{ url('', []) }}'+'/images/maps/end.png',
                    scaledSize : new google.maps.Size(50, 50),
                }
        });
        i=0 ; 
        rest.forEach(element => {
            destinations[i] = {
                lat : parseFloat(element.lat ), 
                lng : parseFloat(element.lng)
            }
            marker = new google.maps.Marker({
                position: destinations[i],
                map: map,
                icon:  {
                    url: '{{ url('', []) }}'+'/images/maps/destination.png',
                    scaledSize : new google.maps.Size(50, 50),
                }

            });

                
            setMarkerContent(marker , element.nom , element.logo)
            i++;
        });
        calcRoute();
    }
    function calcRoute() {
        var waypts = [];
        for (var i = 0; i < destinations.length ; i++) {
            waypts.push({
            location: destinations[i],
            stopover: true
            });
        }

        var request = {
            origin: origin,
            destination: end,
            waypoints: waypts,
            optimizeWaypoints: true,
            travelMode: google.maps.TravelMode.DRIVING
        };
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);

                dist = document.getElementById("dist");
                temps = document.getElementById("temps");


            var total_distance = 0.0;
            var total_temps = 0 ;

            for (var i=0; i<response.routes[0].legs.length; i++) {
                total_distance += response.routes[0].legs[i].distance.value;
                total_temps += response.routes[0].legs[i].duration.value;

                }
                hours = Math.floor(total_temps / 3600);
                minutes = Math.floor((total_temps - (hours * 3600)) / 60);
                seconds = total_temps - (hours * 3600) - (minutes * 60);

                timeString = hours.toString().padStart(2, '0') + ':' + 
                    minutes.toString().padStart(2, '0') + ':' + 
                    seconds.toString().padStart(2, '0');
                dist.innerHTML = total_distance /1000;
                temps.innerHTML = timeString;
            }
        });
    }
   function setMarkerContent (marker , title , image ) {
    var infoWindowOptions = {
                content: '<h3 style = "    text-align: center;">'+title+'</h3>'
                 
                    + '<br/><img src="{{ url('', []) }}/'+image+'" style="width: 189px;height: 100px;" />'
            };

            var infoWindow = new google.maps.InfoWindow(infoWindowOptions);

            google.maps.event.addListener(marker, 'click', function() {
                infoWindow.open(map, marker);
            });
   }

</script>
@endpush

