@extends('layouts.master')

@section('css')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ trans('stages_trans.pages') }}</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('classrooms_trans.title_page') }}</span>
        </div>
        <div class="my-3">
            <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#addModal">{{ trans('classrooms_trans.add_classroom') }}</a>
            
            <!-- button to delete checked elements -->
            <button type="button" class="btn btn-danger x-small"  id="btn_delete_all" >
                {{ trans('classrooms_trans.delete_checkbox') }}
            </button>
            
        </div>
        <br><br>

        <!-- Filter classrooms  -->
        <form action="{{ route('classrooms.Filter_Classes') }}" method="POST">
            @csrf
            <div class="select-container">
                <select class="select-box " data-style="btn-info" name="stage_id" 
                    onchange="this.form.submit()"> <!--  عند تغيير قيمة العنصر 
                    submit in form يُرسل النموذج إلى السيرفر مباشرة دون الحاجة للضغط على زر .-->

                    <option value="" selected disabled>{{ trans('classrooms_trans.Search_By_Stage') }}</option>

                    @foreach ($stages  as $stage)
                        <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="row">
    <h4 style="margin:20px;">{{ trans('classrooms_trans.all_classrooms') }} :</h4>
    <div style="width:80%; margin:20px auto;">
        <table  id="datatable"  class="table table-bordered">
            <thead>
                <tr>
                    <!-- input checkbox th select all classrooms -->
                    <th><input  type="checkbox" name="select_all" id="example-select-all" onclick="CheckAll('box1', this)" /></th>

                    <th>#</th>
                    <th>{{ trans('classrooms_trans.class_name') }}</th>
                    <th>{{ trans('classrooms_trans.stage_name') }}</th>
                    <th>{{ trans('classrooms_trans.actions') }}</th>
                </tr>
            </thead>
            <tbody>

                <!-- display classrooms depending on All classrooms"index" or filterd classrooms"search" -->
                
                @if(isset($details))
                <?php  $displayed_classrooms   = $details ?>
                @else
                <?php  $displayed_classrooms   = $classrooms ?>
                @endif

                <?php $i = 0; ?>
                @foreach ($displayed_classrooms  as $classroom)
                <tr>
                    <?php $i++; ?>
                    <!-- Add checkbox input for each classroom : id of classroom -->
                    <td><input type="checkbox" name="checkbox" value="{{$classroom->id}}"  class="box1"></td>
                    
                    <td>{{ $i }}</td>
                    <td>{{ $classroom->class_name }}</td>

                    <!-- stage : name of relationship -->
                    <td>{{ $classroom->stage->name }}</td>
                    <td>
                        <!-- Pass the ID of the modal to open the modal according to the ID of the element -->
                        <a href="#"  data-toggle="modal" data-target="#edit{{ $classroom->id }}" class="btn btn-primary">{{ trans('classrooms_trans.edit') }}</a>
                        <a href="#"  data-toggle="modal" data-target="#delete{{ $classroom->id }}" class="btn btn-danger">{{ trans('classrooms_trans.delete') }}</a>
                    </td>
                </tr>

                <!-- edit_modal_Classroom   تعديل على صف واحد -->

                <!-- Get all data by  classroom ID = where by Id  +  When you go to the controller, edit the Data related to id. -->
                <div class="modal fade" id="edit{{ $classroom->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="editModalLabel">
                                    {{ trans('classrooms_trans.edit_classroom') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- edit_form -->

                                <form action="{{ route('classrooms.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col">

                                            <!-- The id send with request  To know the specific stage  = don't show the id in URL :  FOR SECURITY  -->
                                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $classroom->id }}"/>

                                            <label  class="mr-sm-2">{{ trans('classrooms_trans.name_class_ar') }}:</label><br><br>
                                            <input type="text" name="name_class_ar"  value="{{$classroom->getTranslation('class_name', 'ar')}}" class="form-control" />
                                        </div>

                                        <div class="col">
                                            <label  class="mr-sm-2">{{ trans('classrooms_trans.name_class_en') }}:</label><br><br>
                                            <input type="text" name="name_class_en" value="{{$classroom->getTranslation('class_name', 'en')}}"  class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">{{ trans('classrooms_trans.name_stage') }}</label>
                                            <select name="stage_id" class="form-select form-select-lg  w-100  h-50 "  aria-label="Select stage">
                                                
                                                <!-- stage : name of relationship -->
                                                <option value="{{$classroom->stage->id}}">{{$classroom->stage->name}}</option>
                                                <!-- show list of stages -->
                                                @foreach ($stages as $stage)
                                                    <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">{{trans('classrooms_trans.edit_classroom')}}</button>
                                        <button type="button" class="btn btn-secondary"data-dismiss="modal">{{ trans('classrooms_trans.close') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- delete_modal_classroom  حذف صف واحد -->
                    <div class="modal fade" id="delete{{ $classroom->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="deleteModalLabel">
                                        {{ trans('classrooms_trans.delete_classroom') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- delete_form -->

                                    <form action="{{ route('classrooms.destroy') }}" method="POST">
                                        @csrf
                                        @method('Delete')

                                        {{trans('classrooms_trans.warning_delete')}}

                                        <!-- The id send with request  To know the specific classroom  = don't show the id in URL :  FOR SECURITY  -->
                                        <input id="id" type="hidden" name="id" class="form-control" value="{{ $classroom->id }}"/>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">{{trans('classrooms_trans.delete_classroom')}}</button>
                                            <button type="button" class="btn btn-secondary"data-dismiss="modal">{{ trans('classrooms_trans.close') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </tbody>
        </table>
    </div>
</div>

<!--    add modal classroom  with  List_classes -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">{{ trans('classrooms_trans.add_classroom') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="List_classes" action="{{ route('classrooms.store') }}" method="POST">
                @csrf
                    <div class="card-body">
                        <div data-repeater-list="List_classes">
                            <div data-repeater-item class="mb-3 p-3 border rounded">
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label">{{ trans('classrooms_trans.name_class_ar') }}</label>
                                        <input type="text" name="name_class_ar"  class="form-control" placeholder="{{ trans('classrooms_trans.name_class_ar') }}" />
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label">{{ trans('classrooms_trans.name_class_en') }}</label>
                                        <input type="text" name="name_class_en" class="form-control" placeholder="{{ trans('classrooms_trans.name_class_en') }}" />
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">{{ trans('classrooms_trans.name_stage') }}</label>
                                    
                                        <select name="stage_id" class="form-select form-select-lg  w-100  h-50 "  aria-label="Select stage">
                                        @foreach ($stages as $stage)
                                            <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" data-repeater-delete class="btn btn-danger btn-sm">{{ trans('classrooms_trans.delete_row') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="button" class="btn btn-primary" data-repeater-create>{{ trans('classrooms_trans.add_row') }}</button>
                            <button type="submit" class="btn btn-success">{{ trans('classrooms_trans.saveData') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- delete multible checked classrooms-->
<div class="modal fade" id="modal_delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('classrooms_trans.delete_classroom') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('classrooms.delete-all')}}" method="POST">
                @csrf
                @method('DELETE')

                {{trans('classrooms_trans.warning_delete')}}

                <div class="modal-body">
                    <!-- The ID s send with request  To know ALL CHECKED classrooms  = don't show the id in URL :  FOR SECURITY  -->
                    <!-- The value of this input fill later  -->
                    <input class="text" type="hidden"  value='' id="delete_all_id" name="delete_all_id" >
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">{{trans('classrooms_trans.delete_classroom')}}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('classrooms_trans.close') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery Repeater Plugin -->
<script src="https://cdn.jsdelivr.net/npm/jquery.repeater/jquery.repeater.min.js"></script>
<script>
$(document).ready(function() {
    $('#List_classes').repeater({ 
        initEmpty: false,
        defaultValues: {
            'name_class_en': '',
            'name_class_ar': '',
            'stage_id': 1 ,
        },
        show: function() {
            $(this).slideDown();
        },
        hide: function(deleteElement) {
            if (confirm('هل أنت متأكد من الحذف؟')) {
                $(this).slideUp(deleteElement);
            }
        }
    });
});
</script>

<script>
    /* function to select all elements    ,  elem : input selectall checkbox */
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;

        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }
</script>

<script type="text/javascript">
    /* function to when onclick on button btn_delete_all : display modal deleteAll only when checked the classrooms    +
    Fill the input value in the modal with the values ​in the selected array 
    that refer to the IDs of the checked classrooms.
    */

    $(function() {
        $("#btn_delete_all").click(function() {

            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });

            if (selected.length > 0) {
                var myModal = new bootstrap.Modal($('#modal_delete_all')[0]);
                myModal.show();

                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });

</script>

@endsection


<!-- $('#List_classes').repeater({...});
This line calls the repeater function on the element with the ID kt_docs_repeater_basic.
repeater is a JavaScript component (a jQuery plugin) that allows creating repeatable forms, enabling users to dynamically add or remove items.

initEmpty: false
This setting means that the form will not start empty when the page loads.
If set to false, one default item will be displayed when the page loads.
If set to true, the form will be empty initially, and the user will need to add items manually.

defaultValues: {...}
This specifies the default values for each form field when a new item is added.
In this case, for each new row:
'name_class_en': empty string
'name_class_ar': empty string
'stage_id': empty string
These default values are automatically filled into the fields when a new item is created.

show: function() {...}
This function runs when a new item is added.
In this code, it uses slideDown() to animate and smoothly display the new element:

Here, $(this) refers to the newly added element.

hide: function(deleteElement) {...}
This function runs when an item is about to be deleted.
It receives deleteElement, which is a function used to remove the item from the DOM.
Inside, it prompts the user with a confirmation message:

If the user confirms, it applies slideUp() to animate hiding the item, and then calls deleteElement() to remove it from the DOM.
If the user cancels, no action is taken, and the item remains. -->