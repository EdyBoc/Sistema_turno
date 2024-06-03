<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="justify-content-center text-center">

                        <a class="btn btn-primary btn-lg" data-toggle="modal"
                            data-target="#modal_add_catalogo_dependencia"><i class="fas fa-street-view"></i>
                            Nuevo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $("#btn_actualizar").click(function() {
                location.reload();
            });
        });

        $("#btn_guardar_catalogo_dependencia").click(function(e) {
            e.preventDefault();
            var nombre_dependencia = $("#nombre_dependencia").val();
            var descripcion_dependencia = $("#descripcion_dependencia").val();
            $.ajax({
                type: "POST",
                url: "{{ route('guardar_dependencia') }}",
                data: {
                    nombre_dependencia: nombre_dependencia,
                    descripcion_dependencia: descripcion_dependencia,
                },
                success: function(response) {
                    if (!response.success) {
                        toastr.error(response.message);
                    } else {
                        toastr.success(response.message);
                        location.reload();
                    }
                }
            });
        });
    </script>


</body>

</html>
