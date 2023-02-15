@extends('dashboardlayouts.master')
@section('title')
    <title>Edit Product</title>
@endsection

@section('content')
    <div class="product-add-edit py-3">
        <div class="container">
            <div class="card">
                {{-- @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif --}}
                <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('product/_form')
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            $('#type').on('change', function() {
                var type = $('#type').val();
                //console.log('i am type:'+ type);
                if (type == 'partial_featured') {
                    $('.paint, .print, .sparkle, .metallic').hide();
                    $('.non_featured').show()
                }

                if (type == 'non_featured') {
                    $('.non_featured').hide();
                }
                if (type == 'non_glass') {
                    $('.non_featured').hide();
                }
                if (type == 'full_featured') {
                    $('.non_featured, .paint, .print, .sparkle, .metallic').show();
                }
            });

            //for image
            $('.dropify').dropify();

            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })

        });
    </script>
@endsection
