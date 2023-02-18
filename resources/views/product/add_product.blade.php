@extends('dashboardlayouts.master')
@section('title')
    <title>Add Product</title>
@endsection

@section('content')
    <div class="product-add-edit py-3">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4>Create Product</h4>
                        </div>
                    </div>  
                    {{-- @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif --}}

                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @include('product/_form')

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!----------------------- Help / Product-Detail Modal ------------------------------->
    <div class="modal modal-lg fade" id="productdetail" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="ProductDetailModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">    
                    <h5 class="modal-title" id="ProductDetailModalLabel">Product Type Details</h5>
                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Full Featured Products:</label>
                                <p>Products which contains all of the attributes. In full featured product we have to fill all of the fields.</p>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <label>Partial Featured Products:</label>
                                <p>
                                    Products which the Painted/ Printed Back attributes. In Partial featured products the fields for
                                    <span style="color:red;">'Printed', 'Painted', 'Sparkle Finish'</span>
                                    and <span style="color:red;">'Metallic Finish'</span> are excluded.
                                </p>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <label>Non Featured Products:</label>
                                <p>
                                    Products which contains only the Width and Height attributes. In Non featured products we have only these fields,
                                    <span style="color:blue;">'Code', 'Title', 'Cost From Supplier', 'Sale Net Per SQM', ‘Width’</span>
                                    and  <span style="color:blue;">‘Height’</span>.
                                </p>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <label>Non Glass Products:</label>
                                <p>
                                    Products which are to be quoted based on quantity only. In Non glass products we only these fields,
                                    <span style="color:blue;">'Code', 'Title' , 'Cost From Supplier'</span> and
                                    <span style="color:blue;">'Sale Price’</span>.

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!----------------------- End Help / Product-Detail Modal ------------------------------->
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            $('.full_paint, .full_wood').hide();
            $('#type').on('change', function() {
                var type = $('#type').val();
                if (type == 'standard') {
                    $('.full_paint, .full_wood').hide();
                    $('.standard').show();
                }

                if (type == 'basic') {
                    $('.full_paint, .full_wood').hide();
                }
                if (type == 'full_paint') {
                    $('.full_wood, .standard').hide();
                    $('.full_paint').show(); 
                }
                if (type == 'full_wood') {
                    $('.full_paint, .standard').hide();
                    $('.full_wood').show(); 
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
