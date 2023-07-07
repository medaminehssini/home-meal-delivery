@php
$title  = 'Liste Coupon';
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
                        <span>Coupon</span>
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
                    <h2 style="display: inline" >Liste Coupon</h2>
                    <button style="float: right; " id="ajoutCoupon" type="button" data-toggle="modal" data-target="#addCoupon" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Ajout Coupon</button>

                    <hr>
                    <table class="table table-bordered" id="Coupon-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Code</th>
                                <th>Remise</th>
                                <th>Date d'expiration</th>  
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
        id="addCoupon"
   
    tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
		<div class="modal-dialog modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Ajout Coupon</h4>
                </div>
                <form action="{{ url('ajout/coupon', []) }}" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            @if (!empty($errors->all()) && session('errorAjoutCoupon'))
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
                                   Code <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('code') }}" type="text" placeholder="Code" class="form-control" id="code" name="code">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Remise <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('remise') }}" type="text" placeholder="remise" class="form-control" id="remise" name="remise">
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Date d'expiration <span class="symbol required"></span>
                                </label>
                                <input type="date" value="{{ old('date_fin') }}" placeholder="Date d'expiration" class="form-control" id="date_fin" name="date_fin">
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
    <div class="modal fade bs-example-modal-lg in" id="editCoupon" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
        <div class="modal-dialog modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modifier Coupon</h4>
            </div>
        <form name="editCoupon" action="{{ url('/modifier/coupon', []) }}/{{old('id')}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                <input type="text" name="id" style="display:none">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        @if (!empty($errors->all()) && session('errorModifierCoupon') )
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
                                Code <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('code') }}"   type="text" placeholder="Votre nom" class="form-control" id="firstnameedit" name="code">
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">
                                    Remise <span class="symbol required"></span>
                                </label>
                                <input value="{{ old('remise') }}"   type="text" placeholder="votre prénom" class="form-control" id="lastnameedit" name="remise">
                            </div>
                        </div>
                        <div style="                        padding : 0;
                        padding-right: 10px;"  class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">
                                    Date d'expiration <span class="symbol required"></span>
                                </label>
                                <input type="date" value="{{ old('date_fin') }}"   placeholder="Votre adresse" class="form-control" id="date_finedit" name="date_fin">
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
    <button type="button" id="modifierCoupon"  data-toggle="modal" data-target="#editCoupon" style="display: none"></button>
@endsection


@push('scripts')
@if (session('errorAjoutCoupon'))
    <script>
        document.getElementById('ajoutCoupon').click();
    </script>
@endif
@if (session('errorModifierCoupon'))
    <script>
        document.getElementById('modifierCoupon').click();
    </script>
@endif
<script>

function setInfo (data) {
    console.log(data)
    formEdit = document.editCoupon;
    formEdit.code.value = data.code;
    formEdit.remise.value = data.remise;
    formEdit.date_fin.value = data.date_fin;
    formEdit.id.value = data.id;
    formEdit.action = "{{url('modifier/coupon')}}"+'/' + data.id

}
$(function() {
    $('#Coupon-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{url('datatable/get/coupon')}}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'code', name: 'code' },
            { data: 'remise', name: 'remise' },
            { data: 'date_fin', name: 'date_fin' },
            { data: 'created_at', name: 'created_at' },
            {data: 'action', name: 'action', orderable: false, searchable: false , style: 'width:150px'}

        ]
    });
});
</script>
@endpush

