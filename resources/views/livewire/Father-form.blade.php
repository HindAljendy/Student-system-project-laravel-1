@if($currentStep != 1)
    <div style="display: none" class="row setup-content" id="step-1">
@endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>
                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('parents_trans.Email')}}</label>
                        <input type="email" wire:model="Email"  class="form-control">
                        @error('Email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parents_trans.Password')}}</label>
                        <input type="password" wire:model="Password" class="form-control" >
                        @error('Password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row mt-3">
                    <div class="col">
                        <label for="title">{{trans('parents_trans.Name_Father_ar')}}</label>
                        <input type="text" wire:model="Name_Father_ar" class="form-control" >
                        @error('Name_Father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parents_trans.Name_Father_en')}}</label>
                        <input type="text" wire:model="Name_Father_en" class="form-control" >
                        @error('Name_Father_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row mt-3">
                    <div class="col-md-3">
                        <label for="title">{{trans('parents_trans.Job_Father_ar')}}</label>
                        <input type="text" wire:model="Job_Father_ar" class="form-control">
                        @error('Job_Father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{trans('parents_trans.Job_Father_en')}}</label>
                        <input type="text" wire:model="Job_Father_en" class="form-control">
                        @error('Job_Father_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('parents_trans.National_ID_Father')}}</label>
                        <input type="text" wire:model="National_ID_Father" class="form-control">
                        @error('National_ID_Father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parents_trans.Passport_ID_Father')}}</label>
                        <input type="text" wire:model="Passport_ID_Father" class="form-control">
                        @error('Passport_ID_Father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('parents_trans.Phone_Father')}}</label>
                        <input type="text" wire:model="Phone_Father" class="form-control">
                        @error('Phone_Father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="form-row mt-3">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('parents_trans.Nationality_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Nationality_Father_id">
                            <option selected>{{trans('parents_trans.Choose')}}...</option>
                            @foreach($Nationalities as $National)
                                <option value="{{ $National->id}}">{{$National->nationality_name}}</option>
                            @endforeach
                        </select>

                        @error('Nationality_Father_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('parents_trans.Blood_Type_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Blood_Type_Father_id">
                            <option selected>{{trans('parents_trans.Choose')}}...</option>
                            @foreach($Blood_Types as $Blood_Type)
                                <option value="{{ $Blood_Type->id }}">{{$Blood_Type->group_name}}</option>
                            @endforeach
                        </select>
                        
                        @error('Blood_Type_Father_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputZip">{{trans('parents_trans.Religion_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Religion_Father_id">
                            <option selected>{{trans('parents_trans.Choose')}}...</option>
                            @foreach($Religions as $Religion)
                                <option value="{{ $Religion->id }}">{{ $Religion->religion_name }}</option>
                            @endforeach
                        </select>

                        @error('Religion_Father_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-group mt-3">
                    <label for="exampleFormControlTextarea1">{{trans('parents_trans.Address_Father')}}</label>
                    <textarea class="form-control" wire:model="Address_Father" id="exampleFormControlTextarea1" rows="4"></textarea>
                    @error('Address_Father')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit"
                    type="button">{{trans('parents_trans.Next')}}
                </button>

            </div>
        </div>
    </div>