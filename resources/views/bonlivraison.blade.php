 @extends('layout')

 @section('title', 'bonlivraison')

 @section('content')
<h1> ENVOI DE VOS JEUX </h1>

<p style="color: #8B0000;">
  Il ne vous reste plus qu’à imprimer le bon de livraison et à déposer votre colis en point relais. Vous pourrez retrouver vos jeux sous l’onglet “Suivi des ventes” de votre compte, une fois que nous les aurons réceptionnés.
</p> 
    <img class="BDL" src="{{ asset('images/BDL.png') }}" alt="BDL" class="photo">

<div class="button-group">
  <button><strong>Imprimer</strong></button>
  <button><strong>Télécharger</strong></button>
</div>

 @endsection