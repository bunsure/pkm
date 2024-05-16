<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;
use Html;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        //
        Form::component('bsOpen', 'components.form.form', ['id'=>'','url'=>'']);
        Form::component('bsClose', 'components.form.close',[]);
        Form::component('bsSubmit', 'components.form.submit',[]);
        Form::component('bsSubmitCloseForm','components.form.submitclose',['submit_title'=>'Simpan','submit_class'=>'primary']);
        Form::component('bsHidden', 'components.form.hidden',['fieldname','value'=>null]);
        Form::component('bsReadonly', 'components.form.readonly',['fieldname','label', 'value'=>null]);
        Form::component('bsReadonlyTextarea', 'components.form.readonly-textarea',['fieldname','label', 'value'=>null]);
        Form::component('bsText', 'components.form.text', ['fieldname', 'label', 'value'=>null, 'required'=>false, 'class'=>'']);
        Form::component('bsTextarea', 'components.form.textarea', ['fieldname', 'label', 'value'=>null, 'required'=>false, 'class'=>'']);
        Form::component('bsPassword', 'components.form.password', ['fieldname', 'label', 'value'=>null, 'required'=>false, 'class'=>'']);
        Form::component('bsEmail', 'components.form.email', ['fieldname', 'label', 'value'=>null, 'required'=>false, 'class'=>'']);
        Form::component('bsSelect', 'components.form.select', ['fieldname', 'label', 'data'=>[], 'required'=>false, 'class'=>'','value'=>'']);
        Form::component('bsSelectCrypt', 'components.form.select-crypt', ['fieldname', 'label', 'data'=>[], 'required'=>false, 'class'=>'','value'=>'']);
        Form::component('bsRadionInline', 'components.form.radio-inline',['fieldname','label','data'=>[], 'required'=>false]);

        Html::component('bsLinkModal','components.modal.link',['id'=>'', 'target'=>'', 'text'=>'','class'=>'default']);
        Html::component('bsFormModalOpen', 'components.form.form-modal',['id'=>'','title'=>'','action'=>'']);
        Html::component('bsModalOpen', 'components.html.modal-open',['id'=>'','title'=>'']);
        Html::component('bsModalOpenLg', 'components.html.modal-open-lg',['id'=>'','title'=>'']);
        Html::component('bsFormModalOpenLg', 'components.form.form-modal-lg',['id'=>'','title'=>'','action'=>'']);
        Html::component('bsFormModalClose', 'components.form.form-modal-close',['submit_title'=>'','submit_class'=>'']);
        Html::component('bsModalClose', 'components.html.modal-close',[]);

        Html::component('bsForm', 'components.form.form',['id'=>'', 'action'=>'']);
        Html::component('bsFormClose', 'components.form.form-close',[]);

        Html::component('jsModalShow','components.js.onshow',['id'=>'']);
        Html::component('jsClose','components.js.close',[]);
        Html::component('jsClearForm','components.js.clear-form',['id'=>'','tag'=>'','name'=>'']);
        Html::component('jsValueForm','components.js.set-value',['id'=>'','tag'=>'','name'=>'']);

        Html::component('jsDatatable','components.js.datatable-ajax',['id'=>'','field'=>[],'url'=>'', 'length'=>10, 'sort'=>'', 'useRowClass'=>false]);
        Html::component('jsSubmitFormModal','components.js.submit-form-modal',['id'=>'','callback'=>'']);
        Html::component('jsSubmitForm','components.js.submit-form',['id'=>'','callback'=>'']);

        Html::component('bsDatatable','components.html.datatable',['id'=>'','field'=>[],'model'=>'']);
        Html::component('bsBtnLink','components.html.btnlink',['label'=>'','class'=>'','url'=>'']);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
