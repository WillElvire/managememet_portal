<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"
      async
      defer
    />

    <title>Document</title>
</head>
<style>
    h1{
        color:orangered;
        font-weight: bold;
        margin-top: 2%;
    }
    .card{
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);
        border-radius : 20px;
        height: auto;
        margin-top: 2%;
    }
    .card input{
        border-radius : 20px;
        height: 7vh;
        box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
    }
    .card button{
        height: 8vh;
        border-radius: 20px;
        background: orangered;
        border: none;
        font-weight: bold;
    }
    .card h4{
        text-align: center;
    }
    .card h4:before{
        content:'---'
    }
    .card h4:after{
        content:'---'
    }
    .alert-danger{
        border-radius: 20px;
        box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
    }
    .alert-success{
        border-radius: 20px;
    }
</style>

<body>
    <h1 class="text-center">GT VOTE </h1>

    <div class="card container">
        <h4 class="mt-4">YOU CAN UPLOAD NOW </h4>
        <div class="alert alert-warning mt-4">
            make sure that you are allowed to access this page
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('upload') }}" enctype="multipart/form-data">
                @csrf()
                @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{ session::get('message') }}
                    </div>
                @endif
                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{ session::get('error') }}
                    </div>
                 @endif
                <input class="form-control" name="name" placeholder="Name">
                <input class="form-control mt-4" name="department" placeholder="Department">
                <input type="file" id="files" name="files[]" multiple  class="form-control mt-4"   accept=".jpg,.png,.jpeg" >
                <button class="mt-4 col-md-12 btn btn-primary" type="submit">Save</button>
            </form>
        </div>
    </div>
</body>
<script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
</html>
