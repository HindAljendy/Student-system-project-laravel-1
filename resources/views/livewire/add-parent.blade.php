
<div>

    @if(!empty($successMessage))
    <div class="alert alert-success">
        {{ $successMessage }}
    </div>
    @endif

    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button"
                    class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
                <p>{{ trans('parents_trans.Step1') }}</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button"
                    class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
                <p>{{ trans('parents_trans.Step2') }}</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button"
                    class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}"
                    disabled="disabled">3</a>
                <p>{{ trans('parents_trans.Step3') }}</p>
            </div>
        </div>
    </div>


    <div>
        @include('livewire.Father-form')
        @include('livewire.Mother-form')
        
        <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
            @if ($currentStep != 3)
                <div style="display: none" class="row setup-content" id="step-3">
            @endif

            <div class="col-xs-12">
                <div class="col-md-12">
                    <h3 style="font-family : 'Cairo,sans-serif;' ">{{ trans('parents_trans.Confirm') }}</h3>
                    <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button"
                        wire:click="back(2)">{{ trans('parents_trans.Back') }}
                    </button>

                    <button class="btn btn-success btn-sm btn-lg pull-right"  type="button"
                    wire:click="submitForm">{{ trans('parents_trans.Finish') }}
                    </button>
    
                </div>
            </div>
        </div>

    </div>

</div>