<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Participation à un Evénement</h2>
    <p> Bonjour Mr {{ $data['user']->name}} Vous venez de vous Inscrire à l'évenement {{ $data['event']->title}} détaillé comme suit:</p>
    <ul>
      <li><strong>Titre</strong> : {{ $data['event']->title}}</li>
      <li><strong>Description</strong> : {{$data['event']->content }}</li>
      <li><strong>Date de l'événement</strong> : {{$data['event']->event_date }}</li>
    </ul>
  </body>
</html>