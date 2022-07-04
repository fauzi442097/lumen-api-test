<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

       div.container {

        }

        h1 {
            text-align: center;
        }

        .italic {
            font-style: italic;
        }

        p {
            font-size: 1.2rem;
        }

        table {
            margin: 0 auto;
        }

        table, tr td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table td {
            padding: .5em 1em;
        }

        .soal6 {
            background: #d7d7d7;
        }


    </style>
</head>
<body>
    <div class="container">
        <h1> Welcome to API CRUD With Mongodb </h1>
        <p class="italic">
            This API build with Lumen Framework With: <br>
            <ul>
                <li>  CRUD data Barang Using MongoDB </li>
                <li>  CRUD data User Using Firebase </li>
                <li>  Auth with JWT Token </li>
                <li>  Integrating with another API https://reqres.in/ </li>
                <li> Filter Denom </li>
            </ul>
        </p>

        <table>
            <tr>
                <td colspan="4" style="text-align: center">
                    <a href="{{ url('/api/documentation') }}"> Swagger API Documentation </a> |
                    <a href="{{ url('/docs') }}"> .json </a>
                </td>
            </tr>
            <tr>
                <td> Jawaban Soal No 1</td>
                <td> User management </td>
                <td> : </td>
                <td>
                    <a href="{{ url('/api/v1/barang') }}"> /api/v1/barang </a>
                </td>
            </tr>
            <tr>
                <td> Jawaban Soal No 2</td>
                <td> Auth JWT </td>
                <td> : </td>
                <td>
                    [POST] <a href="{{ url('/api/v1/login') }}"> /api/v1/login </a> <br>
                    [GET] <a href="{{ url('/api/v1/checkLogin') }}"> /api/v1/checkLogin </a> <br>
                    [POST] <a href="{{ url('/api/v1/logout') }}"> /api/v1/logout </a>
                </td>
            </tr>
            <tr>
                <td> Jawaban Soal No 3</td>
                <td> User management </td>
                <td> : </td>
                <td>
                    <a href="{{ url('/api/v1/users') }}"> /api/v1/users </a>
                </td>
            </tr>
            <tr class="">
                <td rowspan="3"> Jawaban Soal No 6</td>
                <td> Integration with another API </td>
                <td> : </td>
                <td> <a href="https://reqres.in/" target="_blank"> https://reqres.in/ </a> </td>
            </tr>
            <tr class="">
                <td> [POST] http://localhost:8000/register </td>
                <td> : </td>
                <td> https://reqres.in/register </td>
            </tr>
            <tr class="">
                <td> [POST] http://localhost:8000/login </td>
                <td> : </td>
                <td> https://reqres.in/login </td>
            </tr>
            <tr>
                <td> Jawaban Soal No 7</td>
                <td> Filter data with denom >= 100000 : </td>
                <td> : </td>
                <td> <a href="{{  url('/api/v1/denoms/filter') }}"> /api/v1/denoms/filter  </a> </td>
            </tr>
        </table>

        <p> {{  app()->version() }}</p>
    </div>
</body>
</html>

