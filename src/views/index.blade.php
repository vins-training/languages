<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>
<body class="container">

    {{-- Validate --}}
    <section id="alert">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </section>


    {{-- List languages --}}
    <section>
        <header>
            <h2>List
                <button class="btn btn-success" data-toggle="modal" data-target="#modaladd">Add</button>
                <a class="btn btn-primary" href="{{route('lang.push')}}">Push</a>
                <div id="alertpush">
                    @if (session('push'))
                        <div class="alert alert-success">
                            OK mày =)
                        </div>
                    @endif
                </div>
            </h2>
        </header>
        <table id="table" class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Key</th>
                    <th scope="col">En</th>
                    <th scope="col">Vn</th>
                    <th scope="col">Page</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Option</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <th scope="row">{{$item->id}}</th>
                        <td>{{$item->key}}</td>
                        <td>{{$item->en}}</td>
                        <td>{{$item->vn}}</td>
                        <td>{{$item->page}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->updated_at}}</td>
                        <td style="display:flex">
                            <a class="btn btn-warning" data-toggle="modal" data-target="#modaledit" onclick="loadmodal('{{$item->id}}','{{$item->key}}','{{$item->en}}','{{$item->vn}}','{{$item->page}}')">
                                Edit
                            </a>
                            &nbsp;
                            <form id="{{$item->id}}" action="{{route('lang.language.destroy',$item->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <a class="btn btn-danger" href="javascript:{}" onclick="document.getElementById('{{$item->id}}').submit(); return false;">
                                    Delete
                                </a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <!-- Modal update -->
    <section>
        <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">  

                        {{-- Form update --}}
                        <form id="formedit" action="{{route('lang.language.update',2)}}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="modalid">ID</label>
                                <input type="text" readonly class="form-control" id="modalid" name="id"> &nbsp;
                            </div>
                            <div class="form-group">
                                <label for="modalkey">Key</label>
                                <input type="text" class="form-control" id="modalkey" name="key" placeholder="key input"> &nbsp;
                            </div>
             
                            <div class="form-group">
                                <label for="modalen">En</label>
                                <input type="text" class="form-control" id="modalen" name="en" placeholder="en input">&nbsp;
                            </div>
                            <div class="form-group">
                                <label for="modalvn">Vn</label>
                                <input type="text" class="form-control" id="modalvn"  name="vn" placeholder="vn input">&nbsp;
                            </div>
                            <div class="form-group">
                                <label for="modalpage">Page </label>
                                <input type="text" class="form-control" id="modalpage" name="page" placeholder="page input">&nbsp;
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick='document.getElementById("formedit").submit()'>Save</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal add -->
    <section>
        <div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">  

                        {{-- Form update --}}
                        <form id="formadd" action="{{route('lang.language.store')}}" method="post">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label for="modalkey">Key</label>
                                <input type="text" class="form-control" id="modalkey" name="key" placeholder="key input"> &nbsp;
                            </div>
             
                            <div class="form-group">
                                <label for="modalen">En</label>
                                <input type="text" class="form-control" id="modalen" name="en" placeholder="en input">&nbsp;
                            </div>
                            <div class="form-group">
                                <label for="modalvn">Vn</label>
                                <input type="text" class="form-control" id="modalvn"  name="vn" placeholder="vn input">&nbsp;
                            </div>
                            <div class="form-group">
                                <label for="modalpage">Page </label>
                                <input type="text" class="form-control" id="modalpage" name="page" placeholder="page input">&nbsp;
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick='document.getElementById("formadd").submit()'>Add</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        function loadmodal(modalid,modalkey,modalen,modalvn,modalpage) {
            document.getElementById("modalid").value = modalid;
            document.getElementById("modalkey").value = modalkey;
            document.getElementById("modalen").value = modalen;
            document.getElementById("modalvn").value = modalvn;
            document.getElementById("modalpage").value = modalpage;
            str="/en/language/"+modalid;
            console.log(str);
            $("#formedit").attr("action", str);
		}

        setTimeout(() => {
            document.getElementById("alert").innerHTML = '';
            document.getElementById("alertpush").innerHTML = '';
        }, 5000);

        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>

    
</body>
</html>