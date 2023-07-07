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






@endsection


@push('scripts')
<script>

$(function() {
    var template = Handlebars.compile($("#details-template").html());
    var templates = Handlebars.compile($("#details-templates").html());

    var table =  $('#Commande-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{url('transporteur/datatable/get/historique/commande')}}",
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
            <td>@{{coupon.remise}}%</td>
        </tr>
    </table>
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
@endpush

