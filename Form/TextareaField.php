<?php


namespace app\core\Form;
use app\core\Model;
class TextareaField extends BaseField
{

    public Model $model;
    public string $attribute;

    public function __construct(Model $model, string $attribute)
    {
        parent::__construct($model,$attribute);
    }


    public function renderInput(): string
    {
        return sprintf('<textarea name="%s" class="form-control %s">%s</textarea>',
            $this->attribute,
            $this->model->hasError($this->attribute) ? "is-invalid" : '',
            $this->model->{$this->attribute}
        );
    }
}