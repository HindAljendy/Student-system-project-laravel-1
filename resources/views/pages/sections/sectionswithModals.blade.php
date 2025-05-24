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
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('sections_trans.title_page') }}</span>
        </div>
        <div class="my-3">
            <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#addModal">{{ trans('sections_trans.add_section') }}</a>
        </div>
        
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


<div class="row">
    <div class="card HJ_section card-statistics  h-100"> 
        <div class="card-body">   
            <div class="accordion" id="accordionExample">
                <!-- loop for stages and related sections  => Display the sections -->
                @foreach($stagesWithRelatedSections as $stage)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button HJ_accordion_btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            {{$stage->name}}
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="table mt-15">
                                <table class="table  HJ_table center-aligned-table mb-2">
                                    <thead>
                                        <tr class="text-dark">
                                            <th>#</th>
                                            <th>{{ trans('sections_trans.Name_Section') }} </th>
                                            <th>{{ trans('sections_trans.Name_Classroom') }}</th>
                                            <th>{{ trans('sections_trans.Status') }}</th>
                                            <th>{{ trans('sections_trans.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($stage->sections as $listSections)
                                        <tr>
                                            <?php $i++; ?>
                                            <td>{{$i}}</td>
                                            <td>{{$listSections->section_name}}</td>
                                            <td>{{$listSections->classroom->class_name}}</td>
                                            <td>
                                            @if ($listSections->status === 1)
                                                <label class="badge badge-success">{{ trans('sections_trans.Status_Section_AC') }}</label>
                                            @else
                                                <label class="badge badge-danger">{{ trans('sections_trans.Status_Section_No') }}</label>
                                            @endif
                                            </td>
                                            <td>
                                                <a href="#"
                                                    class="btn  btn-info btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#edit{{ $listSections->id }}">{{ trans('sections_trans.edit') }}
                                                </a>
                                                <a href="#"
                                                    class="btn btn-danger btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#delete{{ $listSections->id }}">{{ trans('sections_trans.delete') }}
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- edit_modal_Section -->

                                        <!-- Get all data by $listSections->id  = where by Id  +  When you go to the controller, edit the Data related to id. -->
                                        <div class="modal fade" id="edit{{  $listSections->id  }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="editModalLabel">
                                                            {{ trans('sections_trans.edit_section') }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- edit_form -->

                                                        <form action="{{ route('sections.update') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="row">
                                                                <div class="col">

                                                                    <!-- The id send with request  To know the specific section  = don't show the id in URL :  FOR SECURITY  -->
                                                                    <input id="id" type="hidden" name="id" class="form-control" value="{{ $listSections->id }}"/>
                                                                    
                                                                    <input type="text" name="Name_Section_Ar" class="form-control"
                                                                        value="{{ $listSections->getTranslation('section_name', 'ar')}}">
                                                                </div>

                                                                <div class="col">
                                                                    <input type="text" name="Name_Section_En" class="form-control"
                                                                        value="{{ $listSections->getTranslation('section_name', 'en')}}" >
                                                                </div>

                                                            </div><br>

                                                            <div class="col">
                                                                <label for="inputName" class="control-label">{{ trans('sections_trans.Name_Stage') }}</label>
                                                                <select name="stage_id" class="custom-select"
                                                                    onclick="console.log($(this).val())">
                                                                
                                                                    <option value="{{ $listSections->stage->id}}">{{ $listSections->stage->name}}</option>
                                                                    
                                                                    @foreach ($all_Stages as $Stage)
                                                                        <option value="{{ $Stage->id }}"> {{ $Stage->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <br>

                                                            <div class="col">
                                                                <label for="inputName" class="control-label">{{ trans('sections_trans.Name_Classroom') }}</label>
                                                                
                                                                <select name="classroom_id" class="custom-select">
                                                                    <option value="{{ $listSections->classroom->id}}">{{ $listSections->classroom->class_name}}</option>
                                                                </select>
                                                            </div><br>

                                                            <div class="col">
                                                                <div class="form-check">

                                                                    @if ( $listSections->status === 1)
                                                                    <input
                                                                        type="checkbox"
                                                                        checked
                                                                        class="form-check-input"
                                                                        name="status"
                                                                        id="exampleCheck1"
                                                                    />
                                                                    @else
                                                                    <input
                                                                        type="checkbox"
                                                                        class="form-check-input"
                                                                        name="status"
                                                                        id="exampleCheck1"
                                                                    />
                                                                    @endif
                                                                    <label
                                                                        class="form-check-label HJ_status_lable"
                                                                        for="exampleCheck1">{{ trans('sections_trans.Status') }}
                                                                    </label><br>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success">{{trans('sections_trans.edit_section')}}</button>
                                                                <button type="button" class="btn btn-secondary"data-dismiss="modal">{{ trans('sections_trans.close') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- delete_modal_Section -->
                                        <div class="modal fade" id="delete{{ $listSections->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="deleteModalLabel">
                                                            {{ trans('sections_trans.delete_section') }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- delete_form -->

                                                        <form action="{{ route('sections.destroy') }}" method="POST">
                                                            @csrf
                                                            @method('Delete')

                                                            {{trans('sections_trans.warning_delete')}}

                                                            <!-- The id send with request  To know the specific section  = don't show the id in URL :  FOR SECURITY  -->
                                                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $listSections->id }}"/>

                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">{{trans('sections_trans.delete_section')}}</button>
                                                                <button type="button" class="btn btn-secondary"data-dismiss="modal">{{ trans('sections_trans.close') }}</button>
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
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>   
</div>

<!-- Add  modal section  -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">{{ trans('sections_trans.add_section') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('sections.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <input type="text" name="Name_Section_Ar" class="form-control"
                            placeholder="{{ trans('sections_trans.Section_name_ar') }}">
                        </div>

                        <div class="col">
                            <input type="text" name="Name_Section_En" class="form-control"
                            placeholder="{{ trans('sections_trans.Section_name_en') }}">
                        </div>

                    </div><br>

                    <div class="col">
                        <label for="inputName" class="control-label">{{ trans('sections_trans.Name_Stage') }}</label>
                        <select name="stage_id" class="custom-select"
                                onchange="console.log($(this).val())">
                            <!--placeholder-->
                            <option value="" selected disabled>{{ trans('sections_trans.Select_Stage') }}</option>
                            @foreach ($all_Stages as $Stage)
                                <option value="{{ $Stage->id }}"> {{ $Stage->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>

                    <div class="col">
                        <label for="inputName" class="control-label">{{ trans('sections_trans.Name_Classroom') }}</label>
                        <!-- list empty -->
                        <select name="classroom_id" class="custom-select">

                        </select>
                    </div><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('sections_trans.close') }}
                        </button>
                        <button type="submit"
                            class="btn btn-success">{{ trans('sections_trans.add_section') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<!-- Bootstrap Js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Ajax + jquery => select"classroom_id" يتم عندها اظهار محتوى  select "stage_id" عند تغيير قيمة ال  -->
<script>
    $(document).ready(function () {
        $('select[name="stage_id"]').on('change', function () {
            var stage_id = $(this).val();
            if (stage_id) {
                $.ajax({
                    url: "{{ URL::to('all_classrooms') }}/" + stage_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) { // data= aaccossiative array

                        // empty the list before adding new options, so that options don't accumulate with each new request.
                        $('select[name="classroom_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });

</script>

@endsection