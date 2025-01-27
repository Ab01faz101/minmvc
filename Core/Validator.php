<?php
namespace Core;

class Validator
{
    protected $errors = [];

    /**
     * اعتبارسنجی داده‌ها
     *
     * @param array $data
     * @param array $rules
     * @return bool
     */
    public function validate(array $data, array $rules)
    {
        foreach ($rules as $field => $fieldRules) {
            $fieldRules = explode('|', $fieldRules); // قوانین جداشده با |
            foreach ($fieldRules as $rule) {
                $method = 'validate' . ucfirst($rule);
                if (method_exists($this, $method)) {
                    $this->$method($data, $field, $rule);
                }
            }
        }

        return empty($this->errors);
    }

    /**
     * بررسی اینکه فیلد اجباری است یا خیر
     *
     * @param array $data
     * @param string $field
     * @param string $rule
     */
    protected function validateRequired(array $data, string $field, string $rule)
    {
        if (empty($data[$field])) {
            $this->addError($field, "$field is required.");
        }
    }

    /**
     * بررسی اینکه فیلد ایمیل معتبر است یا خیر
     *
     * @param array $data
     * @param string $field
     * @param string $rule
     */
    protected function validateEmail(array $data, string $field, string $rule)
    {
        if (!filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, "$field must be a valid email address.");
        }
    }

    /**
     * بررسی حداقل طول فیلد
     *
     * @param array $data
     * @param string $field
     * @param string $rule
     */
    protected function validateMin(array $data, string $field, string $rule)
    {
        $length = substr($rule, 4); // گرفتن عدد بعد از "min:"
        if (strlen($data[$field]) < $length) {
            $this->addError($field, "$field must be at least $length characters.");
        }
    }

    /**
     * افزودن خطای مربوط به فیلد
     *
     * @param string $field
     * @param string $message
     */
    protected function addError(string $field, string $message)
    {
        $this->errors[$field][] = $message;
    }

    /**
     * دریافت خطاهای اعتبارسنجی
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
