@extends('layout')

@section('content')
    <div class="container">
        
        <div class="d-flex justify-content-end mb-3 me-sm-4">
            <a href="{{ route("recette.add") }}" class="btn btn-success text-light"><i class="bi bi-plus-circle me-2"></i>Nouveau recette</a>
        </div>
          <div class="table-responsive">
            <table id="recettes-table" class="table table-striped table-dark table-bordered">
                <h4>Liste des recettes</h4>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Designation</th>
                        <th>Montant</th>
                        <th>Mode de paiement</th>
                        <th>Rubrique</th>
                        <th>Approve</th>
                        <th>Rédigé par</th>
                        <th>Feuille</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recettes as $recette)
                        <tr>
                            <td>{{ $recette->id }}</td>
                            <td>{{ $recette->designation }}</td>
                            <td>{{ $recette->montant }}</td>
                            <td>
                                @if ($recette->modepaiement == "1")
                                    Banque
                                @else
                                    Caisse
                                @endif
                            </td>
                            <td>{{ $recette->rubrique ? $recette->rubrique->libelle : '' }}</td>
                            <td>
                                @if ($recette->approuve)
                                    <span class="badge bg-success text-white">Approuvé</span>
                                @else
                                    <span class="badge bg-warning text-dark">En attente</span>
                                @endif
                            </td>
                            <td>{{ $recette->user->name }}</td>
                            <td>
                                <a href="{{ url('recette/pdf/'.$recette->feuille) }}" class="btn btn-primary" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('recette.edit',['id' => $recette->id]) }}" class="btn btn-primary pe-2">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $recette->id }}">
                                        <i class="bi bi-trash"></i>
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
                                                    Vous ne pouvez pas supprimer cette recette.
                                                </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <form action="{{ route('recette.delete', $recette->id) }}" method="POST">
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


@endsection
