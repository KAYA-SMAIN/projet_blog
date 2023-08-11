<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Chirp;


class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post): RedirectResponse
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        $chirp = new Chirp([
            'message' => $request->message,
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $chirp->save();

        return redirect()->route('posts.show', $post->id)->with('success', 'Votre message a été envoyé.');
    }
 
    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }
 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp): View
    {
        /*
        $this->authorize('update', $chirp);
    
        return view('chirps.edit', [
            'chirp' => $chirp,
        ]);
        */
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
     /*
        $this->authorize('update', $chirp);
    
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
    
        $chirp->update($validated);
    
        return redirect()->back()->with('success', 'Le message a été mis à jour avec succès.');
        */
    }
    
    /**
     * Supprime la ressource spécifiée du stockage.
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        // Vérifier si l'utilisateur actuel est autorisé à supprimer ce message
        $this->authorize('delete', $chirp);
    
        $chirp->delete();
    
        return redirect()->back()->with('success', 'Le message a été supprimé avec succès.');
    }

    




 
}