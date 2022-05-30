<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Vérification de Mail</h2>
    <p>Vous venez de créer un compte avec les identifiants suivants:</p>
    <ul>
      <li><strong>Nom</strong> : {{ $data['user']->name }}</li>
      <li><strong>Email</strong> : {{$data['user']->email }}</li>
    </ul>
    <p>Cliquez sur le le button <a class="btn btn-success" href="{{ $data['url']}}">Activer</a>  pour activer votre compte</p>
  </body>
</html>