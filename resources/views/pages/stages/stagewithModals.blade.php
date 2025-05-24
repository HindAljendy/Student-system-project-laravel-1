@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">{{trans('stages_trans.pages')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{trans('stages_trans.title_page')}}</span>
			</div>
			<div class="my-3">              
				<a href="" class="btn btn-secondary" data-toggle="modal" data-target="#addModal">{{trans('stages_trans.add_stage')}}</a>
			</div>
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

    <!-- row -->
	<div class="row">
		<h4 style="margin:20px;">{{trans('stages_trans.all_stages')}} :</h4>
		<div style="width:80%;margin:20px auto;">

			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">{{trans('stages_trans.name')}}</th>
						<th scope="col">{{trans('stages_trans.notes')}}</th>
						<th scope="col">{{trans('stages_trans.actions')}}</th>
					</tr>
				</thead>
				<tbody class="table-group-divider">
                    
                    <?php $i = 0; ?>
					@foreach ($stages as $stage)
					<tr>
                        <?php $i++; ?>
                        <td>{{ $i }}</td
						<th scope="row">{{$stage->id}}</th>
						<td>{{$stage->name}}</td>
						<td>{{$stage->notes}}</td>
						<td>
                            <!-- The id  ( $stage->id ) controlled in the form update and don't send the id with route update. 
                        
                            Pass the ID of the modal to open the modal according to the ID of the element
                            -->
							<a href="" class="btn btn-primary"  data-toggle="modal"
                            data-target="#edit{{ $stage->id }}">{{trans('stages_trans.edit')}}</a>

                            <a href="" class="btn btn-danger"  data-toggle="modal"
                            data-target="#delete{{ $stage->id }}">{{trans('stages_trans.delete')}}</a>
						</td>
					</tr>

                    <!-- edit_modal_Stage -->

                    <!-- Get all data by  stage ID = where by Id  +  When you go to the controller, edit the Data related to id. -->
                    <div class="modal fade" id="edit{{ $stage->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="editModalLabel">
                                        {{ trans('stages_trans.edit_stage') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- edit_form -->

                                    <form action="{{ route('stages.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <div class="col">

                                                <!-- The id send with request  To know the specific stage  = don't show the id in URL :  FOR SECURITY  -->
                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $stage->id }}"/>

                                                <label  class="mr-sm-2">{{ trans('stages_trans.enter_name') }}:</label><br><br>
                                                <input type="text" name="name_stage_ar"    value="{{$stage->getTranslation('name', 'ar')}}"  /><br><br>
                                                <input type="text" name="name_stage_en"    value="{{$stage->getTranslation('name', 'en')}}"  />
                                            </div>

                                            <div class="col">
                                                <label  class="mr-sm-2">{{ trans('stages_trans.enter_notes') }}:</label><br><br>
                                                <input type="text" name="notes_stage_en"  value="{{$stage->getTranslation('notes', 'en')}}"><br><br>
                                                <input type="text" name="notes_stage_ar"  value="{{$stage->getTranslation('notes', 'ar')}}">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">{{trans('stages_trans.edit_stage')}}</button>
                                            <button type="button" class="btn btn-secondary"data-dismiss="modal">{{ trans('stages_trans.close') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- delete_modal_Stage -->
                    <div class="modal fade" id="delete{{ $stage->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="deleteModalLabel">
                                        {{ trans('stages_trans.delete_stage') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- delete_form -->

                                    <form action="{{ route('stages.destroy') }}" method="POST">
                                        @csrf
                                        @method('Delete')

                                        {{trans('stages_trans.warning_delete')}}

                                        <!-- The id send with request  To know the specific stage  = don't show the id in URL :  FOR SECURITY  -->
                                        <input id="id" type="hidden" name="id" class="form-control" value="{{ $stage->id }}"/>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">{{trans('stages_trans.delete_stage')}}</button>
                                            <button type="button" class="btn btn-secondary"data-dismiss="modal">{{ trans('stages_trans.close') }}</button>
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



        <!-- add_modal_Stage -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="addModalLabel">
                            {{ trans('stages_trans.add_stage') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->

                        <form action="{{ route('stages.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col">
                                    <label  class="mr-sm-2">{{ trans('stages_trans.enter_name') }}:</label><br><br>
                                    <input type="text" name="name_stage_ar"    value="{{old('name_stage_ar')}}"   placeholder="{{trans('stages_trans.enter_name_stage_ar')}}"><br><br>
                                    <input type="text" name="name_stage_en"    value="{{old('name_stage_en')}}"     placeholder="{{trans('stages_trans.enter_name_stage_en')}}">
                                </div>

                                <div class="col">
                                    <label  class="mr-sm-2">{{ trans('stages_trans.enter_notes') }}:</label><br><br>
                                    <input type="text" name="notes_stage_ar"  value="{{old('notes_stage_ar')}}" placeholder="{{trans('stages_trans.enter_notes_ar')}}"><br><br>
                                    <input type="text" name="notes_stage_en"  value="{{old('notes_stage_en')}}" placeholder="{{trans('stages_trans.enter_notes_en')}}">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">{{trans('stages_trans.add_stage')}}</button>
                                <button type="button" class="btn btn-secondary"data-dismiss="modal">{{ trans('stages_trans.close') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	
	</div>
	<!-- Container closed -->

    <!-- main-content closed -->
@endsection
@section('js')
@endsection


