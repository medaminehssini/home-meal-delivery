@php
$title  = 'Liste Admin';
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
                        <span>Admin</span>
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
                    <h2 style="display: inline" >Liste Admin</h2>
                    <button style="float: right; " id="ajoutAdmin" type="button" data-toggle="modal" data-target="#addAdmin" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Ajout Admin</button>

                    <hr>
                    <table class="table table-bordered" id="admin-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Email</th>
                                <th>Date de Creation</th>
                                <th>Date de modification </th>
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
        id="addAdmin"
   
    tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
		<div class="modal-dialog modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Ajout Admin</h4>
                </div>
                <form action="{{ url('ajout/admin', []) }}" method="POST">
				<div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            @if (!empty($errors->all()) && session('errorAjouAdmin'))
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
    <div class="modal fade bs-example-modal-lg in" id="editAdmin" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
        <div class="modal-backdrop fade in" ></div>
        <div class="modal-dialog modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modifier Admin</h4>
            </div>
        <form name="editAdmin" action="{{ url('/modifier/admin', []) }}/{{old('id')}}" method="POST">
                @method('PUT')
                <input type="text" name="id" style="display:none">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        @if (!empty($errors->all()) && session('errorModifierAdmin') )
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
                            <input value="{{ old('nomedit') }}"   type="text" placeholder="Votre nom" class="form-control" id="firstnameedit" name="nomedit">
                        </div>
                        <div class="form-group">
                            <label class="control-label">
                                Prénom <span class="symbol required"></span>
                            </label>
                            <input value="{{ old('prenomedit') }}"   type="text" placeholder="votre prénom" class="form-control" id="lastnameedit" name="prenomedit">
                        </div>
                        <div class="form-group">
                            <label class="control-label">
                                Email <span class="symbol required"></span>
                            </label>
                            <input type="email" value="{{ old('emailedit') }}"   placeholder="Votre adresse email" class="form-control" id="emailedit" name="emailedit">
                        </div>
                        <div class="form-group">
                            <label class="control-label">
                                Mot de passe <span class="symbol required"></span>
                            </label>
                            <input type="password"  placeholder="Votre mot de passe" class="form-control" name="mot_de_passe" id="passwordedit">
                        </div>
                        <div class="form-group">
                            <label class="control-label">
                                Confirmez Mot de passe <span class="symbol required"></span>
                            </label>
                            <input type="password" class="form-control" id="password_againedit" name="mot_de_passe_confirmation">
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
    <button type="button" id="modifierAdmin"  data-toggle="modal" data-target="#editAdmin" style="display: none"></button>
@endsection


@push('scripts')
@if (session('errorAjouAdmin'))
    <script>
        document.getElementById('ajoutAdmin').click();
    </script>
@endif
@if (session('errorModifierAdmin'))
    <script>
        document.getElementById('modifierAdmin').click();
    </script>
@endif
<script>

function setInfo (data) {
    formEdit = document.editAdmin;
    formEdit.nomedit.value = data.nom;
    formEdit.prenomedit.value = data.prenom;
    formEdit.emailedit.value = data.email;
    formEdit.id.value = data.id;

    formEdit.action = "{{url('modifier/admin')}}"+'/' + data.id

}
$(function() {
    $('#admin-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{url('datatable/get/admin')}}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nom', name: 'nom' },
            { data: 'prenom', name: 'prenom' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            {data: 'action', name: 'action', orderable: false, searchable: false}

        ]
    });
});
</script>
@endpush

