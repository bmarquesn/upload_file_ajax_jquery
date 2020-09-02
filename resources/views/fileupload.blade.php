<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="Keywords" content="Bruno Nogueira, CRUD, Laravel, Estudo, ACL" />
        <meta name="Description" content="Estudo, aprendizagem do framework PHP Laravel com ACL" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{ str_replace('_', ' ', config('app.name', 'Upload File With JQuery Ajax in Laravel')) }}</title>
        <!-- Styles -->
        <link href="{{ URL::asset('assets/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" />
    </head>
    <body>
        <div class="content">
            <h1 align="center">
                File Upload with JQuery Ajax
            </h1>
            <p align="center"><input type="button" value="Selecionar Arquivo" id="select_file" /></p>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="uploadFile">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload File With JQuery / Ajax</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" enctype="multipart/form-data" id="laravel-ajax-file-upload" action="javascript:void(0)">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="file" name="file" placeholder="Choose File" id="file" />
                                        <span class="text-danger">{{ $errors->first('arquivo') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <img src="{{ URL::asset('assets/img/carregando.gif') }}" alt="Carregando" title="Carregando" style="display:none;" />
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <!-- Scripts -->
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-3.4.1.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function(){
        $('#select_file').on('click', function(){
            $('#uploadFile').modal('show');
        });
        $('#uploadFile').find('.modal-footer').children('.btn.btn-primary').on('click', function(){
            $('form#laravel-ajax-file-upload').submit(function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                var urlForm='{{ url('/fileupload/store') }}';
                $.ajax({
                    method: 'POST',
                    type: 'POST',
                    url: urlForm,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        alert('Feito upload com sucesso do arquivo');
                        console.log(data);
                        $('#uploadFile').modal('hide');
                    },
                    error: function(data){
                        console.log(data);
                        $('#uploadFile').modal('hide');
                    }
                });
            });
        });
    });
    </script>
</html>
