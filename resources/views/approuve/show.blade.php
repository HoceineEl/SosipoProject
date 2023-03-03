@extends('layout')

@section('content')
    <div class="container">
            <h1>Les recette</h1>
                <table id="recettes-table" class="table table-responsive table-striped table-dark table-bordered" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Designation</th>
                            <th>Montant</th>
                            <th>Mode de paiement</th>
                            <th>Rubrique</th>
                            <th>Rédigé par</th>
                            <th>Feuille</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recettesInvalide as $recette)
                            <tr>
                                <td>{{ $recette->id }}</td>
                                <td>{{ $recette->designation }}</td>
                                <td>{{ $recette->montant }}</td>
                                <td> @if ($recette->modepaiement == "1")
                                        Banque
                                @else
                                        Caisse
                                @endif
                                </td>
                                <td>{{ $recette->rubrique ? $recette->rubrique->libelle : '' }}</td>
                                <td>{{ $recette->user->name }}</td>
                                <td>
                                    {{-- <a href="{{ asset($recette->feuille) }}" class="btn btn-primary" target="_blank">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                    </a> --}}
                                    <a href="{{ url('recette/pdf/'.$recette->feuille) }}" class="btn btn-primary" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('approuve.post',["id" => $recette->id]) }}" class="btn btn-primary pe-2">
                                            <i class="bi bi-check2-circle"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $recette->id }}">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                        <!-- Delete confirmation modal -->
                                        <div class="modal fade" id="deleteConfirmationModal{{ $recette->id }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel{{ $recette->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark" id="deleteConfirmationModalLabel{{ $recette->id }}">Confirmer la suppression</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-dark">
                                                        Êtes-vous sûr de vouloir supprimer cet recette ?
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <form  action="{{ route('approuve.cancel',["id" => $recette->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
