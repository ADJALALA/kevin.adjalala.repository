<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>CEUDD</title>
  </head>
  <body>
    <div class="container text-center m-5">
        <div class="row">
            <div class="cols">
                <a href="/ajouter"><button class="bg bg-blue-700 text-white px-2 rounded">ajouter un etudiant</button></a>
                <table class="table-fixed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Classe</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>DOH</td>
                            <td>Jean</td>
                            <td>5eme</td>
                            <td>
                                <a href="#" class=""><button class="bg bg-blue-500 px-1 rounded text-shadow-white">update</button></a>
                                <a href="#" class=""><button class="bg bg-red-400 px-1 rounded text-white">delete</button></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
</div>

            </div>

        </div>

        
  </body>
</html>